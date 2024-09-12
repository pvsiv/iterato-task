# Code review task

## Task definition

 * Create REST api create customer notifications by email or sms depends on customer settings.
 * Customer profile data is saved in database

 Request:
     url: /api/customer/{code}/notifications
    json: { body: "notification text"  }


## Requirements
- Docker 27.2.1+ (earlier versions not tested)
- Docker Compose v2.29.2+ (earlier versions not tested)

## Launching application
- `make run`
- `make build`

Example API request:
```
curl http://localhost:8000/api/customer/code-sms/notifications \
    --request POST \
    --data '{"body": "notification text"}'
```

## Running tests
- `make run`
- `make test`
