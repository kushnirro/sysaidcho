<?php
// $sr_url='https://sdmonitor.sebn.com/sd-monitor-api/servicerequests?category=&assignedGroup=&statusAny=&assignedLocation=UA-Chortkiv';
$proxyUsername = 'USER';
$proxyPassword = 'PASSWORD';
$proxy='10.180.2.3:8080';
$curl = curl_init("https://sdmonitor.sebn.com/sd-monitor-api/servicerequests?category=&assignedGroup=&statusAny=&assignedLocation=UA-Chortkiv");
// if (isset($proxy)) 
// {curl_setopt($curl, CURLOPT_PROXY, $proxy);}
curl_setopt($curl, CURLOPT_CUSTOMREQUEST,'GET');
curl_setopt($curl, CURLOPT_HTTPGET, true);
curl_setopt($curl, CURLOPT_USERPWD, 'USER:PASSWORD');
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($curl, CURLOPT_HTTPPROXYTUNNEL , 1);
// curl_setopt($curl, CURLINFO_HEADER_OUT, true);   
curl_setopt($curl, CURLOPT_PROXY, $proxy);
// curl_setopt($curl, CURLOPT_VERBOSE, 1);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);    
curl_setopt($curl, CURLOPT_PROXYUSERPWD, 'USER:PASSWORD');
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Content-Type: json',
    'Accept: application/json'   
       ));
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($curl, CURLOPT_TIMEOUT, 30);
// curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

$reply=json_decode(curl_exec($curl),true);
curl_close($curl);

print_r($reply);

foreach ($reply as $srs){
    // echo $srs[id];
    // echo $srs[description];
    // echo $srs[status];

 if ($srs[status]==1){
    // echo $srs[id];
    // echo $srs[title];
    // echo $srs[status];

    // $passed_time=(ceil ((time()-(substr($srs[creationDate], 0, -3)))/60));
  $botToken="1034861711:AAGnIxmV0KDhAwsPvys_-SSmN8SgyoovSjU";
  $website="https://api.telegram.org/bot".$botToken;
  $chatId=-325204411;
  
  //** ===>>>NOTE: this chatId MUST be the chat_id of a person, NOT another bot chatId !!!**
  // $message=urlencode('Glek allert!! '.$srs[id].'\n Title '.$srs[title].'\n Description '.$srs[description].'\n Glek_name '.$srs[requestUser]);
  $params=[
      'chat_id'=>$chatId, 
      'text'=>'SysAid Alert!! '.$srs[id]."\n".'Title: '.$srs[title]."\n".'Description: '.$srs[description]."\n".'User_name:'.$srs[requestUser],
  ];
    $ch = curl_init($website.'/sendMessage');
  curl_setopt($ch, CURLOPT_PROXY, $proxy);
  curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'USER:PASSWORD');
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $result = curl_exec($ch);
      curl_close($ch);
      
    // echo $srs[id];
    // echo $srs[description];
    // echo $srs[status];
    }
   
 }
 ?>
 
