<?php 
require_once('/path/to/twilio-php/Services/Twilio.php');
$client = new Services_Twilio("{{ sid }}", "{{ auth_token }}");
$client->account->messages->sendMessage("+15558675309", "+12125552368", "There’s something strange in my neighborhood. I don’t know who to call. Send help!"; 
?>