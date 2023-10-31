<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Inscription.css">
    <title>Inscription</title>
</head>
<body>

    <?php
        require_once('Utilisateur.php');
        if(isset($_POST['inscrire'])){
            $nom = $_POST['nom'];
            $prenom= $_POST['prenom'];
            $telephone = $_POST['telephone'];
            $email = $_POST['email'];
            $motDePasse = $_POST['motDePasse'];
            $verif="SELECT * FROM utilisateur WHERE email_utilisateur='$email'";
            $ver=$BD->query($verif)->fetch();
            $verifNum="SELECT * FROM utilisateur WHERE tel_utilisateur='$telephone'";
            $verNum=$BD->query($verifNum)->fetch();
            if(empty($prenom)|| empty($nom) || empty($telephone) || empty($motDePasse) || empty($email)){
                echo "Veuillez renseigner tous les champs";
            }elseif ($ver) {
                echo "Ce mail existe deja choisissez un autre";
            }elseif($verNum){
                echo "Ce numero de telephone existe deja";
            }else{
                $user1= new Utilisateur ();
                $user1->inscrire($nom,$prenom,$telephone,$email,$motDePasse,$BD);
            }
        }
    
    ?>
    <form action="" method="post" class="formulaire">
        <h1>Bienvenue</h1>
        <h4>Finaliser votre inscription en renseignant les champs manqunates</h4>
        <br>
        <div class="test">
            <div>
                <Label>PRENOM</Label>
                <br>
                <br>
                <input type="text" name="prenom" id="" placeholder="Entre Votre Prenom" >
            </div>
            <div id="nom">
                <Label >NOM</Label>
                <br>
                <br>
                <input type="text" name="nom" placeholder="Entre Votre Nom" >
            </div>
        </div>
        <br>
        <br>
        <div>
            <Label>TELEPHONE</Label>
            <br>
            <input type="text" name="telephone" id="tel" placeholder="Entrer Votre N° Telephone" >
        </div>
        <br>
        <br>
        <div>
            <Label>EMAIL</Label>
            <br>
            <input type="text" name="email" id="email" placeholder="Entrer Votre E-Mail" >
        </div>
        <br>
        <br>
        <div>
            <Label>PASSWORD</Label>
            <br>
            <input type="password" name="motDePasse" id="mdp" placeholder="Entrer Votre Mot de passe" >
        </div>
        <br>
        <br>
        <a href="">🎁Ajouter un code promo</a>
        <br>
        <br>
        <button type="submit" name="inscrire" class="inscrire">S'inscrire ➡</button>
        <br>
        <a href="Connexion.php">Se Connecter</a>
    </form>
</body>
</html>