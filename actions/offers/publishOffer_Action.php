<?php
require('actions/connection.php');
require('actions/utilities.php');
if (isset($_POST['submit'])) {
    if (!empty($_POST['title']) and !empty($_POST['description'])) {
        $offer_title = htmlspecialchars($_POST['title']);
        $offer_desc = nl2br(htmlspecialchars($_POST['description']));
        $offer_city = $_POST['city'];
        $offer_job = $_POST['job'];
        $offer_contract = $_POST['contract'];
        $offer_ref = generateRandomString();
        $offer_date = date('d/m/Y à H:i');
        $offer_id_author = $_SESSION['enterprise_id'];
        $req_Add_offer = $mysql->prepare('INSERT INTO offers(offer_title,offer_description,created_at,enterprise_id,city,contract_type,job_type,reference) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
        $req_Add_offer->execute(array($offer_title, $offer_desc, $offer_date, $offer_id_author, $offer_city, $offer_contract, $offer_job, $offer_ref));
        header('Location:index.php?page=1');
    } else {
        $errorMsg = "Veuillez compléter tous les champs";
    }
}
