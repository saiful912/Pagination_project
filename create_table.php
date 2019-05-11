<?php
$connection = new PDO('mysql:dbname=pagination;host=localhost','root','');
$connection->query('
        create table people(
        id int(11) auto_increment primary key,
        name varchar(30) not null,
        email varchar(30) not null
        )
');