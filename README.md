## PHP JSON SMS API

```
$access_point = 'http://message-api.com';
$login = 'username';
$password = 'password';


$api = new JsonSmsApi($access_point, $login, $password);

// узнаем текущий баланс
var_dump($api->balance()); 

// получаем список доступных подписей
var_dump($api->senders()); 

// отправляем пакет sms
$messages = array(
        array(
            "clientId" => "1",
            "phone"=> "71234567890",
            "text"=> "first message",
            "sender"=> "TEST"
        ),
        array(
            "clientId" => "2",
            "phone"=> "71234567891",
            "text"=> "second message",
            "sender"=> "TEST",
        ),
        array(
            "clientId" => "3",
            "phone"=> "71234567892",
            "text"=> "third message",
            "sender"=> "TEST",
        ),
    );
var_dump($api->send($messages, 'testQueue')); 

// получаем статусы для пакета sms
$messages = array(
    array("clientId"=>"1","smscId"=>11255142),
    array("clientId"=>"2","smscId"=>11255143),
    array("clientId"=>"3","smscId"=>11255144),
);
var_dump($api->status($messages)); 

// получаем статусы из очереди 'testQueue'
var_dump($api->statusQueue('testQueue', 10)); 
```
