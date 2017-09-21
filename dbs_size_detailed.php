<?php

/**

how to use in .conf:
UserParameter=couchdb-dbs_size_detailed[*], php -f /etc/zabbix/scripts/dbs_size_detailed.php $1 http://127.0.0.1:5984
couchdb-dbs_size_detailed[]
params :
$argv[1] = 'disk_size';
key in json data

$argv[2] = 'http://127.0.0.1:5984';
host to connect to


test :
zabbix_agent -t couchdb-dbs_size_detailed[_db]
zabbix_agent -t couchdb-dbs_size_detailed[_agent]
zabbix_agent -t couchdb-dbs_size_detailed[_ext_task]
zabbix_agent -t couchdb-dbs_size_detailed[_int_task]
zabbix_agent -t couchdb-dbs_size_detailed[_private]
zabbix_agent -t couchdb-dbs_size_detailed[_quiz]
zabbix_agent -t couchdb-dbs_size_detailed[_user_]
zabbix_agent -t couchdb-dbs_size_detailed[_public]
zabbix_agent -t couchdb-dbs_size_detailed[_query]
zabbix_agent -t couchdb-dbs_size_detailed[_replicator]
zabbix_agent -t couchdb-dbs_size_detailed[_users]
zabbix_agent -t couchdb-dbs_size_detailed[_course_]

php -f /etc/zabbix/scripts/dbs_size_detailed.php _db http://127.0.0.1:5985
php -f /etc/zabbix/scripts/dbs_size_detailed.php _agent http://127.0.0.1:5985
php -f /etc/zabbix/scripts/dbs_size_detailed.php _ext_task http://127.0.0.1:5985
php -f /etc/zabbix/scripts/dbs_size_detailed.php _int_task http://127.0.0.1:5985
php -f /etc/zabbix/scripts/dbs_size_detailed.php _private http://127.0.0.1:5985
php -f /etc/zabbix/scripts/dbs_size_detailed.php _quiz http://127.0.0.1:5985
php -f /etc/zabbix/scripts/dbs_size_detailed.php _user_ http://127.0.0.1:5985
php -f /etc/zabbix/scripts/dbs_size_detailed.php _public http://127.0.0.1:5985
php -f /etc/zabbix/scripts/dbs_size_detailed.php _query http://127.0.0.1:5985
php -f /etc/zabbix/scripts/dbs_size_detailed.php _replicator http://127.0.0.1:5985
php -f /etc/zabbix/scripts/dbs_size_detailed.php _users http://127.0.0.1:5985
php -f /etc/zabbix/scripts/dbs_size_detailed.php _course_ http://127.0.0.1:5985

*/

$db_types = ['_db','_agent','_ext_task','_int_task','_private','_quiz','_user_','_public','_query','_replicator','_users','_course_'];
$all_dbs = file_get_contents($argv[2].'/_all_dbs');
$all_dbs = json_decode($all_dbs,true);

$sum = [];
$sum['total'] = 0;

foreach( $all_dbs as $n => $db){
    $found = false;
    $db_data = json_decode(file_get_contents($argv[2]."/$db") ,true);

    $sum['total'] += $db_data['disk_size'];

    foreach( $db_types as $db_type){

        if(
            ($db_type=='_user_' && false!==strpos($db,$db_type) ) ||
            ($db_type=='_course_' && false!==strpos($db,$db_type) ) ||
            0===strpos(strrev($db),strrev($db_type))
        ){
            if(!isset($sum[$db_type])) $sum[$db_type] =0;
            $sum[$db_type] += $db_data['disk_size'];
            $found = true;
            break;
        }
    }

}
//
//echo "\n total:".$sum['total']."\n";
//unset($sum['total']);
//
//$total_check = 0;
//foreach( $sum as $db_sum){
//    $total_check += $db_sum;
//}
//
//echo "\n total_check:".$total_check."\n";
echo isset($sum[$argv[1]])?$sum[$argv[1]]:0;
