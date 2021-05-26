<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
</head>
<body>
<nav>
    <div>
        <?php if ($isLogged):?>
        <a href="/logout">Cerrar sesion</a>
        <?php else:?>
        <a href="/login">Iniciar sesion</a>
        <?php endif?>
    </div>
</nav>

    <?=$data['message'] ?>
</body>
</html>