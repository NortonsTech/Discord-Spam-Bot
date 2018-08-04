<?php
error_reporting(0);

$filename2 = "tokens.txt";
$filename = "working.txt";
$stackfile = 'working.txt';
$invite = $_POST['join'];
$msg = $_POST['message'];
$channelid = $_POST['channelid'];
$load = $_POST['load'];

// Open the file
$fp2 = @fopen($filename2, 'r'); 
$fp = @fopen($filename, 'r'); 

// Add each line to an array
if ($fp2) {
   $array2 = explode("\n", fread($fp2, filesize($filename2)));
}

// Add each line to an array
if ($fp) {
   $array = explode("\n", fread($fp, filesize($filename)));
}

$stackTokens = array();

$valid = 0;
if (isset($load)) {
	
//clear working file
$myfile = fopen("working.txt", "w") or die("Unable to open file!");
fwrite($myfile, "");
fclose($myfile);

foreach ($array2 as &$token) {
	
	   $url = 'https://discordapp.com/api/v6/invite/1337';
       $ch = curl_init($url);
        $options = array(
                CURLOPT_RETURNTRANSFER => true,         // return web page
                CURLOPT_HEADER         => false,        // don't return headers
                CURLOPT_FOLLOWLOCATION => false,         // follow redirects
               // CURLOPT_ENCODING       => "utf-8",           // handle all encodings
                CURLOPT_AUTOREFERER    => true,         // set referer on redirect
                CURLOPT_CONNECTTIMEOUT => 20,          // timeout on connect
                CURLOPT_TIMEOUT        => 20,          // timeout on response
                CURLOPT_POST            => 1,            // i am sending post data
                CURLOPT_POSTFIELDS     => $request,    // this are my post vars
                CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
                CURLOPT_SSL_VERIFYPEER => false,        //
                CURLOPT_VERBOSE        => 1,
                CURLOPT_HTTPHEADER     => array(
                    "Authorization: $token"
                )

        );

        curl_setopt_array($ch,$options);
        $data = curl_exec($ch);
        $curl_errno = curl_errno($ch);
        $curl_error = curl_error($ch);
        //echo $curl_errno;
        //echo $curl_error;
        curl_close($ch);
		
		if ($data == '{"code": 0, "message": "401: Unauthorized"}') {
		} else {
			$myfile = fopen($stackfile, "a") or die("Unable to open file!");
			$txt = "user id date";
			fwrite($myfile, "\n". $token);
			fclose($myfile);
			$valid = $valid + 1;
		}
    }
	echo "<h3>YOU HAVE ".$valid." VALID TOKEN(S)!</h2>All echo'd to working.txt.";
}

if (isset($invite)) {

if (empty($invite)) {
	die("Please fill in an invite!");
}

foreach ($array as &$token) {
	
	   $url = 'https://discordapp.com/api/v6/invite/'.$invite;
       $ch = curl_init($url);
        $options = array(
                CURLOPT_RETURNTRANSFER => true,         // return web page
                CURLOPT_HEADER         => false,        // don't return headers
                CURLOPT_FOLLOWLOCATION => false,         // follow redirects
               // CURLOPT_ENCODING       => "utf-8",           // handle all encodings
                CURLOPT_AUTOREFERER    => true,         // set referer on redirect
                CURLOPT_CONNECTTIMEOUT => 20,          // timeout on connect
                CURLOPT_TIMEOUT        => 20,          // timeout on response
                CURLOPT_POST            => 1,            // i am sending post data
                CURLOPT_POSTFIELDS     => $request,    // this are my post vars
                CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
                CURLOPT_SSL_VERIFYPEER => false,        //
                CURLOPT_VERBOSE        => 1,
                CURLOPT_HTTPHEADER     => array(
                    "Authorization: $token"
                )

        );

        curl_setopt_array($ch,$options);
        $data = curl_exec($ch);
        $curl_errno = curl_errno($ch);
        $curl_error = curl_error($ch);
        //echo $curl_errno;
        //echo $curl_error;
        curl_close($ch);
		
		if(strpos($data, "Unknown Invite")){
			die("Invite Invalid!");
		}
		
		$warning = 0;
		
		if ($data == '{"code": 0, "message": "401: Unauthorized"}') {
			$warning = 1;
		}
    }
	if ($warning == 1) {
		echo "Operation went WITH one hitch. Some tokens don't work. Please LOAD your tokens again!";
	} else {
		echo "Operation successfull.";
	}
}

if (isset($channelid)) {
	
if (empty($channelid)) {
	die("Please fill in a channelid!");
}

if (empty($msg)) {
	die("Please fill in a message!");
}
	
while(true) {
foreach ($array as &$token) {
	
	   $url = 'https://discordapp.com/api/v6/channels/'.$channelid.'/messages';
	   
		$request2 = array(
			'content'      => $msg
		);
		
		$request = json_encode($request2);
       $ch = curl_init($url);
        $options = array(
                CURLOPT_RETURNTRANSFER => true,         // return web page
                CURLOPT_HEADER         => false,        // don't return headers
                CURLOPT_FOLLOWLOCATION => false,         // follow redirects
               // CURLOPT_ENCODING       => "utf-8",           // handle all encodings
                CURLOPT_AUTOREFERER    => true,         // set referer on redirect
                CURLOPT_CONNECTTIMEOUT => 20,          // timeout on connect
                CURLOPT_TIMEOUT        => 20,          // timeout on response
                CURLOPT_POST            => 1,            // i am sending post data
                CURLOPT_POSTFIELDS     => $request,    // this are my post vars
                CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
                CURLOPT_SSL_VERIFYPEER => false,        //
                CURLOPT_VERBOSE        => 1,
                CURLOPT_HTTPHEADER     => array(
                    "Authorization: $token"
                )

        );

        curl_setopt_array($ch,$options);
        $data = curl_exec($ch);
        $curl_errno = curl_errno($ch);
        $curl_error = curl_error($ch);
        //echo $curl_errno;
        //echo $curl_error;
        curl_close($ch);
		
		if(strpos($data, "snowflake")){
			die("Channel ID Invalid!");
		}
		
		$warning = 0;
		
		if ($data == '{"code": 0, "message": "401: Unauthorized"}') {
			$warning = 1;
		}
    }
}
	if ($warning == 1) {
		echo "Operation went WITH one hitch. Some tokens don't work. Please LOAD your tokens again!";
		echo "<br>$data";
	} else {
		echo "Operation successfull.";
	}
}