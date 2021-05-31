<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
    <link rel="stylesheet" href="./css/principal.css">
    <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
  <script src="./js/principal.js"></script>
</head>
<body>
<nav>
   <ul>
      <li class="active">
      <?php if ($isLogged):?>
        <a href="/logout">Cerrar sesion</a>
        <?php else:?>
        <a href="/login">Iniciar sesion</a>
        <?php endif?>
      </li> 
   </ul> 
    <div>

    </div>
</nav>
<header>
<h1>BIENVENIDO A <strong>alberto-shop</strong></h1>
</header>
<main>
    <section class="productos">
        <div class="producto">
            <h1>Producto</h1>
            <p>Descripcion</p>
            <span>20€</span>
        </div>
    </section>
</main>
</body>
</html>