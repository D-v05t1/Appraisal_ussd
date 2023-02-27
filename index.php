<?php
include_once __DIR__."/config/config.php";
include_once "menu.php";
require_once __DIR__ . '/vendor/autoload.php';
use AfricasTalking\SDK\AfricasTalking;

$username = 'sandbox';
$apiKey = 'c9429a7f0320a3364ba80b7ac09145ef8e2015d36bea42de42872facb9724328';

$AT = new AfricasTalking($username, $apiKey);
$sessionId   = $_POST["sessionId"];
    $serviceCode = $_POST["serviceCode"];
    $phoneNumber = $_POST["phoneNumber"];  
    $text= $_POST["text"];
        
$menu=new Menu($phoneNumber);
$textArray=explode('*',$text);

if($text=="")
{
   $menu->firstScreen();
}

else
{
if($textArray[0]=='1')
{
$menu->register($textArray);
}

elseif($textArray[0]=='2')
{
$menu->fillreport($textArray);
}
    
elseif($textArray[0]=='3')
{
$menu->viewreport($textArray);
}  
  
}













?>