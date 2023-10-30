<?php
    Interface IUtilisateur{
        public function inscrire($nomUser,$prenomUser,$telephoneUser,$emailUser,$motDePasseUser);
        public function seConnecter($emailUser,$motDePasseUser);
        public static function listeUtilisateur();
    }
?>