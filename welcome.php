<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestige electronics</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body class="body-bg">
    <div class="container">
        <h1 class="title">Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?>!</h1>
        <p class="text text-md-padding">Morgan and Mark are still working on this page</p>
    </div>
</body>
</html>
