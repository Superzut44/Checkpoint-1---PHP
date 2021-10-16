<?php

require_once __DIR__. '/../connec.php';
$pdo = new PDO(DSN, USER, PASS);



$errors = [];

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

    $name = $_POST['name'];
    $payment = $_POST['payment'];

    if (empty($name)) {
        $errors[] = 'The name is required !';
    }
    if (empty($payment)) {
        $errors[] = 'The payment is required !';
    }
    if (!empty($payment) && $payment <= 0) {
        $errors[] = 'Payment of 0 or less not possible !';
    }
    if (empty($errors)) {
        
        $pdo = new PDO(DSN, USER, PASS);
        $query = 'INSERT INTO bride(name, payment) VALUES (:name, :payment)';
        $statement = $pdo->prepare($query);
        $statement->bindValue(':name', $name , PDO::PARAM_STR);
        $statement->bindValue(':payment', $payment, PDO::PARAM_INT);
        $statement->execute();

        header('Location: /book.php');
        exit();
    }
}

$query = 'SELECT name, payment FROM bride';
$statement = $pdo->prepare($query);
$statement->execute();
$brides = $statement->fetchAll((PDO::FETCH_ASSOC));

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
                <?php foreach ($errors as $error) : ?>
                <p><?= $error ?></p>
                <?php endforeach; ?>
                <form action="" method="POST" class="form">
                    <div class="form-name">
                        <label for="name">Name: </label></br>
                        <input type="text" name="name" id="name" value="<?= $name ?? '' ?>" >
                    </div>
                    <div class="form-payment">
                        <label for="payment">Payment: </label></br>
                        <input type="number" name="payment" id="payment" value="<?= $payment ?? '' ?>" >
                    </div>
                    <div class="form-submit">
                        <input type="submit" value="Pay!">
                    </div>
                </form>
            </div>

            <div class="page rightpage">
                <table class="table">
                    <caption>S</caption>
                    <tbody>
                        <?php $total=0 ?>
                        <?php foreach ($brides as $bride): $total += $bride['payment']?>
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
                </table>
            </div>
        </div>
        <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
    </section>
</main>
</body>
</html>
