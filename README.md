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
<h2>ตัวอย่างโปรแกรม</h2>

![alt text](https://user-images.githubusercontent.com/11131954/44297998-312d0c80-a305-11e8-8534-ebd8b549e7bb.PNG)

![alt text](https://user-images.githubusercontent.com/11131954/44298000-34c09380-a305-11e8-9bac-0c6cf9250cf9.PNG)

![alt text](https://user-images.githubusercontent.com/11131954/44298003-39854780-a305-11e8-9094-25d9f8d5a39a.PNG)

![alt text](https://user-images.githubusercontent.com/11131954/44298009-49049080-a305-11e8-9afa-cf14d5308452.PNG)
