# Comment
   <h4>โปรแกรมส่งแบบสอบถามไปหาลูกค้าที่ใช้บริการโรงแรมและรับข้อเสนอแนะต่างๆของลูกค้ามาปรับปรุง </h4>
<h2>Installation Instructions</h2>

```
+--------+----------+--------------------------+------+-----------------------------------------------------+--------------+
| Domain | Method   | URI                      | Name | Action                                              | Middleware   |
+--------+----------+--------------------------+------+-----------------------------------------------------+--------------+
|        | GET|HEAD | 404                      |      | Closure                                             | web          |
|        | GET|HEAD | Admin                    |      | Closure                                             | web          |
|        | GET|HEAD | Create_Link              |      | App\Http\Controllers\Login@Create_Link              | web          |
|        | GET|HEAD | Dashboard                |      | App\Http\Controllers\Login@Dashboard                | web          |
|        | POST     | Do_create_link           |      | App\Http\Controllers\Login@Do_create_link           | web          |
|        | POST     | Do_login                 |      | App\Http\Controllers\Login@Do_login                 | web          |
|        | GET|HEAD | Logout                   |      | App\Http\Controllers\Login@Logout                   | web          |
|        | POST     | Save_Data                |      | App\Http\Controllers\Controller@Save_Data           | web          |
|        | GET|HEAD | Star                     |      | App\Http\Controllers\Login@Star                     | web          |
|        | GET|HEAD | Table_View               |      | App\Http\Controllers\View_Data@Table_View           | web          |
|        | GET|HEAD | View_Information         |      | App\Http\Controllers\Controller@View_Information    | web          |
|        | GET|HEAD | api/user                 |      | Closure                                             | api,auth:api |
|        | GET|HEAD | {locale}/{encode}        |      | App\Http\Controllers\Controller@Show_welcome_encode | web          |
|        | GET|HEAD | {locale}/{encode}/{list} |      | App\Http\Controllers\View_Data@List_View            | web          |
+--------+----------+--------------------------+------+-----------------------------------------------------+--------------+
```
<h2>ตัวอย่างโปรแกรม</h2>

![alt text](https://user-images.githubusercontent.com/11131954/44297998-312d0c80-a305-11e8-8534-ebd8b549e7bb.PNG)

![alt text](https://user-images.githubusercontent.com/11131954/44298000-34c09380-a305-11e8-9bac-0c6cf9250cf9.PNG)

![alt text](https://user-images.githubusercontent.com/11131954/44298003-39854780-a305-11e8-9094-25d9f8d5a39a.PNG)

![alt text](https://user-images.githubusercontent.com/11131954/44616592-c045a180-a87c-11e8-864e-ddea699104cc.PNG)

![alt text](https://user-images.githubusercontent.com/11131954/44616595-c2a7fb80-a87c-11e8-9679-ed2642664a89.PNG)

![alt text](https://user-images.githubusercontent.com/11131954/44616598-c471bf00-a87c-11e8-97d6-c83a8f4619f6.PNG)

![alt text](https://user-images.githubusercontent.com/11131954/44616600-c63b8280-a87c-11e8-9071-49689759f009.PNG)
