<?php

use App\Connection;

$pdo = Connection::getPDO();

$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
$pdo->exec('TRUNCATE TABLE post_category');
$pdo->exec('TRUNCATE TABLE post');
$pdo->exec('TRUNCATE TABLE category');
$pdo->exec('TRUNCATE TABLE user');
$pdo->exec('SET FOREIGN_KEY_CHECKS = 1');

$posts = [];
$categories = [];

for ($i = 0; $i < 50; $i++) {
  $pdo->exec("INSERT INTO post SET name='Article #$i', slug='article-$i', created_at='2019-05-11 14:00:0$i', content='lorem ipsum'");
  $posts[] = $pdo->lastInsertId();
}

for ($i = 0; $i < 5; $i++) {
  $pdo->exec("INSERT INTO category SET name='category #$i', slug='category-$i'");
  $categories[] = $pdo->lastInsertId();
}

foreach($posts as $post) {
  $numberOfCategories = rand(1,5);
  $randomCategories = [];

  for ($i = 1; $i < $numberOfCategories +1; $i++) {
    $randomCategories[] = $i;
  }

  foreach($randomCategories as $category) {
    $pdo->exec("INSERT INTO post_category SET post_id=$post, category_id=$category");
  }
}

$password = password_hash('admin', PASSWORD_BCRYPT);

$pdo->exec("INSERT INTO user SET username='admin', password='$password'");
