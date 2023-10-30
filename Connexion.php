<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Connexion.css">
    <title>Document</title>
</head>
<body>
    <?php
        require_once('Utilisateur.php');
        if(isset($_POST['connexion'])){
            $email = $_POST['email'];
            $motDePasse = $_POST['motDePasse'];

            if(empty($_POST['email']) || empty($_POST['motDePasse'])){
                echo "Tous les champs sont obligatoires";
            }else{
                $user1= new Utilisateur ($email,$motDePasse);
                $user1->seConnecter($email,$motDePasse,$BD);
            }
        }
    ?>
    <form action="" method="post" class="formulaire">
        <h1>Connexion</h1>
        <h4>Votre chauffeur en un clic !</h4>
        <br>
        <button type="submit" class="facebook">Continuer avec facebook</button>
        <br>
        <br>
        <h4>-----------------------------------OU-----------------------------------</h4>
        <Label>EMAIL</Label>
        <br>
        <br>
        <input type="text" name="email" id="" placeholder="Entre Votre E-mail">
        <br>
        <br>
        <Label>MOT DE PASSE</Label>
        <br>
        <br>
        <input type="password" name="motDePasse" id="" placeholder="Entre Votre mot de passe">
        <br>
        <br>
        <div class="aligner">
            <a href="">J'ai deja un compte</a>
            <button type="submit" name="connexion" class="inscrire">Connecter➡</button>
        </div>
    </form>
</body>
</html>