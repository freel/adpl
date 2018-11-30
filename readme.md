All writed code see at commit diff

## Commands

Add new URL dowonload to queue:
```
php artisan download:url {url}
```

List all Jobs:
```
php artisan download:list
```

## REST API

|Method|Uri|Name|Action|Comment|
|---|---|---|---|---|
| GET | api | api.index |App\Http\Controllers\DownloadApiController@index |api| Return job list |
| POST | api | api.store |App\Http\Controllers\DownloadApiController@store |api| Add new {url} dowonload to queue|

## TestCase

Testing access, pending downloads and validation via API, web, CLI.
