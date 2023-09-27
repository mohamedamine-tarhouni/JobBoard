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
        // *** IMAGE API *** //
        $api_key = 'jWneUSk5uP9LA9jn-qZ1PXb5FWYBo8zwjKUS8eLvFWg';
        $query = 'IT'; // API search query
        $url = "https://api.unsplash.com/search/photos?query={$query}&client_id={$api_key}";
        $response = file_get_contents($url);
        $image_url = null;
        // Parse the JSON response
        $data = json_decode($response, true);
        if (!empty($data['results'])) {
            $image_url = $data['results'][0]['urls']['regular'];
        }
        // *** CREATE OFFER QUERY *** //
        $req_Add_offer = $mysql->prepare('INSERT INTO offers(offer_title,offer_description,created_at,enterprise_id,city,contract_type,job_type,offer_image,reference) VALUES(?, ?, ?, ?, ?, ?,?, ?, ?)');
        $req_Add_offer->execute(array($offer_title, $offer_desc, $offer_date, $offer_id_author, $offer_city, $offer_contract, $offer_job, $image_url, $offer_ref));
        header('Location:index.php?page=1');
    } else {
        $errorMsg = "Veuillez compléter tous les champs";
    }
}
