<?php include 'actions/offers/loadFilters_Actions.php'; ?>
<div class="filters_lists_container" style="display: none;">
    <div id="jobs_filters" class="filters_content">
        <?php foreach ($jobs as $job) { ?> 
            <div class="option_container">
                <input id="job_<?= $job['id'] ?>" data_filter="<?= $job['id'] ?>" type="checkbox" <?php echo in_array($job['id'], explode(",",$_GET["Job"])) ? 'checked' : ''; ?>>
                <label for="job_<?= $job['id'] ?>"><?= $job['job_type'] ?></label>
            </div>
            <?php } ?>
    </div>
    <div id="cities_filters" class="filters_content">
    <?php foreach ($cities as $city) { ?> 
            <div class="option_container">
                <input id="city_<?= $city['id'] ?>" data_filter="<?= $city['id'] ?>" type="checkbox" <?php echo in_array($city['id'], explode(",",$_GET["City"])) ? 'checked' : ''; ?>>
                <label for="city_<?= $city['id'] ?>"><?= $city['city'] ?></label>
            </div>
            <?php } ?>
    </div>
    <div id="contracts_filters" class="filters_content">
    <?php foreach ($contracts as $contract) { ?> 
            <div class="option_container">
                <input id="contract_<?= $contract['id'] ?>" data_filter="<?= $contract['id'] ?>" type="checkbox" <?php echo in_array($contract['id'], explode(",",$_GET["Contract"])) ? 'checked' : ''; ?>>
                <label for="contract_<?= $contract['id'] ?>"><?= $contract['contract_type'] ?></label>
            </div>
            <?php } ?>
    </div>
    <div class="filter_save_buttons">
        <div class="btn btn-secondary default_btn">Par défaut</div>
        <div class="btn btn-success apply_btn">Appliquer</div>
    </div>
</div>