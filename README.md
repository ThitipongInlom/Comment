# Comment
```
+--------+----------+-------------------+------+-----------------------------------------------------+--------------+
| Domain | Method   | URI               | Name | Action                                              | Middleware   |
+--------+----------+-------------------+------+-----------------------------------------------------+--------------+
|        | GET|HEAD | Admin             |      | Closure                                             | web          |
|        | GET|HEAD | Dashboard         |      | App\Http\Controllers\Login@Dashboard                | web          |
|        | POST     | Do_login          |      | App\Http\Controllers\Login@Do_login                 | web          |
|        | POST     | Save_Data         |      | App\Http\Controllers\Controller@Save_Data           | web          |
|        | GET|HEAD | api/user          |      | Closure                                             | api,auth:api |
|        | GET|HEAD | {locale}/{encode} |      | App\Http\Controllers\Controller@Show_welcome_encode | web          |
+--------+----------+-------------------+------+-----------------------------------------------------+--------------+
```
