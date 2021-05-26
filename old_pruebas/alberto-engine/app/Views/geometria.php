<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geometria</title>
</head>

<body>
    <div>
        <h1>Calculadora de areas</h1>
        <div>
        <h3>Triangulo</h3>
        <form action="./calcular" method="POST">
            <label for="base">Base</label>
            <input type="number" id="base" name="base">
            <label for="altura">Altura</label>
            <input type="number" id="altura" name="altura">
            <input type="submit" value="Calcular">
        </form>
        </div>

        <div>
        <h3>Trapecio</h3>
        <form action="./calcular" method="POST">
            <label for="base_mayor">Base mayor</label>
            <input type="number" id="base_mayor" name="base_mayor">
            <label for="base_menor">Base menor</label>
            <input type="number" id="base_menor" name="base_menor">
            <label for="altura">Altura</label>
            <input type="number" id="altura" name="altura">

            <input type="submit" value="Calcular">
        </form>
        </div>
        <?php
        if (isset($data[0])){
            ?>        
            <p>El area calculada es... :<?=$data[0]?></p>

            <?php }?>
    </div>
</body>

</html>