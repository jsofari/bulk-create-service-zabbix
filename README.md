# bulk-create-service-zabbix
Bulk Create Service Zabbix for SLA

This program uses the API from Zabbix, first get the auth ID with the following API then enter it in create_service.php

curl --request POST \
  --url 'https://example.com/zabbix/api_jsonrpc.php' \
  --header 'Content-Type: application/json-rpc' \
  --data '{"jsonrpc":"2.0","method":"user.login","params":{"username":"Admin","password":"zabbix"},"id":1}'

Then create the SLA and provide a service tag, this service tag will be used in creating the service

![SLA report](https://github.com/jsofari/bulk-create-service-zabbix/assets/42039646/641f55d5-b692-44d2-a619-3854865804c4)


https://www.zabbix.com/documentation/current/en/manual/api
https://www.zabbix.com/documentation/current/en/manual/api/reference/sla
Thanks To CHATGPT
