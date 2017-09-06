<?php

/**

how to use in .conf:
UserParameter=couchdb-dbs_size[*], php -f /etc/zabbix/scripts/dbs_size.php $1 http://127.0.0.1:5984

params :
$argv[1] = 'disk_size';
key in json data

$argv[2] = 'http://127.0.0.1:5984';
host to connect to


test :
php -f /etc/zabbix/scripts/dbs_size.php disk_size http://127.0.0.1:5984.
php -f /etc/zabbix/scripts/dbs_size.php data_size http://127.0.0.1:5984.
*/

$all_dbs = file_get_contents($argv[2].'/_all_dbs');
$all_dbs = json_decode($all_dbs,true);
$sum = [];
$sum[$argv[1]] = 0;

foreach( $all_dbs as $n => $db){
  $db_data = json_decode(file_get_contents($argv[2]."/$db") ,true);
  $sum[$argv[1]] += $db_data[$argv[1]];
}

echo $sum[$argv[1]];
