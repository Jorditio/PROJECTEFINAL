<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manifold</title>
    <link rel="stylesheet" type="text/css" href="styles\header.css">
    <link rel="stylesheet" type="text/css" href="styles\login.css">
    <link rel="stylesheet" type="text/css" href="styles\register.css">
    <link rel="stylesheet" type="text/css" href="styles\index.css">
    <link rel="stylesheet" type="text/css" href="styles\cotxes.js">
    <link rel="stylesheet" type="text/css" href="styles\cotxes.css">
</head>

<body>
    <header>
        <nav>
            <div id="manifold">
                <?php if (!isset($_COOKIE["usuari"])) { ?>
                    <a href="index.php"><button id="HOME">MANIFOLD</button></a>
                <?php }else {  ?>
                    <a href="cotxes.php"><button id="HOME">MANIFOLD</button></a>
                <?php } ?>
            </div>
            <div id="wrapp1">
                <div id="wrapp2">
                    <a href="insert.php"><button id="insert">INSERT</button></a>
                    <?php if (!isset($_COOKIE["usuari"])) { ?>
                        <a href="login.php"><button id="login">LOG IN</button></a>
                    <?php }else {  ?>
                        <a href="login.php?logout"><button id="login">LOG OUT</button></a>
                        <a href="insert.php"><button><?php echo $_COOKIE["usuari"]?></button></a>
                    <?php } ?>
                 </div>
            </div>
        </nav>
    </header>