<?php
require('actions/connection.php');
if (isset($_GET['id']) and !empty($_GET['id'])) {
    $Offer_id = $_GET['id'];
    $req_offer_Exist = $mysql->prepare("SELECT * FROM offers WHERE id= ?");
    $req_offer_Exist->execute(array($Offer_id));
    if ($req_offer_Exist->rowCount() > 0) {
        $offerInfos = $req_offer_Exist->fetch();
        if ($offerInfos['enterprise_id'] == $_SESSION['enterprise_id']) {
            $offer_title = $offerInfos['offer_title'];
            $offer_desc = $offerInfos['offer_description'];
            $offer_job = $offerInfos['job_type'];
            $offer_contract = $offerInfos['contract_type'];
            $offer_city = $offerInfos['city'];
            $offer_desc = str_replace('<br />', '', $offer_desc);
        } else {
            $errorMsg = "Vous n'avez pas le droit pour modifier cet offer";
        }
    } else {
        $errorMsg = "Cet offre n'existe pas ou a été supprimé";
    }
} else {
    $errorMsg = "Aucune offre n'a été trouvée";
}
