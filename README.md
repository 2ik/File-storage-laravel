**STEPS:**

`git clone https://github.com/2ik/File-storage-laravel.git`

`php artisan storage:link`

`php artisan queue:work`

# API DOCUMENTATION

**Resource:**

> **POST** - add resource

> **GET** - get resource (all resources)

TYPE | POST| GET| GET
|--|--|--|--|
URL| `api/resources/`| `api/resources/` |`api/resources/{resource}`
PARAM| `url`| |

**File:**

> **GET** - get resource (all resources)

TYPE | GET
|--|--|
URL| `api/file/{id}`|
PARAM||

# CONSOLE DOCUMENTATION

**link**

Command | Description
|--|--|
`link:filch` | `Download file in local storage`
`link:file` | `Generates a link based on id`
`link:list` | `List all link with all statuses --status=(pending/downloading/complete/error)`
