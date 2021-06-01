<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</head>
<body>
    <div class="flex w-screen h-screen justify-center items-center">
        <form method="POST" action="">
            <div class="p-4">
                <label for="username">Username</label>
                <input style="border: 1px solid black;display:inline-block" type="text" name="username" id="username" value="<?=$username?>">
                
            </div>
            <div style="padding:1rem;">
                <label for="password">Password</label>
                <input style="border: 1px solid black;display:inline-block" type="password" name="password" id="password">
            </div> 
            <div class="flex justify-center p-4">
            <input style=" border: 1px solid black;display:block" type="submit" name="submit" value="Entrar">
         <?php if ($message): ?>
         <span style="color:red;"><?=$message?></span>
        <?php endif?>    
            </div> 

        </form>
    </div>
</body>

</html>