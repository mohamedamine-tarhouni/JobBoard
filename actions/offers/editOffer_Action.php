<?php
require('actions/connection.php');
if (isset($_POST['submit'])) {
    if (!empty($_POST['title']) and !empty($_POST['description'])) {
        $offer_title = htmlspecialchars($_POST['title']);
        $offer_desc = nl2br(htmlspecialchars($_POST['description']));
        $offer_city = $_POST['city'];
        $offer_job = $_POST['job'];
        $offer_contract = $_POST['contract'];
        $offer_date = date('d/m/Y à H:i');
        $edit_article = $mysql->prepare('UPDATE offers SET offer_title= ?, offer_description= ?, updated_at= ?, job_type= ?, contract_type= ?, city= ? WHERE id=?');
        $edit_article->execute(array($offer_title, $offer_desc, $offer_date, $offer_job, $offer_contract, $offer_city, $Offer_id));
        header('Location: index.php?page=1');
    } else {
        $errorMsg = "Veuillez compléter tous les champs";
    }
}
