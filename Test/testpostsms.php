<?php
$url = 'http://ec2-54-213-217-12.us-west-2.compute.amazonaws.com/demo/Transaction.php';
$data = array();

$data['TransactionId'] = time();
$data['UserId'] = '2';
$data['CurrencyAmount'] = 2;

$secret = 'NwvprhfBkGuPJnjJp77UPJWJUpgC7mLz';
$hash = hash_hmac("sha1", $secret.$data['TransactionId'].$data['UserId'].$data['CurrencyAmount'], $secret);
$data['Verifier'] = $hash;

$json = json_encode($data);
$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
var_dump($response);
//////////////////////////////////////////

$url = 'http://ec2-54-213-217-12.us-west-2.compute.amazonaws.com/demo/TransactionStats.php';
$data = array();

$data['UserId'] = '2';
$json = json_encode($data);
$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
var_dump($response);
///////////////////////////////////////////

$url = 'http://ec2-54-213-217-12.us-west-2.compute.amazonaws.com/demo/ScorePost.php';
$data = array();

$data['UserId'] = random_int(1,10);
$data['LeaderboardId'] = random_int(1,2);
$data['Score'] = random_int(100,1000);
$json = json_encode($data);
$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
var_dump($response);
///////////////////////////////////////////

$url = 'http://ec2-54-213-217-12.us-west-2.compute.amazonaws.com/demo/LeaderboardGet.php';
$data = array();

$data['UserId'] = random_int(1,1);
$data['LeaderboardId'] = random_int(1,2);
$data['Offset'] = random_int(1,3);
$data['Limit'] = random_int(1,3);
$json = json_encode($data);
$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
var_dump($response);
///////////////////////////////////////////

$url = 'http://ec2-54-213-217-12.us-west-2.compute.amazonaws.com/demo/UserSave.php';
$data = array();

$data['UserId'] = 503;

$arr = array();
$arr['a'] = random_int (1,10);
$arr['b'] = array();
$arr['b']['b1'] = random_int(1,10);

$input = array("Neo", "Morpheus", "Trinity", "Cypher", "Tank");
$rand_keys = array_rand($input, 2);

$arr[$rand_keys[0]] = random_int(1,10);
$arr[$rand_keys[1]] = random_int(1,10);

$data['Data'] = $arr;

$json = json_encode($data);
$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
var_dump($response);
///////////////////////////////////////////

$url = 'http://ec2-54-213-217-12.us-west-2.compute.amazonaws.com/demo/UserLoad.php';
$data = array();

$data['UserId'] = 503;
$json = json_encode($data);
$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
var_dump($response);