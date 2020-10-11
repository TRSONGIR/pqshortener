<?php
//-----------------config--------------->
$con = pg_connect("host=ec2-34-253-148-186.eu-west-1.compute.amazonaws.com port=5432 dbname=d5pj2kv8rvk48l user=woziqaocstlvip password=3f440fcba04d85a681467952a3675d13ae4af23d8286b6c799f7f9b76e535825");
if(!$con) {
    die('PG Connection Error');
}
//--------------api---------------->
header("Content-Type:application/json");
if (isset($_GET['url']) && $_GET['url']!="") {
    $longurl = $_GET['url'];
    $mychars = "0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
    $shortenid = substr(str_shuffle($mychars),5,8);
    pg_query($con,"INSERT INTO urls (shortenid,longurl) VALUES('$shortenid','$longurl')");
$result = pg_query($con,"SELECT * FROM urls WHERE longurl='$longurl'");
if(pg_fetch_row($result)>0){
$row = pg_fetch_array($result);
$shortenid = $row['shortenid'];
response($longurl, $shortenid);
pg_close($con);
}else{
response(NULL, 200);
}
}else{
response(NULL, 400);
}

function response($order_id,$amount){
$response['longurl'] = $order_id;
$response['shortenid'] = $amount;
$json_response = json_encode($response);
echo $json_response;
}
