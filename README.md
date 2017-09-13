# php-zabbix-dataparsers

# request_time

```
how to use in .conf
UserParameter=couchdb-request_time[*], php -f /etc/zabbix/scripts/request_time.php $1 http://127.0.0.1:5984
```

# dbs_size

```
how to use in .conf:
UserParameter=couchdb-dbs_size[*], php -f /etc/zabbix/scripts/dbs_size.php $1 http://127.0.0.1:5984
```


# couchdb-stats

```
how to use in .conf:
UserParameter=couchdb[*], php -f /etc/zabbix/scripts/couchdb-stats.php $1 http://admin:***@localhost:5984/_node/nonode@nohost
or
UserParameter=couchdb[*], php -f /etc/zabbix/scripts/couchdb-stats.php $1 http://localhost:5984/
```
