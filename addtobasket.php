<?php
    require('session.php');

if (isset($_GET['idgame'])) {
    $idgame = $_GET['idgame'];

    // Get the current basket
    $basket = $_SESSION['basket'];

    // Modify the basket
    $found = false;
    for ($i = 0; $i < count($basket); $i++) {
        if ($basket[$i]['idgame'] == $idgame) {
            $found = true;
            $basket[$i]['quantity'] = $basket[$i]['quantity'] + 1;
        }
    }
    if (!$found) {
        array_push($basket, ['idgame' => $idgame, 'quantity' => 1]);
    }

    // Save the basket
    $_SESSION['basket'] = $basket;

    header('Location: basket.php');
    exit();
}

header('Location: index.php');
exit();
