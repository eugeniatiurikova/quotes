<?php
require_once 'model/UserProvider.php';
$pdo = require 'db.php';

//$query = 'CREATE TABLE users (
//            id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
//            username VARCHAR(50) NOT NULL UNIQUE,
//            name TEXT,
//            password TEXT
//)';
//$statement = $pdo->query($query);

//$user = new User('admin');
//$user->setName('John Doe');
$userProvider = new UserProvider($pdo);
//$userProvider->registerUser($user, '123');
$user = $userProvider->getByUsernameAndPassword('admin', '123');
var_dump($user);

//$statement = $pdo->prepare("INSERT INTO users (
//                   first_name,
//                   last_name,
//                   email,
//                   created
//                        )
//                VALUES (
//                   :first_name,
//                   :last_name,
//                   :email,
//                   :created
//                        )");
//$result = $statement->execute([
//                   ':first_name' => 'jd',
//                   ':last_name' => 'John Doe',
//                   ':email' => 'asd',
//                   ':created' => '25-11-2022'
//]);


//$statement = $pdo->prepare('SELECT * FROM users WHERE last_name LIKE ?');
//$statement->execute(['John Doe']);
//print_r($statement->fetchall(PDO::FETCH_ASSOC));
//$statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
//print_r($statement->fetch());

//print_r($statement->fetchObject('User'));

//print_r($statement->fetchall(PDO::FETCH_CLASS, 'User'));