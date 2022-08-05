<?php

require_once __DIR__ . "/vendor/autoload.php";

$faker = Faker\Factory::create('ru_Ru');

$userName = explode(' ', $faker->name());

$user = new \Mikhailarkhipov\Php2\Users\User(1, $userName[0], $userName[1]);
$post = new \Mikhailarkhipov\Php2\Articles\Article($faker->text());
$comment = new \Mikhailarkhipov\Php2\Comments\Comment($faker->text());


switch ($argv[1]) {
    case 'user';
        echo $user;
        break;
    case 'post';
        echo $post;
        break;
    case 'comment';
        echo $comment;
        break;
}