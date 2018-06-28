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
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1>Волна</h1>
        </div>
    </div>
    <?php if ($app::isSignedIn()) { ?>
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="/admin.php">
                    <div class="form-group">
                        <label for="new_beer">Название пива</label>
                        <input class="form-control" name="new_beer" id="new_beer" placeholder="Название" type="text">
                    </div>
                    <input name="beer_id" id="beer_id" type="hidden" value="">
                    <button type="submit" class="btn btn-default">Сохранить</button>
                    <button type="button" class="btn btn-default reset">Сбросить</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Название</th>
                        <th>Голосов за</th>
                        <th>Голосов против</th>
                        <th colspan="2">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($app->getAdminBeers() as $beer) { ?>
                        <tr>
                            <th scope="row"><?php echo $beer['id']; ?></th>
                            <td><?php echo $beer['name']; ?></td>
                            <td><?php echo $beer['votes']['pro']; ?></td>
                            <td><?php echo $beer['votes']['contra']; ?></td>
                            <td>
                                <a href="#" class="change" data-id="<?php echo $beer['id']; ?>" data-name="<?php echo $beer['name']; ?>">Изменить</a>
                            </td>
                            <td>
                                <a href="admin.php?del=<?php echo $beer['id']; ?>">Удалить</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } else { ?>
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="/admin.php">
                    <div class="form-group">
                        <label for="login">Логин</label>
                        <input class="form-control" name="login" id="login" placeholder="Логин" type="text">
                    </div>
                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input class="form-control" name="password" id="password" placeholder="Пароль" type="password">
                    </div>
                    <button type="submit" class="btn btn-default">Вход</button>
                </form>
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