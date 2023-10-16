<?php

include 'config.php';


$data = file_get_contents('php://input');

$logFile = "webhooksentdata.json";
$log = fopen($logFile,"a");
fwrite($log,$data);
fclose($log);


$getdata = json_decode($data.true);
$chatId = $getdata['message']['chat']['id'];
$username = $getdata['message']['from']['username'];
$usermsg = $getdata['message']['text'];
$chatId=(int)$chatId;


$botMessage = "你好 ";
$paraments = array(
    "chat_id"=>$chatId,
    "text"=>$botMessage.$username,
    "parse_mode"=>"html"
);

$apiUrl = "https://api.telegram.org/bot{$BOT_TOKEN}/sendMessage";
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$apiUrl);
curl_setopt($ch,CURLOPT_POST,count($paraments));
curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($paraments));
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$result = curl_exec($ch);
