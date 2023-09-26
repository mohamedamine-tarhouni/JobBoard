<?php
session_start();
require("actions/connection.php");
require("actions/utilities.php");
if (isset($_POST['submit'])) {
    if (!empty($_POST['username']) and !empty($_POST['password']) and !empty($_POST['mail'])) {
        $username = htmlspecialchars($_POST['username']);
        $mail = htmlspecialchars($_POST['mail']);
        $enterprise = $_POST['enterprise'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $password_verif = htmlspecialchars($_POST['password']);
        $password_confirm = htmlspecialchars($_POST['confirm_password']);
        //Verifier si l'utilisateur existe dans la bdd
        $req_User_Exists = User_exists($username, "username");
        $req_Mail_Exists = User_exists($mail, "mail");
        if (
            $req_User_Exists->rowCount() == 0 && $req_Mail_Exists->rowCount() == 0
            && final_Verification($username, "nom d'utilisateur", 2, 20) == "true"
            && final_Verification($password_verif, "mot de passe", 8, 25) == "true"
            && $password_verif == $password_confirm
        ) {
            echo $enterprise;
            //insertion de l'utilisateur dans la base de données
            $req_Add_User = $mysql->prepare('INSERT INTO users(username,password,mail,enterprise_id) VALUES(?, ?, ?,?)');
            $req_Add_User->execute(array($username, $password, $mail,$enterprise));
            $getInfosOfThisUser = $mysql->prepare('SELECT * from users WHERE username = ? AND mail = ?');
            $getInfosOfThisUser->execute(array($username, $mail));
            $userInfos = $getInfosOfThisUser->fetch();

            // //authentification de l'utilisateur
            $_SESSION['auth'] = true;
            $_SESSION['ID_User'] = $userInfos['id'];
            $_SESSION['username'] = $userInfos['username'];
            $_SESSION['password'] = $userInfos['password'];
            $_SESSION['mail'] = $userInfos['mail'];
            $_SESSION['enterprise_id'] = $userInfos['enterprise_id'];
            //Redirection vers la page d'Accueil
            header('Location: index.php?page=1');
        } else {
            if ($req_User_Exists->rowCount() > 0) {
                $errorMsg_Username = " Le pseudo $username existe déjà";
            } else if (final_Verification($username, "nom d'utilisateur", 2, 20) != "true") {
                $errorMsg_Username = final_Verification($username, "nom d'utilisateur", 2, 20);
            }
            if (final_Verification($password_verif, "mot de passe", 8, 25) != "true") {
                $error_MDP = final_Verification($password_verif, "mot de passe", 8, 25);
            } else if ($password_verif != $password_confirm) {
                $error_MDP = "Veuillez confirmer le mot de passe";
            }
            if ($req_Mail_Exists->rowCount() > 0) {
                $errorMsg_Mail = " Le mail $mail existe déjà";
            }
        }
    } else {
        $username = htmlspecialchars($_POST['username']);
        $mail = htmlspecialchars($_POST['mail']);
        $password_verif = htmlspecialchars($_POST['password']);
        $errorMsg = " Veuillez compléter tous les champs...";
    }
}
