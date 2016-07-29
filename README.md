[![JCFirebase-PHP](https://github.com/JasonChiuCC/JCFirebase-PHP/blob/master/image/logo.png "JCFirebase-PHP")](https://github.com/JasonChiuCC/JCFirebase-PHP)

## 介紹

JCFirebase-PHP 是一款使用 PHP 語言的函示庫，將 Firebase Realtime Database 的 REST API 包裝起來

你可以輕鬆的對 Firebase Realtime Database 做控制，例如儲存資料、更新資料、刪除資料以及取出資料

## 安裝

為了方便及模組化，此函示庫使用 Composer 來安裝

```
cd <your_project>
composer require jasonchiucc/jcfirebase-php dev-master
```

## 使用

### 『初始化』

進入 [Firebase console](https://console.firebase.google.com/) > 點選 ProjectName > 點選將 Firebase 加入您的網路應用程式 > 填入需要欄位

```php
$config = array(
    "apiKey"        => "你的 Database API Key",
    "authDomain"    => "Yourfirebaseproject.firebaseapp.com",
    "databaseURL"   => "https://Yourfirebaseproject.firebaseio.com",
    "storageBucket" => "Yourfirebaseproject.appspot.com",    
);
$firebase = new Firebase\FirebaseAPI($config);
```

### 『基本操作』

`Set` 範例，結果[如圖所示](https://github.com/JasonChiuCC/JCFirebase-PHP/blob/master/image/2016-07-29_133441.png)

```php
$arrayData = array(
    "Developer" => array(
        "name"  => "Jason",
        "year"  => "27"
    )
);
$firebase->set("/Users",$arrayData);
```

`Set` 範例，結果[如圖所示](https://github.com/JasonChiuCC/JCFirebase-PHP/blob/master/image/2016-07-29_134124.png)

```php
$name   = 'JasonChiu';
$year   = '26';
$firebase->set("/Users/Developer/name", $name);
$firebase->set("/Users/Developer/year", $year);
```

`Update` 範例，結果[如圖所示](https://github.com/JasonChiuCC/JCFirebase-PHP/blob/master/image/2016-07-29_134249.png)

```php
$arrayData = array(
    "nickname" => "JC"
);
$firebase->update("/Users/Developer",$arrayData);
```

`Update` 範例，結果[如圖所示](https://github.com/JasonChiuCC/JCFirebase-PHP/blob/master/image/2016-07-29_134457.png)

```php
$arrayData = array(
    "Developer/nickname"        => "JJ",
    "ProjectManager/nickname"   => "Lin"
);
$firebase->update("/Users",$arrayData);
```

`Push` 範例，結果[如圖所示](https://github.com/JasonChiuCC/JCFirebase-PHP/blob/master/image/2016-07-29_135427.png)

```php
$arrayData = array(
    "Author"  => "Sharon",
    "Time"    => "2016"
);
$firebase->push("/Posts",$arrayData);
```

`Remove` 範例，結果[如圖所示](https://github.com/JasonChiuCC/JCFirebase-PHP/blob/master/image/2016-07-29_135958.png)

```php
$firebase->remove("/Users/ProjectManager");
```

`Set Server Values` 範例，結果[如圖所示](https://github.com/JasonChiuCC/JCFirebase-PHP/blob/master/image/2016-07-29_140130.png)

```php
$firebase->setSV("/CreateAt");
```

`Filtering Data` 範例，結果[如圖所示](https://github.com/JasonChiuCC/JCFirebase-PHP/blob/master/image/2016-07-29_140615.png)

其他參數設定[參考這裡](https://firebase.google.com/docs/database/rest/retrieve-data)

```php
$firebase->setDatabaseURL("https://dinosaur-facts.firebaseio.com");
$firebase->setPrintMode("pretty");

$query = array(
    "orderBy"   => '"height"',
    "startAt"   => 3
);
$firebase->get("/dinosaurs",$query);

$query = array(
    "orderBy"   => '"$value"',
    "startAt"   => 50
);
$firebase->get("/scores",$query);
```

### 『其他設定』

```php
/* You can set silent,pretty,default */
$mode = "silent"; 
$firebase->setPrintMode($mode);
  
/* You can set true or false */
$firebase->setShallow(true)

/* Set parameter */
$firebase->setApiKey("");
$firebase->setAuthDomain("");
$firebase->setDatabaseURL("");
$firebase->setStorageBucket("");

/* Get parameter */
$firebase->getApiKey();
$firebase->getAuthDomain();
$firebase->getDatabaseURL();
$firebase->getStorageBucket();
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
