<?php
$connection = new PDO('mysql:dbname=pagination;host=localhost', 'root', '');
for ($i = 1; $i <= 50; $i++) {
    $statement = $connection->prepare('insert into people(name,email)values(:name,:email)');
    $statement->execute([
        ":name" => 'saiful' . $i,
        "email" => 'saiful' . $i . '@gmail.com',
    ]);
}