<?php


$page = 1;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
$limit = 5;
$offset = $page * $limit - $limit;
//focus algorithm
/*1 5 0
2 5 5
3 5 10*/

//page calculation algorithm
/*
 * page = data ase (50) / proti page ee data(5) = tahole page (10)
jodi amon hoe ->page = data ase (49) / proti page ee data(5) = tahole page (9.8) url kokhono emon data jabe na
tai cail() function and floor() function use kora hoe
cail () ex: 8.8 data ke 9 kore dae
floor() ex: 8.8 data ke 8 kore dae
*/
$connection = new PDO('mysql:dbname=pagination;host=localhost', 'root', '');
$stmt = $connection->prepare("SELECT * FROM people limit $limit offset $offset");
$stmt->execute();
$people = $stmt->fetchAll(PDO::FETCH_OBJ);
$stmt2 = $connection->prepare("SELECT * FROM people");
$stmt2->execute();
$total_row = $stmt2->rowCount();
$total_page = ceil($total_row / $limit);

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>All people</title>
</head>
<body class="bg-info">
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>All people</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
                <?php foreach ($people as $person): ?>
                    <tr>
                        <td><?= $person->id ?></td>
                        <td><?= $person->name ?></td>
                        <td><?= $person->email ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <!--            pagination bootstrap-->
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item <?= $page <= 1? 'disabled':''?>">
                        <a class="page-link" href="/?page=<?= $page - 1 ?>" tabindex="-1">Previous</a>
                    </li>
                    <?php for ($i = 1; $i <= $total_page; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>"><a class="page-link" href="/?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?= $page >= $total_page ? 'disabled' : '' ?>">
                        <a class="page-link" href="/?page=<?= $page + 1 ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>


</body>
</html>
