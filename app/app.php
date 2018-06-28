<?php
session_start();
error_reporting(E_ALL);

require 'app.class.php';
$config = require 'config.php';

$app = new App($config);
if (!empty($_POST)) {
    if(isset($_POST['login'])
        && isset($_POST['password'])
        && $_POST['login'] === $config['admin']['login']
        && $_POST['password'] === $config['admin']['password']
    ) {
        $app::signIn();
    }

    if ($app::isSignedIn()) {
        if (isset($_POST['new_beer'])) {
            if (isset($_POST['beer_id']) && $_POST['beer_id']) {
                $app->updateBeer($_POST['beer_id'], $_POST['new_beer']);
            } else {
                $app->addNewBeer($_POST['new_beer']);
            }
        }
    }
}

if (!empty($_GET)) {
    if (
        isset($_GET['del'])
        && $app::isSignedIn()
    ) {
        $app->deleteBeer($_GET['del']);
    }
    if (
        isset($_GET['vote'])
        && isset($_GET['say'])
    ) {
        $app->vote($_GET['vote'], $_GET['say']);
    }
}



