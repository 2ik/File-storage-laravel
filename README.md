![screenshot](http://i.prntscr.com/q6mhvxxySDOhdMXeTJkAiA.png)

**STEPS:**

`git clone https://github.com/2ik/File-storage-laravel.git`

`composer install`

`php artisan migrate`

`php artisan storage:link`

`php artisan queue:work`

`php artisan serve`


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
`php artisan link:filch {url}` | `Download file in local storage`
`php artisan link:file {id}` | `Generates a link based on id`
`php artisan link:list [--status]` | `List all link with all statuses --status=(pending/downloading/complete/error)`
