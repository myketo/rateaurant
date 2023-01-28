<?php

spl_autoload_register(function ($className) {
    include 'app/classes/' . $className . '.php';
});

if (isset($_POST['service_rating'])) {
    $restaurantRating = new RestaurantRating();

    $redirect = $_POST['redirect'] ?? $_SERVER['HTTP_REFERER'];
    unset($_POST['redirect']);

    if ($restaurantRating->insert($_POST)) {
        header('Location: ' . $redirect);
        die();
    }
}

if (!isset($_GET['page']) || !file_exists('app/views/' . $_GET['page'] . '.php')) {
    $_GET['page'] = 'home';
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/styles/style.css">
    <title>RATEaurant</title>
</head>
<body>
    <?php include('app/views/layout/header.php'); ?>

    <main>
        <?php include('app/views/' . $_GET['page'] . '.php'); ?>
    </main>

    <?php include('app/views/layout/footer.php'); ?>
</body>
</html>
