<?php
    if (isset($_POST['loginenvoi'])) {
        extract($_POST);
            if (!empty($lemail) && !empty($lpassword)){

                $q = $db->prepare("SELECT * FROM user WHERE email = :email ");
                $q->execute(['email'=>$lemail]);
                $result = $q->fetch();
                
                if ($result == true){

                    $hasspassword = $result['password'];
                    if(password_verify($lpassword,$hasspassword)){
                        $_SESSION['email'] = $result['email'];
                        ?>
                        <meta http-equiv="refresh" content="0;url=matchmaking.php">
                        <?php
                    }
                    else{
                        echo "le mot de passe n'est pas bon.";
                    }
                }
                else{
                    echo "le compte avec l'email : " . $lemail . " n'existe pas.";
                }
            } 
    }     
    else{
        echo ("les champs ne sont pas tous remplies");
    }
    
?>