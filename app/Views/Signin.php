<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN IN</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</head>
<body>
    <div class="flex w-screen h-screen justify-center items-center">
        <form method="POST" action="">
            <div style="padding:1rem;">
                <label for="text"><strong>Nombre*</strong></label>
                <input style="border: 1px solid black;display:inline-block" type="text" name="nombre" id="nombre" value="<?=$nombre?>">
            </div>
            <div class="p-4">
                <label for="username"><strong>Email*</strong></label>
                <input style="border: 1px solid black;display:inline-block" type="text" name="email" id="text" value="<?=$email?>">
            </div> 
            <div class="p-4">
                <label for="username"><strong>Username*</strong></label>
                <input style="border: 1px solid black;display:inline-block" type="text" name="username" id="username" value="<?=$username?>">
            </div>
            <div style="padding:1rem;">
                <label for="password"><strong>Password*</strong></label>
                <input style="border: 1px solid black;display:inline-block" type="password" name="password" id="password" value="<?=$password?>">
            </div> 
            <div class="p-4">
                <label for="username">Ciudad</label>
                <input style="border: 1px solid black;display:inline-block" type="text" name="ciudad" id="text" value="<?=$ciudad?>">
            </div> 
            <div style="padding:1rem;">
                <label for="humancheck"><strong>Verificacion*</strong></label>
            <?=$num1?> - <?=$num2?> = <input style="border: 1px solid black;display:inline-block" type="number" name="resultado" id="humancheck">
            </div>
            <div class="flex justify-center p-4">
            <input style=" border: 1px solid black;display:block" type="submit" name="submit" value="Entrar">
            <input type="hidden" value="<?=$num1?>" name="num1">
            <input type="hidden" value="<?=$num2?>" name="num2">

         <?php if ($message): ?>
         <span style="color:red;"><?=$message?></span>
        <?php endif?>    
            </div> 

        </form>
    </div>
</body>

</html>