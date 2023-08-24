<?php

$dsn = 'mysql:host=localhost; dbname=test';
$user = 'db';
$password = 'dbpass';


$pdo = new PDO($dsn, $user, $password);

//daten laden
$stmt = $pdo->prepare('SELECT * FROM' `news` WHERE `id` = 2);
$stmt->execute();

$result  = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($result);

// daten hinzufügen
$stmt = $pdo->prepare(INSERT INTO `news` (`title`,`content`) VAlUES (:title, :content);
$stmt->bindValue(':title','Hallo venus');
$stmt->bindValue(':content', 'lorem ipsum dolor');
$stmt->execute();

//daten update
$stmt = $pdo-> prepare('UPDATE `news` SET `title` = :title WHERE `id` = :id');
$stmt->bindValue(':id',  7);
$stmt->bindValue(':title',  'sakdsjdka');
$stmt->execute();

//daten löschen
$stmt = $pdo-> prepare('DELETE FROM `news` WHERE `id` = :id');
$stmt->bindValue(':id',  7);
$stmt->execute();
