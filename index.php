<?php
//-----------------config--------------->
$con = pg_connect("host=ec2-54-217-213-79.eu-west-1.compute.amazonaws.com port=5432 dbname=d9jr6ppkc3n0qo user=wbrtxkjvgbuheb password=da54034e79f63243b0fccebacdc8b7954b928432a9977635866e32094a204d6e");
if(!$con) {
    die('PG Connection Error');
}
//--------------api---------------->
header("Content-Type:application/json");
if (isset($_GET['url']) && $_GET['url']!="") {
    $longurl = $_GET['url'];
    $shortenid = $_GET['id'];
    $result = pg_query($con,"INSERT INTO urls (shortenid,longurl) VALUES('$shortenid','$longurl');");
    $result = pg_query($con,"SELECT * FROM urls WHERE longurl='$longurl' AND shortenid='$shortenid';");
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
