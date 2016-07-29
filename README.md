[![JCFirebase-PHP](https://github.com/JasonChiuCC/JCFirebase-PHP/blob/master/logo.png "JCFirebase-PHP")](https://github.com/JasonChiuCC/JCFirebase-PHP)

## 介紹

JCFirebase-PHP 是一款使用 PHP 語言的函示庫，將 Firebase Realtime Database 的 REST API 包裝起來

你可以輕鬆的對 Firebase Realtime Database 做控制，例如儲存資料、更新資料、刪除資料以及取出資料

## 安裝

為了方便及模組化，此函示庫使用 Composer 來安裝

```
cd <your_project>
composer require jasonchiucc/jcfirebase-php
```

## 使用

### 初始化

進入 [Firebase console](https://console.firebase.google.com/) > 點選 ProjectName > 點選將 Firebase 加入您的網路應用程式 > 填入需要欄位

```
$config = array(
    "apiKey"        => "你的 Database API Key",
    "authDomain"    => "Yourfirebaseproject.firebaseapp.com",
    "databaseURL"   => "https://Yourfirebaseproject.firebaseio.com",
    "storageBucket" => "Yourfirebaseproject.appspot.com",    
);
$firebase = new Firebase\FirebaseAPI($config);
```








## 授權條款

```
Copyright (C) 2016 JasonChiuCC

Permission is hereby granted, free of charge, 
to any person obtaining a copy of this software and associated 
documentation files (the "Software"), to deal in the Software without restriction, 
including without limitation the rights to use, copy, modify, merge, publish, 
distribute, sublicense, and/or sell copies of the Software, and to permit persons to 
whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies 
or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, 
INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, 
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. 
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, 
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, 
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
```