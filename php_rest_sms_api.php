<?
/*
* функция передачи сообщения
*/
function send($host, $port, $login, $password, $phone, $text, $sender = false)
{
	$fp = fsockopen($host, $port, $errno, $errstr);
	if (!$fp) {
		return "errno: $errno \nerrstr: $errstr\n";
	}
	fwrite($fp, "GET /send/" .
		"?phone=" . rawurlencode($phone) .
		"&text=" . rawurlencode($text) .
		($sender ? "&sender=" . rawurlencode($sender) : "") .
		"  HTTP/1.0\n");
	fwrite($fp, "Host: " . $host . "\r\n");
	if ($login != "") {
		fwrite($fp, "Authorization: Basic " .
			base64_encode($login. ":" . $password) . "\n");
	}
	fwrite($fp, "\n");
	$response = "";
	while(!feof($fp)) {
		$response .= fread($fp, 1);
	}
	fclose($fp);
	list($other, $responseBody) = explode("\r\n\r\n", $response, 2);
	return $responseBody;
}
/*
* использование функции передачи сообщения
*/
echo send("api.smsbliss.net", 80, "api_login", "api_password",
		  "71234567890", "text here", "SmsBliss");
/*
* функция проверки состояния отправленного сообщения
*/
function status($host, $port, $login, $password, $sms_id)
{
	$fp = fsockopen($host, $port, $errno, $errstr);
	if (!$fp) {
		return "errno: $errno \nerrstr: $errstr\n";
	}
	fwrite($fp, "GET /status/" .
		"?id=" . $sms_id .
		"  HTTP/1.0\n");
	fwrite($fp, "Host: " . $host . "\r\n");
	if ($login != "") {
		fwrite($fp, "Authorization: Basic " .
			base64_encode($login. ":" . $password) . "\n");
	}
	fwrite($fp, "\n");
	$response = "";
	while(!feof($fp)) {
		$response .= fread($fp, 1);
	}
	fclose($fp);
	list($other, $responseBody) = explode("\r\n\r\n", $response, 2);
	return $responseBody;
}
/*
* использование функции проверки состояния отправленного сообщения
*/
echo status("api.smsbliss.net", 80, "api_login", "api_password", "12345");
