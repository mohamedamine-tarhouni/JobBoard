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
                    <div class="offer_card">
                        <img class="offer_image" src="https://imgs.search.brave.com/zoJ2QXmvBEnI3Zb5INvQx4NZ5vUC6yNyyQ8reiIM4m8/rs:fit:860:0:0/g:ce/aHR0cHM6Ly9kMW5n/MWJ1Y2w3dzY2ay5j/bG91ZGZyb250Lm5l/dC9naG9zdC1ibG9n/LzIwMjAvMTEvcm9i/b3QuanBn" alt="">
                        <div class="card">
                            <div class="card-header">
                                <span class="offer_title">
                                    <?php echo $offer['offer_title'] ?></span>
                                <p class="reference_value">#<?= $offer['reference'] ?></p>
                                <?php if($_SESSION["enterprise_id"] == $offer['enterprise_id']) {?>
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
                                Publié par <a href="profile.php?id=17"><?php echo $offer['enterprise_name'] ?></a> le 24/09/2023 à 14:16 </div>
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