<?php
class Judge_loginn extends CI_Model {
 // your code


		public function judge_event()
		{
      $data=array('error'=>true);
			$user=$this->input->post('qrcode');

     $this->db->select('eventid');
     $query = $this->db->where('hash3',$user)->get('judge_login');
     $res = $query->row();
       if($query->num_rows()>0){

       $a = $res->eventid;
       $this->db->select('event,EventName');
       $query = $this->db->where('Eventid',$a)->get('events');
       $result = $query->row_array();
       $data['error']=false;
       $data['event']=$result['EventName'];
       $data['event_type']=$result['event'];
       if($this->input->post('pass')!=NULL){
        $event=$a;
        $check=$this->db->where('EventId',$event)->get('results');
        $num=$check->num_rows();
        if($num>0)
        {
          $data=array('error'=>true,'msg'=>'Result Already Inserted');
        }
        else
        {
        $pass = $this->input->post('pass');
        $this->db->select('*');
        $query = $this->db->where('hash3',$user)->where('hash2',$pass)->get('judge_login');
        $res = $query->num_rows();
        if($res>0){
          $data['error']=false;
          $data['msg']="Login Successful";
          $this->session->set_userdata('Hash1',$a);
          $this->session->set_userdata('Hash3',$user);
          $this->session->set_userdata('loggedin',true);
        }
        else{
          $data['error']=true;
          $data['msg']="Invalid Login Credentials";
        }
        }
       }
     }
     else {
       $data['error']=true;
       $data['msg']="Invalid QR Code";
     }
     echo json_encode($data);
    }
  public function judgement()
  {
    if($this->session->userdata('loggedin')==false)
      {
        $data=array('error'=>true,'msg'=>'Invalid Session');
      }
      else
      {
    $event=$this->session->userdata('Hash1');
    $this->db->select('Id,Attr,Max');
    $query=$this->db->where('EventId',$event)->get('attributes');
    $attrib=$query->result();
    $this->db->select('event,EventName,EventType');
       $query = $this->db->where('Eventid',$event)->get('events');
       $result = $query->row_array();
       $event_type=$result['EventType'];
       $name=$result['EventName'];
       $eve=$result['event'];
       if($event_type=='solo'){
    $qry=$this->db->query("SELECT u.id,u.name,u.mobile,u.email,e.EventName,c.CollegeName as cn1,u.collegeName as cn2,o.Status,o.Total FROM order_items oi,orders o,users u,products p,events e,colleges c WHERE oi.order_id=o.Id AND o.Customer_Id=u.id AND p.Id=oi.product_id AND p.Name=e.EventId AND p.Type='SOLO' AND c.CollegeId=u.college And e.EventId=$event AND o.Status='PAID'");
    $res=$qry->result();
  }
  else
    if($event_type=='group'){
      $qry=$this->db->query("SELECT u.id,u.name,u.mobile,u.email,e.EventName,c.CollegeName as cn1,u.collegeName as cn2,o.Status,o.Total,td.Team,td.Member_Id FROM order_items oi,orders o,team_detail td,users u,products p,events e,colleges c WHERE oi.order_id=o.Id AND o.Customer_Id=u.id AND td.Item_Id=oi.Id AND td.Member_Id=o.Customer_Id AND p.Id=oi.product_id AND p.Name=e.EventId AND p.Type='GROUP' AND c.CollegeId=u.college And e.EventId=$event AND o.Status='PAID'");
    $res=$qry->result();
    }
    $data=array('error'=>false,'attributes'=>$attrib,'participants'=>$res,'EventName'=>$name,'Event'=>$eve,'EventType'=>$event_type);
  }
    echo json_encode($data);
  }
  public function fill()
  {
    if($this->session->userdata('loggedin')==false)
      {
        $data=array('error'=>true,'msg'=>'Invalid Session');
      }
      else
      {
        $event=$this->session->userdata('Hash1');
        $check=$this->db->where('EventId',$event)->get('results');
        $num=$check->num_rows();
        if($num>0)
        {
          $data=array('error'=>true,'msg'=>'Already Inserted');
        }
        else
        {
          $arr=array();
          $inp=$this->input->post('data');
          $arr=json_decode($inp,true);
          foreach($arr as $ar)
          {
            $stdid=$ar['studentId'];
            $attid=$ar['attId'];
            $score=$ar['score'];
          $x=array('EventId'=>$event,'AttributeId'=>$attid,'UserId'=>$stdid,'Marks'=>$score);
          $this->db->insert('results',$x);
          $data=array('error'=>false,'msg'=>'Successfully Inserted');
          }
        }
      }
      echo json_encode($data);
  }
	}
?>
