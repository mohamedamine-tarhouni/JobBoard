<?php
session_start();
require('actions/connection.php');
if (isset($_POST['submit'])) {
    //Verifier si les champs ne sont pas vides
    if (!empty($_POST['username']) and !empty($_POST['password'])) {
        $userdata = htmlspecialchars($_POST['username']); //Email ou Username
        $password = htmlspecialchars($_POST['password']); //mot de passe

        //Verifier si l'utilisateur existe
        $req_User_Exists = $mysql->prepare("SELECT * FROM users WHERE mail= ? OR username= ? ");
        $req_User_Exists->execute(array($userdata, $userdata));
        //si l'utilisateur existe on verifie si le mot de passe est correcte
        if ($req_User_Exists->rowCount() > 0) {
            $userInfos = $req_User_Exists->fetch();
            if (password_verify($password, $userInfos['password'])) {

                //authentification de l'utilisateur
                $_SESSION['auth'] = true;
                $_SESSION['ID_User'] = $userInfos['id'];
                $_SESSION['username'] = $userInfos['username'];
                $_SESSION['password'] = $userInfos['password'];
                $_SESSION['mail'] = $userInfos['mail'];
                $_SESSION['enterprise_id'] = $userInfos['enterprise_id'];
                header('Location: index.php?page=1');
            } else { //faux mot de passe
                $errorMsg = "Veuillez verifier les données saisies";
            }
        } else { //Utilisateur inexistant
            $errorMsg = "Veuillez verifier les données saisies";
        }
    } else { //les champs ne sont pas tous complets
        $userdata = htmlspecialchars($_POST['username']); //Email ou Username
        $password = htmlspecialchars($_POST['password']); //mot de passe
        $errorMsg = "Veuillez Compléter tous les champs";
    }
}
