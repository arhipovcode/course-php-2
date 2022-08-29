<?php

use Mikhailarkhipov\Php2\Blog\Commands\Arguments;
use Mikhailarkhipov\Php2\Blog\Comment;
use Mikhailarkhipov\Php2\Blog\Repositories\CommentsRepository\SqliteCommentsRepository;
use Mikhailarkhipov\Php2\Blog\UUID;
use Mikhailarkhipov\Php2\Blog\Post;
use Mikhailarkhipov\Php2\Blog\Repositories\PostsRepository\SqlitePostsRepository;
use Mikhailarkhipov\Php2\Blog\Repositories\UsersRepository\SqliteUsersRepository;
use Mikhailarkhipov\Php2\Blog\Commands\CreateUserCommand;

require_once __DIR__ . "/vendor/autoload.php";

//Создаём объект подключения к SQLite
$connection = new PDO('sqlite:' . __DIR__ . '/blog.sqlite');

//Создаём объект репозитория
$usersRepository = new SqliteUsersRepository($connection);
$postRepository = new SqlitePostsRepository($connection);
$commentRepository = new SqliteCommentsRepository($connection);

$command = new CreateUserCommand($usersRepository);

$faker = Faker\Factory::create('ru_Ru');

//Добавляю пост
//$postRepository->save(
//    new Post(
//        UUID::random(),
//        UUID::random(),
//        $faker->realText(rand(10, 20)),
//        $faker->realText(rand(20, 30))
//    ));

//Добавляю комментарий
//$commentRepository->save(
//    new Comment(
//        UUID::random(),
//        UUID::random(),
//        UUID::random(),
//        $faker->realText(rand(20, 30))
//    )
//);

//try {
//    // Запускаем команду
//    $command->handle(Arguments::fromArgv($argv));
//}  catch (Exception $exception) {
//    echo $exception->getMessage();
//}

//Добавляем в репозиторий несколько пользователей
//$usersRepository->save(new User(UUID::random(), new Name('Ivan', 'Nikitin')));
//$usersRepository->save(new User(UUID::random(), new Name('Anna', 'Petrova')));


//switch ($argv[1]) {
//    case 'user';
//        echo new User(1, $faker->firstName(), $faker->lastName());;
//        break;
//    case 'post';
//        echo new Post($faker->text());;
//        break;
//    case 'comment';
//        echo new Comment($faker->text());;
//        break;
//}