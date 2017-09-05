<?php
/**
how tto use in .conf
UserParameter=couchdb-request_time[*], php -f /etc/zabbix/scripts/request_time.php $1 http://127.0.0.1:5984
*/

//key in json data
$argv[1];
//host to connect to
$argv[2];


$request_time = file_get_contents($argv[2].'/_stats/couchdb/request_time');

$request_time = json_decode($request_time,true);

echo $request_time['couchdb']['request_time'][$argv[1]];
