<?php
    Interface IUtilisateur{
        public function inscrire($nomUser,$prenomUser,$telephoneUser,$emailUser,$motDePasseUser,$BD);
        public function seConnecter($emailUser,$motDePasseUser,$BD);
        public static function listeUtilisateur();
    }
?>