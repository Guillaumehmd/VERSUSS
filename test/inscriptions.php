<!DOCTYPE html>
    <html>
    <head>
    <title>Rempli</title>
    </head>
     
    <body>
    <form method="post">
        Création de compte : <br><br>
        <input type="text" name="nom" id="nom" placeholder="Votre Nom" required><br>
        <input type="text" name="prenom" id="prenom" placeholder="Votre Prénom" required><br>
        <input type="number" name="age" id="age" placeholder="Votre age" required><br>
        <input type="number" name="tel" id="tel" placeholder="numéro de télephone" pattern="[0-9]" maxlength="10" required><br>
        <input type="email" name="email" id="email" placeholder="Votre email" required><br>
        <input type="password" name="password" id="password" minlength="8" placeholder="Votre mot de passe" required><br>
        <input type="password" name="cpassword" id="cpassword" placeholder="Confirmez votre mot de passe" required><br>
        <input type="submit" name="envoi" id='envoi' value="creer un compte">
    </form>
    <br><br>
    <br><br>;
    <?php
    if (isset($_POST['envoi'])) {
        extract($_POST);
            if (!empty($nom) && !empty($prenom) && !empty($age) && !empty($tel) && !empty($email) && !empty($password) && !empty($cpassword)){
                if($password == $cpassword){

                    $options = [
                        'cost'=>12,
                    ];

                    $hashpass = password_hash($password, PASSWORD_BCRYPT, $options);
                    include 'database.php';
                    global $db;

                    $c = $db->prepare("SELECT email,tel FROM USER WHERE email = :email AND tel = :tel");
                    $c->execute([
                        'email'=>$email,
                        'tel'=>$tel
                    ]);  
                    $result = $c->rowCount();
                    if ($result == 0){
                        $q = $db->prepare("INSERT INTO user(nom,prenom,age,tel,email,password) Values(:nom,:prenom,:age,:tel,:email,:password)");
                        $q->execute([
                        'nom' => $nom,
                        'prenom' => $prenom,
                        'age' => $age,
                        'tel' => $tel,
                        'email' => $email,
                        'password' => $hashpass
                        ]);
                        echo "Le compte a bien été crée";
                    }
                    else{
                        echo "Un email ou un télephone existe deja";
                    }
                }
                else{
                    echo "les mots de passe ne correspondents pas";
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
    
            