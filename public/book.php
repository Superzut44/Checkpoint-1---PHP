<?php

require_once __DIR__. '/../connec.php';
$pdo = new PDO(DSN, USER, PASS);


$query = 'SELECT name, payment FROM bride';
$statement = $pdo->prepare($query);

$statement->execute();

$brides = $statement->fetchAll((PDO::FETCH_ASSOC));


$total = 0;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/book.css">
    <title>Checkpoint PHP 1</title>
</head>
<body>

<?php include 'header.php'; ?>

<main class="container">

    <section class="desktop">
        <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>
        <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky"/>

        <div class="pages">
            <div class="page leftpage">
                Add a bribe
                <!-- TODO : Form -->
            </div>

            <div class="page rightpage">
                <table>
                    <caption>S</caption>
                    <tbody>
                        <?php foreach ($brides as $bride): ?>
                            <?php $total += $bride['payment'] ?>
                        <tr>
                            <td><?= $bride['name'] ?></td>
                            <td><?= $bride['payment'] ?>€</td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Total</th>
                            <th><?= $total ?>€</th>
                        </tr>
                    </tfoot>
                        <tr><?= $total ?></tr>

                        
                    </table>
                
            </div>
        </div>
        <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
    </section>
</main>
</body>
</html>
