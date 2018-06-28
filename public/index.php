<?php
require '../app/app.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Волна // Паб // Let us wave! // 18+</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="menu">

<div class="container-fluid">

    <?php if (
        isset($_GET['id'])
        && $beer = $app->getBeer($_GET['id'])
    ) { ?>
        <div class="row">
            <div class="col-md-12">
                <h1><a href="/">Меню</a></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table>
                    <thead>
                    <tr>
                        <th colspan="2"><?php echo $beer['name']; ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <a href="/index.php?vote=<?php echo $beer['id']; ?>&say=1">
                                Хорошо
                            </a>
                        </td>
                        <td>
                            <a href="/index.php?vote=<?php echo $beer['id']; ?>&say=0">
                                Плохо
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } else { ?>
        <div class="row">
            <div class="col-md-12">
                <table>
                    <thead>
                    <tr>
                        <th>Волна</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($app->getListOfBeers() as $beer) { ?>
                        <tr>
                            <td>
                                <a href='/index.php?id=<?php echo $beer['id']; ?>'>
                                    <?php echo $beer['name']; ?>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } ?>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>