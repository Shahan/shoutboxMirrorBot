<?php
/*
	github.com/Shahan
	chat/add_msg.php : used by ajax request, this file adds msgs to chat DB
*/

//	TELEGRAM BOT API
define('BOT_TOKEN', '12356789:sdfghjklzxcvbnmwertyuioertyu');
define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');
define('CHAT_ID', 23456789); //Group Chat ID

$registered_users = array("1234567" => "Shahan"); //registered users here

function apiRequestWebhook($method, $parameters) {
  if (!is_string($method)) {
    error_log("Method name must be a string\n");
    return false;
  }

  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    error_log("Parameters must be an array\n");
    return false;
  }

  $parameters["method"] = $method;

  header("Content-Type: application/json");
  echo json_encode($parameters);
  return true;
}

function exec_curl_request($handle) {
  $response = curl_exec($handle);

  if ($response === false) {
    $errno = curl_errno($handle);
    $error = curl_error($handle);
    error_log("Curl returned error $errno: $error\n");
    curl_close($handle);
    return false;
  }

  $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
  curl_close($handle);

  if ($http_code >= 500) {
    // do not wat to DDOS server if something goes wrong
    sleep(10);
    return false;
  } else if ($http_code != 200) {
    $response = json_decode($response, true);
    error_log("Request has failed with error {$response['error_code']}: {$response['description']}\n");
    if ($http_code == 401) {
      throw new Exception('Invalid access token provided');
    }
    return false;
  } else {
    $response = json_decode($response, true);
    if (isset($response['description'])) {
      error_log("Request was successfull: {$response['description']}\n");
    }
    $response = $response['result'];
  }

  return $response;
}

function apiRequest($method, $parameters) {
  if (!is_string($method)) {
    error_log("Method name must be a string\n");
    return false;
  }

  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    error_log("Parameters must be an array\n");
    return false;
  }

  foreach ($parameters as $key => &$val) {
    // encoding to JSON array parameters, for example reply_markup
    if (!is_numeric($val) && !is_string($val)) {
      $val = json_encode($val);
    }
  }
  $url = API_URL.$method.'?'.http_build_query($parameters);

  $handle = curl_init($url);
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($handle, CURLOPT_TIMEOUT, 60);

  return exec_curl_request($handle);
}


//check if we have smth to add
if(isset($_POST['msg']) && $_POST['msg']!="" && $_POST['msg']!=" ")
{	
	//for telegram bot
	$telegram_from = "";
	$telegram_msg = "";
	$is_registered = false;
	
	//check if we have admin
	if(isset($_POST['ipod_id']))
	{
		$from = $registered_users[$_POST['ipod_id']];
		if($from && $from != "")
		{
			$is_registered = true;
		}
	}
	if($is_registered == false) 
	{
		$from=$_POST['user'];
	}
	
	//Set variables
	$telegram_from = "`".$from.": `";
	if($is_registered == true)
	{
		$from='<font color="#000088"><b><a href="http://ipod-clan.com/members/" target="_blank">[iPod]</a></b>' .$from . '</font>'; 
	}
	else $from=$from . '<font color="#ccc">(guest)</font>'; 	
	$to = 'all';
	$message=addslashes(htmlspecialchars($_POST['msg'], ENT_QUOTES));
	$telegram_msg = $_POST['msg'];
	apiRequest("sendMessage", array('chat_id' => CHAT_ID, "text" => $telegram_from . $telegram_msg));
	$when = date("Y-m-d H:i:s");
	$room = strval(1);
	$extra = 'None';
	
	
	//Connect to DB
	include("bd.php");
	//Add to DB
	$res=mysql_query("INSERT INTO `messages` (`from`,`to`,`message`,`when`,`room`,`extra`) VALUES ('$from','$to','$message','$when','$room','$extra') ");
}
?>