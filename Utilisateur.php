<?php
    require_once('IUtilisateur.php');
    require_once('bd.php');
    

    class Utilisateur implements IUtilisateur{
        private $nom;
        private $prenom;
        private $telephone;
        private $email;
        private $motDePasse;

        // public function __construct($nomUser,$prenomUser,$telephoneUser,$emailUser,$motDePasseUser){
            // $this->setNom($nomUser);
            // $this->setPrenom($prenomUser);
            // $this->setTelephone($telephoneUser);
            // $this->setEmail($emailUser);
            // $this->setMotDePasse($motDePasseUser);
        // }

        // public function __construct($emailUser,$motDePasseUser){
        //     // $this->setNom($nomUser);
        //     // $this->setPrenom($prenomUser);
        //     // $this->setTelephone($telephoneUser);
        //     $this->setEmail($emailUser);
        //     $this->setMotDePasse($motDePasseUser);
        // }

        public function getNom(){
            return $this->nom;
        }

        public function setNom($nomUser){
            $regexName='/^[a-z]{2,20}$/i';
            if(preg_match($regexName,$nomUser)){
                $this->nom=$nomUser;
            }else{
                throw new Exception("Entrer un nom valide");
            }

        }

        public function getPrenom(){
            return $this->prenom;
        }

        public function setPrenom($prenomUser){
            $regexName='/^[a-z]{2,20}$/i';
            if(preg_match($regexName,$prenomUser)){
                $this->prenom=$prenomUser;
            }else{
                throw new Exception("Entrer un prenom valide");
            }
        }

        public function getTelephone(){
            return $this->telephone;
        }

        public function setTelephone($telephoneUser){
            $regex='/^(77|76|75|78)+[0-9]/';
            if(preg_match($regex,$telephoneUser)){
                $this->telephone=$telephoneUser;
            }else{
                throw new Exception("Entrer un numéro de telephone valide");
            }
        }

        public function getEmail(){
            return $this->email;
        }

        public function setEmail($emailUser){
            $regexEmail='/^[a-zA-Z.+_à0-9]+@[-0-9a-zA-Z.+_]+.[a-z]{2,4}/';
            if(preg_match($regexEmail,$emailUser)){
                $this->email=$emailUser;
            }else{
                throw new Exception("Entrer un addresse mail valide");
            }
        }

        public function getMotDePasse(){
            return $this->motDePasse;
        }

        public function setMotDePasse($motDePasseUser){
            if(strlen($motDePasseUser)>=8){
                $this->motDePasse=$motDePasseUser;
            }else{
                throw new Exception("Entrer un mot de passe de 8 caracteres au moins");
            }
        }

        public function inscrire($nomUser,$prenomUser,$telephoneUser,$emailUser,$motDePasseUser,$BD){
            $this->setNom($nomUser);
            $this->setPrenom($prenomUser);
            $this->setTelephone($telephoneUser);
            $this->setEmail($emailUser);
            $this->setMotDePasse($motDePasseUser);

           
            echo "Inscription réussi !!";

            $insert="INSERT INTO utilisateur(nom_utilisateur,prenom_utilisateur,email_utilisateur,tel_utilisateur,password_utilisateur) 
            VALUES('$this->nom','$this->prenom','$this->email','$this->telephone','$this->motDePasse')";
            $BD->query($insert);
        }

        public function seConnecter($emailUser,$motDePasseUser,$BD){
            session_start();
            $this->setEmail($emailUser);
            $this->setMotDePasse($motDePasseUser);
            

            $connect="SELECT * FROM utilisateur WHERE email_utilisateur='$this->email'AND password_utilisateur='$this->motDePasse'";
            $save=$BD->query($connect)->fetch();

            if($save){
                $con="SELECT nom_utilisateur,prenom_utilisateur FROM utilisateur WHERE email_utilisateur='$this->email'AND password_utilisateur='$this->motDePasse'";
                $test=$BD->query($con)->fetch();

                echo "Connexion reussi !😊 Bienvenue ".$test['prenom_utilisateur']."
                ".$test['nom_utilisateur'];
                $_SESSION['email']=$this->email;
                $_SESSION['password']=$this->motDePasse;
                echo " <a href='ListeUser.php' >Voir liste utilisateur </a>";
            }else{
                echo "email et/ou mot de passe incorrect !😮";
            }
        }

        public static function listeUtilisateur(){
            global $BD;
            $selection="SELECT * FROM utilisateur";
            $select= $BD->query($selection)->fetchAll();

            echo "<table>";
            echo "<tr style='background-color:lightblue;' >";
            echo "<th>".'Nom'."</th>";
            echo "<th>".'Prenom'."</th>";
            echo "<th>".'email'."</th>";
            echo "<th>".'telephone'."</th>";
            echo "</tr>";
            foreach ($select as $s){
                echo "<tr>";
                echo "<td>".$s['nom_utilisateur']."</td>";
                echo "<td>".$s['prenom_utilisateur']."</td>";
                echo "<td>".$s['email_utilisateur']."</td>";
                echo "<td>".$s['tel_utilisateur']."</td>";
                echo "</tr>"; 
            }
            echo "</table>";
        }
    }
?>


