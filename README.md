# Comment


All Route:ต่างในระบบ
+--------+----------+-------------------+------+-----------------------------------------------------+--------------+
| Domain | Method   | URI               | Name | Action                                              | Middleware   |
+--------+----------+-------------------+------+-----------------------------------------------------+--------------+
|        | POST     | Save_Data         |      | App\Http\Controllers\Controller@Save_Data           | web          |
|        | GET|HEAD | admin             |      | Closure                                             | web          |
|        | GET|HEAD | api/user          |      | Closure                                             | api,auth:api |
|        | GET|HEAD | {locale}/{encode} |      | App\Http\Controllers\Controller@Show_welcome_encode | web          |
+--------+----------+-------------------+------+-----------------------------------------------------+--------------+
