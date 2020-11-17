<?php
if(!session_id()) {
    session_start();
}
include_once('Librerias/Facebook/autoload.php');

$fb = new Facebook\Facebook(array(
    'app_id' => '392499455135288', // Replace with your app id
    'app_secret' => '7d89d2f4329eca8bb57b91ac9582fa90',  // Replace with your app secret
    'default_graph_version' => 'v3.2',
));


$helper = $fb->getRedirectLoginHelper();
?>