# Comment
   <h4>โปรแกรมส่งแบบสอบถามไปหาลูกค้าที่ใช้บริการโรงแรมและรับข้อเสนอแนะต่างๆของลูกค้ามาปรับปรุง </h4>
<h2>Installation Instructions</h2>

```
+--------+----------+-------------------+------+-----------------------------------------------------+--------------+
| Domain | Method   | URI               | Name | Action                                              | Middleware   |
+--------+----------+-------------------+------+-----------------------------------------------------+--------------+
|        | GET|HEAD | Admin             |      | Closure                                             | web          |
|        | GET|HEAD | Dashboard         |      | App\Http\Controllers\Login@Dashboard                | web          |
|        | POST     | Do_login          |      | App\Http\Controllers\Login@Do_login                 | web          |
|        | GET|HEAD | Logout            |      | App\Http\Controllers\Login@Logout                   | web          |
|        | POST     | Save_Data         |      | App\Http\Controllers\Controller@Save_Data           | web          |
|        | GET|HEAD | Star              |      | App\Http\Controllers\Login@Star                     | web          |
|        | GET|HEAD | api/user          |      | Closure                                             | api,auth:api |
|        | GET|HEAD | {locale}/{encode} |      | App\Http\Controllers\Controller@Show_welcome_encode | web          |
+--------+----------+-------------------+------+-----------------------------------------------------+--------------+
```
