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
