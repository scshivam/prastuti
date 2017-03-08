<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Check Out Page</title>
    <meta name="GENERATOR" content="Evrsoft First Page">
</head>
<body>
<form method="post" id="autosubmit" action="{!! URL::to('PaytmKit/pgRedirect.php') !!}">
	@if($order_id!='')
	<input type="hidden" name="ORDER_ID" value="{!! 'ORD'.$order_id !!}">
	@else
	<input type="hidden" name="ORDER_ID" value="{!! rand(1000,9999).'HOSTEL'.Auth::user()->id !!}">
	@endif
    <input type="hidden" name="CUST_ID" value="{!! 'PRA'.Auth::user()->id !!}"></td>
    <input type="hidden" name="INDUSTRY_TYPE_ID" value="PrivateEducation"></td>
    <input type="hidden" name="CHANNEL_ID" value="WEB">
    @if($order=='')
<input type="hidden" name="TXN_AMOUNT" value="{!! $add !!}">
    @else
    <input type="hidden" name="TXN_AMOUNT" value="{!! $order->Total+$add !!}">
    @endif
</form>
<script>
    document.getElementById('autosubmit').submit();
</script>
</body>
</html>