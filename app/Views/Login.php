<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <script src="./js/login.js"></script>
</head>
<body>
    <div style="display:flex;width:100%; height:100vh;justify-content:center;align-items:center;">
        <form method="POST" action="">
            <div style="padding:1rem;">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="<?=$username?>">
                
            </div>
            <div style="padding:1rem;">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div> 
            <div style="padding:1rem; display:flex;justify-content:center;">
            <input style="display:block" type="submit" name="submit" value="Entrar">
         <?php if ($message): ?>
         <span style="color:red;"><?=$message?></span>
        <?php endif?>    
            </div> 

        </form>
    </div>
</body>

</html>