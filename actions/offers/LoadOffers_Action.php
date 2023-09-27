<?php include 'actions/connection.php';
include 'actions/utilities.php';
include 'actions/connection.php';

// Define filter values and pagination variables
$jobFilter = isset($_GET['Job']) ? $_GET['Job'] : '';
$contractTypeFilter = isset($_GET['Contract']) ? $_GET['Contract'] : '';
$cityFilter = isset($_GET['City']) ? $_GET['City'] : '';
$enterpriseFilter = isset($_GET['enterprise']) ? $_GET['enterprise'] : '';
$searchFilter = isset($_GET['Search']) ? $_GET['Search'] : '';
$Order_by = isset($_GET['Order']) ? $_GET['Order'] : '';
//Number of pages to display per page
$perPage = 10;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $perPage;

// Create an associative array to hold filter values
$filters = [
    'jobFilter' => $jobFilter,
    'contractFilter' => $contractTypeFilter,
    'cityFilter' => $cityFilter,
    'enterpriseFilter' => $enterpriseFilter,
    'searchFilter' => $searchFilter,
    'Order_by' => $Order_by,
];
// Call the apply_filter function to generate the SQL query
$offers = apply_filter($mysql,["offers.*","offers.id as offer_id", "enterprises.id","enterprises.enterprise_name", "cities.city", "contracts.contract_type", "jobs.job_type"], $filters, true, $perPage, $offset);
$total_offers = apply_filter($mysql,["COUNT(*) AS Total"], $filters, false, $perPage, $offset);
$total_offers = $total_offers[0]["Total"];
// Fetch and display the results
$totalPages = ceil($total_offers / $perPage);
// foreach ($offers as $offer) {
//     echo "Offer id: " . $offer['offer_id'] . "<br>";
//     echo "Offer Title: " . $offer['offer_title'] . "<br>";
//     echo "Offer Description: " . $offer['offer_description'] . "<br>";
//     echo "City: " . $offer['city'] . "<br>";
//     echo "Reference: " . $offer['reference'] . "<br>";
//     echo "Created At: " . $offer['created_at'] . "<br>";
//     echo "Contract Type: " . $offer['contract_type'] . "<br>";
//     echo "Job Type: " . $offer['job_type'] . "<br>";
//     echo "Enterprise: " . $offer['enterprise_name'] . "<br>";
//     echo "--------------------------<br>";
// }
?>

