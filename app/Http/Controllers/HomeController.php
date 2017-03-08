<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use GuzzleHttp\Client;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $collegeList=DB::table('colleges')->orderBy('CollegeName', 'asc')->get();
        $sponsor=DB::table('sponsors')->select('SponsorName','SponsorLogo')->get();
        return view('center')->with('colleges',$collegeList)->with('sponsors',$sponsor);

    }
    public function pronight(){
		$sponsor=DB::table('sponsors')->select('SponsorName','SponsorLogo')->get();
        return view('pronight')->with('sponsors',$sponsor);
    }
    public function repay(){
    $orders=DB::table('order_detail')->join('orders','orders.Id','=','order_detail.order_id')->where('order_detail.Status','PENDING')->get();
    foreach($orders as $order)
    {
    $a="https://secure.paytm.in/oltp/HANDLER_INTERNAL/TXNSTATUS?JsonData={'MID':'KriIns08204252501061','ORDERID':'ORD".$order->id."'}";
    $contents = file_get_contents($a); 
    $contents=json_decode($contents,true);
	if($contents["TXNAMOUNT"]==$order->Total)
	{
	if($contents["STATUS"]=='TXN_SUCCESS')
	{
	$st=$contents["STATUS"];
	$pid=$contents["TXNID"];
	$dt=$contents["TXNDATE"];
	$date=date('Y-m-d',strtotime($dt));
	$upd=DB::table('order_detail')->where('id',$order->id)->update(['Status'=>$st]);
	$upd1=DB::table('orders')->where('Id',$order->order_id)->update(['Status'=>'PAID','Payment_Id'=>$pid,'date'=>$date]);
	echo "hii ";
	}
	else
	{
	$st=$contents["STATUS"];
	$upd=DB::table('order_detail')->where('id',$order->id)->update(['Status'=>$st]);
	}
	}
	else
	{
	$st="TXN_FAILURE";
	$upd=DB::table('order_detail')->where('id',$order->id)->update(['Status'=>$st]);
	}
    }
    }
    public function events(){
        $eventList=DB::table('events')->get();
        $sponsor=DB::table('sponsors')->select('SponsorName','SponsorLogo')->get();
        return view('events')->with('events',$eventList)->with('sponsors',$sponsor);
    }
	public function fun_events(){
        $eventList=DB::table('fun_events')->get();
        $sponsor=DB::table('sponsors')->select('SponsorName','SponsorLogo')->get();
        return view('funevents')->with('events',$eventList)->with('sponsors',$sponsor);
    }
	public function video(){
        $videoList=DB::table('video')->get();
        $sponsor=DB::table('sponsors')->select('SponsorName','SponsorLogo')->get();
        return view('video')->with('videos',$videoList)->with('sponsors',$sponsor);
    }
	public function contact(){
		$sponsor=DB::table('sponsors')->select('SponsorName','SponsorLogo')->get();
        return view('contact')->with('sponsors',$sponsor);
    }
    public function eventDetail($name){
        $event=DB::table('events')->where('EventCode',$name)->first();
        $pro='';
        if(Auth::guest())
        {
            $part_allow="YES";
            $cancel_allow='NO';
        }
        else
        if($event->EventType=='solo')
        {
            $ev_detail = $event->EventId;
            $user=Auth::user()->id;
            $part_allow='YES';
            $cancel_allow='YES';
            $ord=$check = DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->count();
            if($ord>0)
            {
            $ord=$check = DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->value('Id');
            $pro=DB::table('products')->where('Name',$ev_detail)->value('Id');
            $check= DB::table('order_items')->where('order_id',$ord)->where('product_id',$pro)->count();
            if($check>0)
            {
                $part_allow="NO";
                $cancel_allow="YES";
            }
            }
            $orders=$check = DB::table('orders')->where('Customer_Id', $user)->where('Status','PAID')->get();
            foreach($orders as $order)
            {
                $id=$order->Id;
                $pro=DB::table('products')->where('Name',$ev_detail)->value('Id');
                $check= DB::table('order_items')->where('order_id',$id)->where('product_id',$pro)->count();
                if($check>0)
                {
                    $part_allow='NO';
                    $cancel_allow='NO';
                    break;
                }
            }
        }
        else
            if($event->EventType=='group')
            {
                $ev_detail = $event->EventId;
                $user=Auth::user()->id;
                $part_allow='YES';
                $cancel_allow='YES';
                $ord=$check = DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->count();
                if($ord>0)
                {
                    $ord=$check = DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->value('Id');
                    $pro=DB::table('products')->where('Name',$ev_detail)->value('Id');
                    $check= DB::table('order_items')->where('order_id',$ord)->where('product_id',$pro)->count();
                    if($check>0)
                    {
                        $part_allow="NO";
                        $cancel_allow="YES";
                    }
                }
                $orders=$check = DB::table('orders')->where('Customer_Id', $user)->where('Status','PAID')->get();
                foreach($orders as $order)
                {
                    $id=$order->Id;
                    $pro=DB::table('products')->where('Name',$ev_detail)->value('Id');
                    $check= DB::table('order_items')->where('order_id',$id)->where('product_id',$pro)->count();
                    if($check>0)
                    {
                        $part_allow='NO';
                        $cancel_allow='NO';
                        break;
                    }
                }
                $pro=DB::table('products')->where('Name',$ev_detail)->first();
            }
        $sponsor=DB::table('sponsors')->select('SponsorName','SponsorLogo')->get();

        return view('eventDetail')->with('event',$event)->with('sponsors',$sponsor)->with('part_allow',$part_allow)->with('cancel_allow',$cancel_allow)->with('product',$pro);
    }
    public function schedule(){
        $event=DB::table('events')->orderby('EventDay')->orderby('EventTime')->get();
        $sponsor=DB::table('sponsors')->select('SponsorName','SponsorLogo')->get();
        return view('schedule')->with('events',$event)->with('sponsors',$sponsor);
    }
    public function student_data(Request $request){
        if(Auth::guest()) {
            return request()->back();
        }
        else {
            $id=$request['id'];
            $user=Auth::user()->Id;
            $cnt= DB::table('users')->where('id',$id)->count();

            if($cnt==0) {
                return view('volunteer')->with('volunteer', '{"msg":"Invalid Registration Id","short":"Invalid"}');
            }
            else {
                $name = DB::table('users')->where('id', $id)->get()->toJson();
                return view('volunteer')->with('volunteer', $name);
            }
        }
    }
    public function team(Request $request){
        if(Auth::guest()) {
            return request()->back();
        }
        else {
            $id=$request['id'];
            $cnt= DB::table('team_detail')->where('Team',$id)->count();
            if($cnt>0)
            {
                return view('volunteer')->with('volunteer','{"msg":"Team Name Already Taken","short":"Invalid"}');
            }
            else {
                return view('volunteer')->with('volunteer','{"msg":"Team Name Allowed","short":"Valid"}');
            }
        }
    }
    public function dashboard(){
        if(Auth::guest())
        {
            return Redirect('/home');
        }
        else
        {
            $solo_orders=array();
            $group_orders=array();
            $product=array();
            $product1=array();
            $solo=0;
            $grp=0;
            $pro=0;
            $pro1=0;
            $user = Auth::user()->id;
            $count=DB::table('orders')->where('Customer_id',$user)->where('Status','PAID')->count();
            if($count>0)
            {
                $ids=DB::table('orders')->where('Customer_id',$user)->where('Status','PAID')->get();
                foreach($ids as $id1) {
                    $id=$id1->Id;
                    $solo_order = DB::table('order_items')->join('products', 'products.Id', '=', 'order_items.product_id')->join('events', 'products.Name', '=', 'events.EventId')->where('order_id', $id)->where('EventType', 'solo')->get(['Amt', 'EventName', 'EventId', 'event']);
                    $solo += DB::table('order_items')->join('products', 'products.Id', '=', 'order_items.product_id')->join('events', 'products.Name', '=', 'events.EventId')->where('order_id', $id)->where('EventType', 'solo')->count();
                    $group_order = DB::table('order_items')->join('products', 'products.Id', '=', 'order_items.product_id')->join('events', 'products.Name', '=', 'events.EventId')->where('order_id', $id)->where('EventType', 'group')->get(['Max_allowed', 'Amt', 'AmtFor', 'ExtraAmt', 'EventName', 'event', 'EventId', 'order_items.Id']);
                    $grp += DB::table('order_items')->join('products', 'products.Id', '=', 'order_items.product_id')->join('events', 'products.Name', '=', 'events.EventId')->where('order_id', $id)->where('EventType', 'group')->count();
                    $pro+=DB::table('orders')->join('order_items','order_items.order_id','=','orders.Id')->join('products','order_items.product_id','=','products.Id')->where('products.Type','PRODUCT')->where('order_id',$id)->count();
                    $productx=DB::table('orders')->join('order_items','order_items.order_id','=','orders.Id')->join('products','order_items.product_id','=','products.Id')->where('products.Type','PRODUCT')->where('order_id',$id)->get(['Name','order_items.quantity','Amt','product_id']);
                    $pro1+=DB::table('orders')->join('order_items','order_items.order_id','=','orders.Id')->join('products','order_items.product_id','=','products.Id')->where('products.Type','PRODUCTS')->where('order_id',$id)->count();
                    $product1x=DB::table('orders')->join('order_items','order_items.order_id','=','orders.Id')->join('products','order_items.product_id','=','products.Id')->where('products.Type','PRODUCTS')->where('order_id',$id)->get(['Name','order_items.quantity','Amt','product_id','Specs']);
                    $solo_order->bill=$id;
                    $group_order->bill=$id;
                    $productx->bill=$id;
                    $product1x->bill=$id;
                    foreach ($group_order as $team) {
                        $amt = $team->AmtFor;
                        $x = $team->Id;
                        $num = DB::table('team_detail')->where('Item_Id', $x)->count();
                        if ($num > $amt) {
                            $es = ($num - $amt) * $team->ExtraAmt;
                            $team->Amt += $es;
                        }
                    }

                    array_push($solo_orders,$solo_order);
                    array_push($group_orders,$group_order);
                    array_push($product,$productx);
                    array_push($product1,$product1x);
                }

            }

            $sponsor=DB::table('sponsors')->select('SponsorName','SponsorLogo')->get();
            return view('dashboard')->with('solo_orders',$solo_orders)->with('product_count',$pro)->with('products',$product)->with('products_count',$pro1)->with('products1',$product1)->with('solo_count',$solo)->with('group_count',$grp)->with('group_orders',$group_orders)->with('sponsors',$sponsor);
        }
    }

    public function sponsor(){
        $powered=DB::table('sponsors')->where('SponsorDescription','POWERED BY')->orderBy('SponsorRank', 'asc')->get();
        $hospitality=DB::table('sponsors')->where('SponsorDescription','HOSPITALITY PARTNER')->orderBy('SponsorRank', 'asc')->get();
        $radio=DB::table('sponsors')->where('SponsorDescription','RADIO')->orderBy('SponsorRank', 'asc')->get();
        $enter=DB::table('sponsors')->where('SponsorDescription','ENTERTAINMENT')->orderBy('SponsorRank', 'asc')->get();
        $photo=DB::table('sponsors')->where('SponsorDescription','PHOTO')->orderBy('SponsorRank', 'asc')->get();
        $media=DB::table('sponsors')->where('SponsorDescription','MEDIA PARTNER')->orderBy('SponsorRank', 'asc')->get();
        $knowledge=DB::table('sponsors')->where('SponsorDescription','KNOWLEDGE PARTNER')->orderBy('SponsorRank', 'asc')->get();
        $beverage=DB::table('sponsors')->where('SponsorDescription','BEVERAGE PARTNER')->orderBy('SponsorRank', 'asc')->get();
        $merchandise=DB::table('sponsors')->where('SponsorDescription','MERCHANDISE PARTNER')->orderBy('SponsorRank', 'asc')->get();
        $promotion=DB::table('sponsors')->where('SponsorDescription','PROMOTION PARTNER')->orderBy('SponsorRank', 'asc')->get();
        $normal_sponsors=DB::table('sponsors')->where('SponsorDescription','NORMAL')->orderBy('SponsorRank', 'asc')->get();
        return view('sponsor')->with('nsponsors',$normal_sponsors)->with('powered',$powered)->with('hospitality',$hospitality)->with('media',$media)->with('knowledge',$knowledge)->with('beverage',$beverage)->with('merchandise',$merchandise)->with('promotion',$promotion)->with('enter',$enter)->with('radio',$radio)->with('photo',$photo);
    }
	
	public function cart(){
		if(Auth::guest()) 
		{
        return Redirect('/home');
		}
		else
		{
		$solo_orders='';
		$group_orders='';
		$product='';
		$product1='';
		$solo=0;
		$grp=0;
		$pro=0;
		$pro1=0;
        $user = Auth::user()->id;
        $count=DB::table('orders')->where('Customer_id',$user)->where('Status','UNPAID')->count();
        if($count>0)
        {
            $id=DB::table('orders')->where('Customer_id',$user)->where('Status','UNPAID')->value('Id');
            $solo_orders=DB::table('order_items')->join('products','products.Id','=','order_items.product_id')->join('events','products.Name','=','events.EventId')->where('order_id',$id)->where('EventType','solo')->get(['Amt','EventName','EventId','event']);
            $solo=DB::table('order_items')->join('products','products.Id','=','order_items.product_id')->join('events','products.Name','=','events.EventId')->where('order_id',$id)->where('EventType','solo')->count();
            $group_orders=DB::table('order_items')->join('products','products.Id','=','order_items.product_id')->join('events','products.Name','=','events.EventId')->where('order_id',$id)->where('EventType','group')->get(['Max_allowed','Amt','AmtFor','ExtraAmt','EventName','event','EventId','order_items.Id']);
            $grp=DB::table('order_items')->join('products','products.Id','=','order_items.product_id')->join('events','products.Name','=','events.EventId')->where('order_id',$id)->where('EventType','group')->count();
            $pro=DB::table('orders')->join('order_items','order_items.order_id','=','orders.Id')->join('products','order_items.product_id','=','products.Id')->where('products.Type','PRODUCT')->where('order_id',$id)->count();
            $product=DB::table('orders')->join('order_items','order_items.order_id','=','orders.Id')->join('products','order_items.product_id','=','products.Id')->where('products.Type','PRODUCT')->where('order_id',$id)->get(['Name','order_items.quantity','Amt','product_id']);
            $pro1=DB::table('orders')->join('order_items','order_items.order_id','=','orders.Id')->join('products','order_items.product_id','=','products.Id')->where('products.Type','PRODUCTS')->where('order_id',$id)->count();
            $product1=DB::table('orders')->join('order_items','order_items.order_id','=','orders.Id')->join('products','order_items.product_id','=','products.Id')->where('products.Type','PRODUCTS')->where('order_id',$id)->get(['Name','order_items.quantity','Amt','product_id','Specs']);
            foreach($group_orders as $team)
            {
                $amt=$team->AmtFor;
                $x=$team->Id;
                $num=DB::table('team_detail')->where('Item_Id',$x)->count();
                if($num>$amt)
                {
                    $es=($num-$amt)*$team->ExtraAmt;
                    $team->Amt+=$es;
                }
            }
        }

        $sponsor=DB::table('sponsors')->select('SponsorName','SponsorLogo')->get();
        return view('cart')->with('solo_orders',$solo_orders)->with('product_count',$pro)->with('products',$product)->with('products_count',$pro1)->with('products1',$product1)->with('solo_count',$solo)->with('group_count',$grp)->with('group_orders',$group_orders)->with('sponsors',$sponsor);
		}
	}
	
	public function inventory(){
	$products=DB::table('products')->where('Type','PRODUCT')->get();
	$products1=DB::table('products')->join('product_des','product_des.Product_Id','=','products.Id')->where('Type','PRODUCTS')->get(['Name','product_id','quantity','Image1','Types','Amt','products.Id']);
	$sponsor=DB::table('sponsors')->select('SponsorName','SponsorLogo')->get();
    return view('inventory')->with('products',$products)->with('products1',$products1)->with('sponsors',$sponsor);
	}
	
    public function commitee(){
        $faculty=DB::table('commitee')->where('Type','FACULTY')->get();
        $cultural=DB::table('commitee')->where('Type','CULTURAL')->get();
        $student=DB::table('commitee')->where('Type','STUDENT')->get();
		$sponsor=DB::table('sponsors')->select('SponsorName','SponsorLogo')->get();
        return view('commitee')->with('faculties',$faculty)->with('students',$student)->with('culturalc',$cultural)->with('sponsors',$sponsor);
    }
	public function volunteer(Request $request){
	$x=$request['id'];
	$volunteer=DB::table('commitee')->where('Type','VOLUNTEER')->where('Head',$x)->get()->toJson();
	return view('volunteer')->with('volunteer',$volunteer);
    }
    public function team_detail(Request $request){
        if(Auth::guest())
        {
            return Redirect('/home');
        }
        else {
            $x = $request['id'];
            $volunteer = DB::table('team_detail')->join('users', 'team_detail.Member_Id', '=', 'users.id')->where('Item_Id', $x)->orderBy('team_detail.Id', 'asc')->get(['Team', 'name'])->toJson();
            return view('volunteer')->with('volunteer', $volunteer);
        }
    }
    public function add_solo(Request $request){
        if(Auth::guest())
        {
            return Redirect('/home');
        }
        else
        {
            $x = $request['event'];
            $price=DB::table('products')->where('Name',$x)->value('Amt');
            $user = Auth::user()->id;
            $check = DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->count();
            if ($check == 0){
                $insert = DB::table('orders')->insert(['Customer_Id' => $user, 'Total' => $price]);
             }
             else
             {
                $tot=DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->value('Total');
                $sum=$tot+$price;
                $update = DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->Update(['Total'=>$sum]);
             }
            $order = DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->value('Id');
            $product=DB::table('products')->where('Name',$x)->value('Id');
            $insert = DB::table('order_items')->insert(['order_id' => $order, 'product_id' => $product]);
            Session::flash('status1', 'Event Added successfully!');
            Session::flash('status2', ', You can add more events,Please Go to the cart and complete your payment!');
            return redirect()->back();
        }
    }
    public function add_grp(Request $request){
        if(Auth::guest())
        {
            return Redirect('/home');
        }
        else
        {
            $x = $request['event'];
            $row=DB::table('products')->where('Name',$x)->first();
            $max=$row->Max_allowed;
            $cnt=1;
            $extra=0;
            for($i=0;$i<$max-1;$i++)
            {
            if(isset($request['student'.$i])&&trim($request['student'.$i])!='')
            {
                $cnt++;
            }
            }
            $f=$row->AmtFor;
            if($cnt>$f)
                $extra=($cnt-$f)*$row->ExtraAmt;
            $price=DB::table('products')->where('Name',$x)->value('Amt');
            $price=$price+$extra;
            $user = Auth::user()->id;
            $check = DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->count();
            if ($check == 0){
                $insert = DB::table('orders')->insert(['Customer_Id' => $user, 'Total' => $price]);
            }
            else
            {
                $tot=DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->value('Total');
                $sum=$tot+$price;
                $update = DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->Update(['Total'=>$sum]);
            }
            $order = DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->value('Id');
            $product=DB::table('products')->where('Name',$x)->value('Id');
            $insert = DB::table('order_items')->insert(['order_id' => $order, 'product_id' => $product]);
            $item=DB::table('order_items')->where('order_id',$order)->where('product_id',$product)->value('id');
            $team=$request['team_name'];
            $insert = DB::table('team_detail')->insert(['Item_Id' => $item, 'Team' => $team,'Member_Id'=>$user]);
            for($i=0;$i<$max-1;$i++) {
                if (isset($request['student' . $i]) && trim($request['student' . $i]) != '') {
                    $student=$request['student' . $i];
                    $insert = DB::table('team_detail')->insert(['Item_Id' => $item, 'Team' => $team,'Member_Id'=>$student]);
                }
            }
            Session::flash('status1', 'Event Added successfully!');
            Session::flash('status2', ', You can add more events,Please Go to the cart and complete your payment!');
            return redirect()->back();
        }
    }
    public function cancel_solo(Request $request){
        if(Auth::guest())
        {
            return Redirect('/home');
        }
        else
        {
            $x = $request['event'];
            $m=DB::table('products')->where('Name',$x)->first();
            $price=$m->Amt;
            $prod=$m->Id;
            $user = Auth::user()->id;
            $data=DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->first();
            $id=$data->Id;
            $tot=$data->Total;
            $sum=$tot-$price;
            $delitem=DB::table('order_items')->where('order_id',$id)->where('product_id',$prod)->delete();
            if($sum==0)
            {
                $del=DB::table('orders')->where('Customer_Id',$user)->where('Status','UNPAID')->delete();
            }
            else
            {
                $upd=DB::table('orders')->where('Customer_Id',$user)->where('Status','UNPAID')->update(['Total'=>$sum]);
            }
            Session::flash('status1', 'Event Removed successfully!');
            Session::flash('status2', ' You can add more events!');
            return redirect()->back();
        }
    }
    public function cancel_group(Request $request){
        if(Auth::guest())
        {
            return Redirect('/home');
        }
        else
        {
            $x = $request['event'];
            $m=DB::table('products')->where('Name',$x)->first();
            $price=$m->Amt;
            $prod=$m->Id;
            $user = Auth::user()->id;
            $data=DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->first();
            $id=$data->Id;
            $tot=$data->Total;
            $sum=$tot-$price;
            $eve=DB::table('order_items')->where('order_id',$id)->where('product_id',$prod)->first();
            $item_id=$eve->Id;
            $cnt=DB::table('team_detail')->where('item_id',$item_id)->count();
            $for=$m->AmtFor;
            if($for<$cnt) {
                $extra = ($cnt - $for) * $m->ExtraAmt;
                $sum = $sum - $extra;
            }
            $del=DB::table('team_detail')->where('item_id',$item_id)->delete();
            $delitem=DB::table('order_items')->where('order_id',$id)->where('product_id',$prod)->delete();
            if($sum==0)
            {
                $del=DB::table('orders')->where('Customer_Id',$user)->where('Status','UNPAID')->delete();
            }
            else
            {
                $upd=DB::table('orders')->where('Customer_Id',$user)->where('Status','UNPAID')->update(['Total'=>$sum]);
            }
            Session::flash('status1', 'Event Removed successfully!');
            Session::flash('status2', ' You can add more events!');
            return redirect()->back();
        }
    }
    public function productDetail($name){
        $products=DB::table('products')->where('short',$name)->first();
        $productid=$products->Id;
        $prod='NO';
        $quantity=0;
        if(Auth::guest())
        {
            $prod='NO';
        }
        else
        {
            $pa=DB::table('orders')->join('order_items','order_items.order_id','=','orders.Id')->where('product_id',$productid)->count();
            $quantity=DB::table('orders')->join('order_items','order_items.order_id','=','orders.Id')->where('product_id',$productid)->value('quantity');
            if($pa>0)
                $prod='YES';
        }
        $images=DB::table('product_images')->where('Product_Id',$productid)->get();
        $img_cnt=DB::table('product_images')->where('Product_Id',$productid)->count();
        $pro=DB::table('product_des')->where('Product_Id',$productid)->first();
        $sponsor=DB::table('sponsors')->select('SponsorName','SponsorLogo')->get();
        return view('productDetail')->with('product_added',$prod)->with('products',$products)->with('sponsors',$sponsor)->with('quantity',$quantity)->with('images',$images)->with('cnt',$img_cnt)->with('des',$pro);
    }
    public function remove_hostel()
    {
        if(Auth::guest())
        {
            return Redirect('/home');
        }
        else {
            $user = Auth::user()->id;
            $update = DB::table('users')->where('id', $user)->update(['accomodation' => 'No']);
        }
        return redirect()->back();
    }
    public function add_hostel()
    {
        if(Auth::guest())
        {
            return Redirect('/home');
        }
        else {
            $user = Auth::user()->id;
            $update = DB::table('users')->where('id', $user)->update(['accomodation' => 'YES']);
        }
        return redirect()->back();
    }
    public function add_product(Request $request){
        if(Auth::guest())
        {
            return Redirect('/home');
        }
        else
        {
            $x = $request['product'];
            $price=DB::table('products')->where('Type','PRODUCT')->where('Id',$x)->value('Amt');
            $user = Auth::user()->id;
            $check = DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->count();
            if ($check == 0){
                $insert = DB::table('orders')->insert(['Customer_Id' => $user, 'Total' => $price]);
            }
            else
            {
                $tot=DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->value('Total');
                $sum=$tot+$price;
                $update = DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->Update(['Total'=>$sum]);
            }
            $order = DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->value('Id');
            $insert = DB::table('order_items')->insert(['order_id' => $order, 'product_id' => $x,'quantity'=>'1']);
            Session::flash('status1', 'Product Added successfully!');
            Session::flash('status2', ', You can add more products. Please Go to the cart and complete your payment!');
            return redirect()->back();
        }
    }
    public function cancel_product(Request $request){
        if(Auth::guest())
        {
            return Redirect('/home');
        }
        else
        {
            $x = $request['product'];
            if(isset($request['quantity']))
            $quantity=$request['quantity'];
            if(isset($request['specs']))
                $specs=$request['specs'];
            $m=DB::table('products')->where('Id',$x)->first();
            $price=$m->Amt;
            $prod=$m->Id;
            $user = Auth::user()->id;
            $data=DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->first();
            $id=$data->Id;
            $tot=$data->Total;
            $sum=$tot-($price*$quantity);
            if(isset($request['specs']))
            $delitem=DB::table('order_items')->where('order_id',$id)->where('product_id',$prod)->where('Specs',$specs)->delete();
            else
            $delitem=DB::table('order_items')->where('order_id',$id)->where('product_id',$prod)->delete();
            if($sum==0)
            {
                $del=DB::table('orders')->where('Customer_Id',$user)->where('Status','UNPAID')->delete();
            }
            else
            {
                $upd=DB::table('orders')->where('Customer_Id',$user)->where('Status','UNPAID')->update(['Total'=>$sum]);
            }
            Session::flash('status1', 'Product Removed successfully!');
            Session::flash('status2', ' You can add more Products!');
            return redirect()->back();
        }
    }
    public function funeventDetail($name){
        $event=DB::table('fun_events')->where('EventCode',$name)->first();
        $sponsor=DB::table('sponsors')->select('SponsorName','SponsorLogo')->get();

        return view('funeventDetail')->with('event',$event)->with('sponsors',$sponsor);
    }
    public function update_qty(Request $request){
        if(Auth::guest())
        {
            return Redirect('/home');
        }
        else {
            $qty=$request['qty'];
            $id = $request['product'];
            if(isset($request['specs']))
                $specs=$request['specs'];
            $user=Auth::user()->id;
            $oid=DB::table('orders')->where('Status','UNPAID')->where('Customer_Id',$user)->value('Id');
            if(isset($request['specs']))
            $old_qty=DB::table('order_items')->where('order_id',$oid)->where('product_id',$id)->where('Specs',$specs)->value('quantity');
            else
            $old_qty=DB::table('order_items')->where('order_id',$oid)->where('product_id',$id)->value('quantity');
            $m=DB::table('products')->where('Id',$id)->first();
            $price=$m->Amt;
            $sum=($old_qty*$price);
            $new=($qty*$price);
            $myprice=DB::table('orders')->where('Customer_Id',$user)->where('Status','UNPAID')->value('Total');
            $add=$myprice+$new-$sum;
            $upd=DB::table('orders')->where('Customer_Id',$user)->where('Status','UNPAID')->update(['Total'=>$add]);
            if(isset($request['specs']))
            $upd=DB::table('order_items')->where('order_id',$oid)->where('product_id',$id)->where('Specs',$specs)->update(['quantity'=>$qty]);
            else
            $upd=DB::table('order_items')->where('order_id',$oid)->where('product_id',$id)->update(['quantity'=>$qty]);

        }
        return redirect()->back();
    }
    public function product_add(Request $request){
        if(Auth::guest())
        {
            return Redirect('/home');
        }
        else
        {
            $x = $request['product'];
            if(isset($request['extra'])) {
                $extra = $request['extra'];
            }
            $price=DB::table('products')->where('Type','PRODUCTS')->where('Id',$x)->value('Amt');
            $user = Auth::user()->id;
            $check = DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->count();
            if ($check == 0){
                $insert = DB::table('orders')->insert(['Customer_Id' => $user, 'Total' => $price]);
            }
            else
            {
                $tot=DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->value('Total');
                $sum=$tot+$price;
                $update = DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->Update(['Total'=>$sum]);
            }
            $order = DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->value('Id');
            if(isset($request['extra']))
            {
                $check = DB::table('order_items')->where('order_id', $order)->where('product_id', $x)->where('Specs',$extra)->count();
                if ($check > 0) {
                    $value = DB::table('order_items')->where('order_id', $order)->where('product_id', $x)->where('Specs',$extra)->value('quantity');
                    $value++;
                    $update = DB::table('order_items')->where('order_id', $order)->where('product_id', $x)->where('Specs',$extra)->update(['quantity' => $value]);
                } else {
                    $insert = DB::table('order_items')->insert(['order_id' => $order, 'product_id' => $x, 'quantity' => '1','Specs'=>$extra]);
                }
            }
            else {
                $check = DB::table('order_items')->where('order_id', $order)->where('product_id', $x)->count();
                if ($check > 0) {
                    $value = DB::table('order_items')->where('order_id', $order)->where('product_id', $x)->value('quantity');
                    $value++;
                    $update = DB::table('order_items')->where('order_id', $order)->where('product_id', $x)->update(['quantity' => $value]);
                } else {
                    $insert = DB::table('order_items')->insert(['order_id' => $order, 'product_id' => $x, 'quantity' => '1']);
                }
            }
            Session::flash('status1', 'Product Added successfully!');
            Session::flash('status2', ', You can add more products. Please Go to the cart and complete your payment!');
            return redirect()->back();
        }
    }
    public function payment(Request $request)
    {
        if(Auth::guest()) {
            return Redirect('/home');
        }
        else {
        $x='';
	$order='';
            $add=0;
            $user=Auth::user()->id;
            $acc = Auth::user()->accomodation;
            if($acc=='YES')
                $add=400;
            $order=DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->first();
            $num=DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->count();
            if($num==0&&$acc!='YES') {
                return Redirect('/home');
            }
	if($num!=0){
	$o=$order->Id;
	$order_id=DB::table('order_detail')->insert(['User'=>$user,'order_id'=>$o]);
	$order_id=DB::table('order_detail')->where('User',$user)->where('order_id',$o)->where('Status','PENDING')->orderBy('id', 'desc')->first();
	$x=$order_id->id;
	}
	if($x=='')
	{
	$order_id=DB::table('order_detail')->insert(['User'=>$user,'order_id'=>'HOSTEL'.$user]);
	$order_id=DB::table('order_detail')->where('User',$user)->where('order_id','HOSTEL'.$user)->where('Status','PENDING')->orderBy('id', 'desc')->first();
	}
            return view('payment')->with('order',$order)->with('add',$add)->with('order_id',$x);
        }
    }
    public function complete(Request $request)
    {
        if(Auth::guest()) {
            return Redirect('/home');
        }
        else {
            header("Pragma: no-cache");
            header("Cache-Control: no-cache");
            header("Expires: 0");
            $user=Auth::user()->id;
            require_once("PaytmKit/lib/config_paytm.php");
            require_once("PaytmKit/lib/encdec_paytm.php");
            $paytmChecksum = "";
            $paramList = array();
            $isValidChecksum = "FALSE";
            $paramList = $_POST;
            $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
            $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
            $o=$order=DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->value('Id');
		$s=$_POST["STATUS"];
$order_id=DB::table('order_detail')->where('User',$user)->where('order_id',$o)->where('Status','PENDING')->update(['Status'=>$s]);


            if($isValidChecksum == "TRUE") {
                if ($_POST["STATUS"] == "TXN_SUCCESS") {
                    $acc = Auth::user()->accomodation;
                    $today=date('Y-m-d');
$status=$_POST['TXNID'];
                    if($acc=='YES')
{
                        $order_update=DB::table('users')->where('id', $user)->update(['accomodation'=>'Yes']);
}
$o=$order=DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->value('Id');
$order=DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->update(['date'=>$today,'Payment_Id'=>$status,'Status'=>'PAID']);
Session::flash('status1', 'Payment succesful!');
            Session::flash('status2', ', You can participate in more events!');
$s=$_POST["STATUS"];
$order_id=DB::table('order_detail')->where('User',$user)->where('order_id',$o)->where('Status','PENDING')->update(['Status'=>$s]);
return Redirect('/dashboard');

                }
                else {
$o=$order=DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->value('Id');
$s=$_POST["STATUS"];
$order_id=DB::table('order_detail')->where('User',$user)->where('order_id',$o)->where('Status','PENDING')->update(['Status'=>$s]);
Session::flash('status1', 'Payment Unsuccesful!');
            Session::flash('status2', ', Please Try again!');
                    return Redirect('/cart');
                }
                }
            else {
$o=$order=DB::table('orders')->where('Customer_Id', $user)->where('Status','UNPAID')->value('Id');
$s="INVALID";
$order_id=DB::table('order_detail')->where('User',$user)->where('order_id',$o)->where('Status','PENDING')->update(['Status'=>$s]);
                return Redirect('/home');
            }

        }
    }
}
