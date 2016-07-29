[![JCFirebase-PHP](https://github.com/JasonChiuCC/JCFirebase-PHP/blob/master/image/logo.png "JCFirebase-PHP")](https://github.com/JasonChiuCC/JCFirebase-PHP)

## Introduction

JCFirebase-PHP is a library written by PHP ,it wrapper Firebase Realtime Database REST API

You can easily use this library to control Firebase Realtime Database

For example save data、update data、delete data or get data.

If you have any problem when using this library,please free feel to ask me.

[中文說明參考](https://github.com/JasonChiuCC/JCFirebase-PHP/blob/master/README_zh-tw.md)

## Installation

For convin,this library use Composer to install for convenience.

```
cd <your_project>
composer require jasonchiucc/jcfirebase-php dev-master
```

## Usag

Before use this library, please change your Firebase database rule like below

Enter [Firebase console](https://console.firebase.google.com/) > ProjectName > Database > Rules

More database rules setting please [reference here](https://firebase.google.com/docs/database/security/quickstart#sample-rules)

```
{
  "rules": {
    ".read": true,
    ".write": true
  }
}
```

### 『Initialization』

Enter [Firebase console](https://console.firebase.google.com/) > ProjectName > Add Firebase to your application

```php
require 'vendor/autoload.php';

$config = array(
    "apiKey"        => "Your Database API Key",
    "authDomain"    => "Yourfirebaseproject.firebaseapp.com",
    "databaseURL"   => "https://Yourfirebaseproject.firebaseio.com",
    "storageBucket" => "Yourfirebaseproject.appspot.com",    
);
$firebase = new Firebase\FirebaseAPI($config);
```

### 『Basic Operations』

`Set` example，you can see the [result](https://github.com/JasonChiuCC/JCFirebase-PHP/blob/master/image/2016-07-29_133441.png)

```php
$arrayData = array(
    "Developer" => array(
        "name"  => "Jason",
        "year"  => "27"
    )
);
$firebase->set("/Users",$arrayData);
```

`Set` example,see the [result](https://github.com/JasonChiuCC/JCFirebase-PHP/blob/master/image/2016-07-29_134124.png)

```php
$name   = 'JasonChiu';
$year   = '26';
$firebase->set("/Users/Developer/name", $name);
$firebase->set("/Users/Developer/year", $year);
```

`Update` example,see the [result](https://github.com/JasonChiuCC/JCFirebase-PHP/blob/master/image/2016-07-29_134249.png)

```php
$arrayData = array(
    "nickname" => "JC"
);
$firebase->update("/Users/Developer",$arrayData);
```

`Update` example,see the [result](https://github.com/JasonChiuCC/JCFirebase-PHP/blob/master/image/2016-07-29_134457.png)

```php
$arrayData = array(
    "Developer/nickname"        => "JJ",
    "ProjectManager/nickname"   => "Lin"
);
$firebase->update("/Users",$arrayData);
```

`Push` example,see the [result](https://github.com/JasonChiuCC/JCFirebase-PHP/blob/master/image/2016-07-29_135427.png)

```php
$arrayData = array(
    "Author"  => "Sharon",
    "Time"    => "2016"
);
$firebase->push("/Posts",$arrayData);
```

`Remove` example,see the [result](https://github.com/JasonChiuCC/JCFirebase-PHP/blob/master/image/2016-07-29_135958.png)

```php
$firebase->remove("/Users/ProjectManager");
```

`Set Server Values` example,see the [result](https://github.com/JasonChiuCC/JCFirebase-PHP/blob/master/image/2016-07-29_140130.png)

```php
$firebase->setSV("/CreateAt");
```

`Filtering Data` example,see the [result](https://github.com/JasonChiuCC/JCFirebase-PHP/blob/master/image/2016-07-29_140615.png)

Other setting you can [reference here](https://firebase.google.com/docs/database/rest/retrieve-data)

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

### 『Other setting』

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

## License

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
