# bulk-create-service-zabbix
Bulk Create Service Zabbix for SLA

This program uses the API from Zabbix, first get the auth ID with the following API then enter it in create_service.php

curl --request POST \
  --url 'https://example.com/zabbix/api_jsonrpc.php' \
  --header 'Content-Type: application/json-rpc' \
  --data '{"jsonrpc":"2.0","method":"user.login","params":{"username":"Admin","password":"zabbix"},"id":1}'

Then create the SLA and provide a service tag, this service tag will be used in creating the service


https://www.zabbix.com/documentation/current/en/manual/api
https://www.zabbix.com/documentation/current/en/manual/api/reference/sla
