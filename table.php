<?php
$con = pg_connect("host=ec2-54-217-213-79.eu-west-1.compute.amazonaws.com port=5432 dbname=d9jr6ppkc3n0qo user=wbrtxkjvgbuheb password=da54034e79f63243b0fccebacdc8b7954b928432a9977635866e32094a204d6e");
if(!$con) {
    die('PG Connection Error');
}
pg_query($con,"CREATE TABLE urls (
	id INT PRIMARY KEY,
	shortenid VARCHAR ( 50 ) UNIQUE NOT NULL,
	longurl VARCHAR ( 500 ) UNIQUE NOT NULL );");
