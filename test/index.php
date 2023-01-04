<?php session_start();?>
<!DOCTYPE html>
    <html>
    <head>
    <title>Rempli</title>
    </head>
    <body>
    <?php
    include 'database.php';
    global $db;
    if(isset($_SESSION['email']))
        {
            ?>
                <meta http-equiv="refresh" content="0;url=matchmaking.php">
            <?php
        }
        else{
        }
    ?>
    <h1>Profil :</h1>
    <?php 
        if(isset($_SESSION['email']))
        {
            ?>
            <p>Email : <?php echo $_SESSION['email']?></p>
            <?php
        }
        else{
            echo "Veuillez vous connecter";
        }
    ?>
    <h1>Inscription :</h1>
    <a href="inscriptions.php">inscriptions ici</a><br><br><br><br><br>
    <h1>Connexion :</h1>
    <form method="post">
        <input type="email" name="lemail" id="lemail" placeholder="Votre email" autocomplete="current-email" required><br>
        <input type="password" name="lpassword" id="lpassword" autocomplete="current-password" placeholder="Votre mot de passe" required><br>
        <input type="submit" name="loginenvoi" id='loginenvoi' value="se connecter">
    </form>
    <?php include'login.php'?>
    </body>
    
    </html>
    
            