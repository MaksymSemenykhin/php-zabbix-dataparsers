<?php
/**
how to use in .conf:
UserParameter=couchdb[*], php -f /etc/zabbix/scripts/couchdb-stats.php $1 http://admin:***@localhost:5984/_node/nonode@nohost

params :
$argv[1] = 'couchdb.database_reads.value';
key in json data
$argv[2] = 'http://admin:***@localhost:5984/_node/nonode@nohost';
host to connect to

test :
php ./couchdb-stats.php couchdb.database_reads.value http://admin:***@localhost:5984/_node/nonode@nohost
*/

$couchdb_data = file_get_contents($argv[2].'/_stats');
$couchdb_data = json_decode($couchdb_data,true);


$data = null;
foreach( explode('.',$argv[1]) as $key )
        if (!$data)
                $data = $couchdb_data[$key];
        else
                $data = $data[$key];

echo $data;
