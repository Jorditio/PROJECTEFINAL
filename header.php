<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Manifold</title>
    <link rel="stylesheet" type="text/css" href="styles\header.css">
    <link rel="stylesheet" type="text/css" href="styles\login.css">
    <link rel="stylesheet" type="text/css" href="styles\register.css">
    <link rel="stylesheet" type="text/css" href="styles\index.css">
    <link rel="stylesheet" type="text/css" href="styles\cotxes.css">
    <link rel="stylesheet" type="text/css" href="styles\userconfig.css">
    <link rel="stylesheet" type="text/css" href="styles\userconfigss.scss">
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
                <?php if (isset($_COOKIE["usuari"])) { ?>
                    <a href="insert.php"><button id="insert">INSERT</button></a>
                    <?php }?>
                    <?php if (!isset($_COOKIE["usuari"])) { ?>
                        <a href="login.php"><button id="login">LOG IN</button></a>
                    <?php }else {  ?>
                        <a href="login.php?logout"><button id="login">LOG OUT</button></a>
                        <a href="userconfig.php"><button><?php echo strtoupper($_COOKIE["usuari"])?></button></a>
                    <?php } ?>
                 </div>
            </div>
        </nav>
    </header>