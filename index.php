<?php

include 'config.php';
$setuApi = "https://image.anosu.top/pixiv";

$data = file_get_contents('php://input');

$logFile = "webhooksentdata.json";
$log = fopen($logFile,"a");
fwrite($log,$data);
fclose($log);


$getdata = json_decode($data,true);
$userId = $getdata['message']['from']['id'];
$username = $getdata['message']['from']['username'];
$usermsg = $getdata['message']['text'];
$chatId = $getdata['message']['chat']['id'];
if($usermsg[0]=='/'){

    $apiUrl = "https://api.telegram.org/bot{$BOT_TOKEN}/sendPhoto?chat_id=".$chatId;
    $img = 'fake';
    file_put_contents($img,file_get_contents($setuApi));
    $paraments = array(
        "chat_id"=>$chatId,
        "photo"=>new CURLFile(realpath($img)),
        //"parse_mode"=>"html"
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type:multipart/form-data"
         ));
    curl_setopt($ch, CURLOPT_URL, $apiUrl); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $paraments); 
    $result = curl_exec($ch);
    curl_close($ch);

}else{
        $botMessage = "你好 ";
        $paraments = array(
            "chat_id"=>$userId,
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
        curl_close($ch);

}


