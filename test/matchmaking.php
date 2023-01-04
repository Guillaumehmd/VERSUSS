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
        {}
    else{
            ?>
                <meta http-equiv="refresh" content="0;url=index.php">
            <?php
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
    <button onclick="window.location.href = 'deco.php';">Déconnexion</button>
    <h1>Matchmaking :</h1>
    <form method="post">
        Choisit ton jeu ! <select name="jeu" type="text" id="jeu">
        <option value="lol">lol</option>
        <option value="rl">rl</option>
        <option value="fifa">fifa</option>
        <option value="Clash">Clash</option>
        </select><br>
        Fixe une mise ! <select name="mise" type="text" id="mise">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="50">50</option>
        <option value="100">100</option>
        </select><br>
    Pseudo In game : <input type="text" name="pseudo" placeholder="XXxQuentinXxx" id="pseudo" required><br/>
     <input type="submit" name="envoi" id='envoi' value="trouver un joueur">
    </form> 
    <?php 
    if (isset($_POST['envoi'])){
        extract($_POST);
            if (!empty($jeu) && !empty($mise) && !empty($pseudo)){
                $c = $db->prepare("SELECT pseudo FROM matchmaking WHERE pseudo = :pseudo");
                $c->execute([
                        'pseudo'=>$pseudo
                    ]);  
                $result = $c->rowCount();
                if ($result == 0){
                    $q = $db->prepare("INSERT INTO matchmaking(jeu,mise,pseudo) Values(:jeu,:mise,:pseudo)");
                    $q->execute([
                    'jeu' => $jeu,
                    'mise' => $mise,
                    'pseudo' => $pseudo 
                    ]);
                        echo "Vous venez de rejoindre la file";
                        sleep(3);
                        $q= $db->prepare("SELECT * FROM matchmaking WHERE mise=:mise and jeu=:jeu");
                        $q->execute([
                            'mise'=>$mise,
                            'jeu'=>$jeu,
                        ]);
                        $players = $q->fetchAll();
                        var_dump($players);
                    
                }   
                else{
                        echo "Vous êtes deja dans la file : <br>" . $jeu ;
                    }
                
            }
            else{
                echo "les champs ne sont pas tous remplies";
            }
            
        }
    else{
        echo ("les champs ne sont pas tous remplies");
        }
    ?>
    </body>
    
    </html>
    
            