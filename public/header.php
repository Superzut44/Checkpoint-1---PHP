<header>
    <nav class="navbar">
    <img src="image/logo.png" class="logo" alt="logo-wcs"/>
        <a href="index.php">Instructions</a>
        <a href="book.php">Secret book</a>
    </nav>
    <nav class="navbarAlphabetical">
        <?php $letters = range ( 'A', 'Z' );
              $letterChosen = "S";
              foreach ( $letters as $letter ): ?>
        <a href="book.php" ><?= $letter ?></a>
        <?php endforeach; ?>
    </nav>
</header>
