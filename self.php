<?php

declare(strict_types = 1);

error_reporting(E_ALL);


date_default_timezone_set('Asia/Tehran');

if(file_exists('vendor/autoload.php')){
    require_once 'vendor/autoload.php';
} elseif(file_exists('liveproto.php') === false){
    copy('https://installer.liveproto.dev/liveproto.php','liveproto.php');
    require_once 'liveproto.php';
} else {
    require_once 'liveproto.phar';
}

use Tak\Liveproto\Network\Client;
use Tak\Liveproto\Utils\Settings;
use Revolt\EventLoop;

$settings = new Settings();
$settings->setApiId(27201211);
$settings->setApiHash('222d3fb25c8d49c632d554fa9161728c');
$settings->setHideLog(true);
$settings->setAutoCachePeers(true);

$client = new Client('aboli','SQLite', $settings);

$client->connect();

EventLoop::unreference(EventLoop::repeat(60,function() use ($client) : void {
    if($client->connected){
        $client->account->updateProfile(first_name : 'AƁOLƑAƵL',last_name : '»'.date('H:i'));
    }
}));

$client->start(run_until_disconnected : true);