<?php
require('actions/users/Security.php');
include 'actions/offers/LoadOffers_Action.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>

<body>
    <?php
    include 'includes/scripts.php';
    include 'includes/navbar.php';
    include 'includes/filters.php';
    ?>
    <div class="page_content">
        <div class="offers_filters_container">
            <div class="offers_filters_content">
                <div class="filters_buttons">
                    <div class="open_filters_btn city_filter" filter_data="#cities_filters" btn_data="City">Villes</div>
                    <div class="open_filters_btn contrat_filter" filter_data="#contracts_filters" btn_data="Contract">Contrats</div>
                    <div class="open_filters_btn job_filter" filter_data="#jobs_filters" btn_data="Job">Métiers</div>
                    <div class="open_filters_btn order_filter" filter_data="#order_filters" btn_data="Order">Trier</div>
                </div>
                <div class="search_filter form-group row">
                    <div class="col-8">
                        <input id="search_input" type="search" value="<?= isset($_GET["Search"]) ? $_GET["Search"] : '' ?>" name="search" class="form-control mr-sm-2" placeholder="Rechercher..." aria-label="Search">
                    </div>
                    <div class="col-4">
                        <button class="btn btn-success search_btn">Rechercher</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="offers_container">
            <div class="offers_list">
                <?php foreach ($offers as $offer) { ?>
                    <div class="offer_card" offer_id="<?= $offer['offer_id'] ?>">
                        <?php if (isset($offer['offer_image'])) { ?>
                            <img class="offer_image" src="<?= $offer['offer_image'] ?>" alt="">
                        <?php } ?>
                        <div class="card">
                            <div class="card-header">
                                <span class="offer_title">
                                    <?php echo $offer['offer_title'] ?></span>
                                <p class="reference_value">#<?= $offer['reference'] ?></p>
                                <?php if ($_SESSION["enterprise_id"] == $offer['enterprise_id']) { ?>
                                    <a href="edit-offer.php?id=<?= $offer['offer_id']; ?>" class="btn btn-warning"> Modifier</a>
                                    <a href="actions/articles/deleteArticleAction.php?id=<?= $offer['offer_id']; ?>" class="btn btn-danger"> Supprimer</a>
                                <?php } ?>
                            </div>
                            <div class="card-body">
                                <ul>
                                    <?php if (isset($offer['city'])) { ?>
                                        <li><strong>Ville : </strong> <?php echo $offer['city'] ?></li>
                                    <?php } ?>
                                    <?php if (isset($offer['job_type'])) { ?>
                                        <li><strong>Métier : </strong> <?php echo $offer['job_type'] ?></li>
                                    <?php } ?>
                                    <?php if (isset($offer['contract_type'])) { ?>
                                        <li><strong>Type de contrat : </strong> <?php echo $offer['contract_type'] ?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="card-footer">
                                Publié par <a href="index.php?page=1&enterprise=<?= $offer['id']; ?>"><?php echo $offer['enterprise_name'] ?></a> <?= get_friendlyDate($offer['created_at']) ?> </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="offer_details"></div>
        </div>
        <div class="pagination_container">
            <?php for ($i = 1; $i <= $totalPages; $i++) {
                $filterQuery = http_build_query([
                    'Job' => $jobFilter,
                    'Contract' => $contractTypeFilter,
                    'City' => $cityFilter,
                    'Search' => $searchFilter,
                    'Order' => $Order_by,
                    'enterprise' => $enterpriseFilter
                ]);
                $pageLink = "index.php?page=$i";
                if (!empty($filterQuery)) {
                    $pageLink .= "&$filterQuery";
                } ?>
                <a class="<?= $i == $_GET["page"] ? "loaded_page_number" : "page_number" ?>" href="<?= $pageLink ?>"><?= $i ?></a><?php } ?>

        </div>
    </div>
</body>

</html>