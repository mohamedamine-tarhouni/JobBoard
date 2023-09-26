<?php
require('actions/users/Security.php');
require('actions/offers/getInfoseditedOffers_Action.php');
require('actions/offers/loadFilters_Actions.php');
require('actions/offers/editOffer_Action.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>

<body>
    <?php include 'includes/navbar.php'; ?>
    <div class="container">
        <div class="form_div">
            <form method="POST">
                <?php if (isset($errorMsg)) {
                    echo "<p>" . $errorMsg . "</p>";
                } else { ?>

               
                <div class="mb-3">
                    <label for="title" class="form-label">Titre : </label><br>
                    <input type="text" value="<?= $offer_title ?>" class="form-control" id="title" name="title"><br>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description : </label><br>
                    <textarea class="form-control" id="description" name="description"><?= $offer_desc ?></textarea><br><br>
                </div>
                <label for="city_value">Ville : </label>
                <select name="city" id="city_value">
                    <?php foreach ($cities as $city) { ?>
                        <option value="<?= $city['id'] ?>" <?= $city['id'] == $offer_city ? "selected" : "" ?>><?= $city['city'] ?></option>
                    <?php } ?>
                </select>
                <label for="contract_value">Type de contrat : </label>
                <select name="contract" id="contract_value">
                    <?php foreach ($contracts as $contract) { ?>
                        <option value="<?= $contract['id'] ?>" <?= $contract['id'] == $offer_contract ? "selected" : "" ?>><?= $contract['contract_type'] ?></option>
                    <?php } ?>
                </select>
                <label for="job_value">Métier : </label>
                <select name="job" id="job_value">
                    <?php foreach ($jobs as $job) { ?>
                        <option value="<?= $job['id'] ?>" <?= $job['id'] == $offer_job ? "selected" : "" ?>><?= $job['job_type'] ?></option>
                    <?php } ?>
                </select>
                <!-- <input type="submit" value="Publier" name="submit"> -->
                <button type="submit" class="btn btn-primary" name="submit">Publier</button>
                <?php } ?>
            </form>
        </div>
    </div>
</body>

</html>