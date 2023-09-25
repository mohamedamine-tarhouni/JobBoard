<?php
function apply_filter($mysql, $rows, $filters, $limit = false, $perPage, $offset)
{
    // Define the base SQL query
    $sql = "SELECT " . implode(",", $rows) . "
            FROM offers
            INNER JOIN enterprises ON offers.enterprise_id = enterprises.id
            INNER JOIN cities ON offers.city = cities.id
            INNER JOIN contracts ON offers.contract_type = contracts.id
            INNER JOIN jobs ON offers.job_type = jobs.id";

    // Extract filter values from the $filters array
    $jobFilter = $filters['jobFilter'];
    $contractFilter = $filters['contractFilter'];
    $cityFilter = $filters['cityFilter'];
    $searchFilter = $filters['searchFilter'];

    // Create an array to hold the filter conditions
    $filterConditions = [];

    // Add filters to the SQL query based on user selections
    if (!empty($jobFilter)) {
        $filterConditions[] = "offers.job_type IN ($jobFilter)";
    }

    if (!empty($cityFilter)) {
        $filterConditions[] = "offers.city IN ($cityFilter)";
    }

    if (!empty($contractFilter)) {
        $filterConditions[] = "offers.contract_type IN ($contractFilter)";
    }

    if (!empty($searchFilter)) {
        $filterConditions[] = "(enterprises.enterprise_name LIKE :searchFilter OR offer_title LIKE :searchFilter OR offer_description LIKE :searchFilter)";
    }

    // Combine filter conditions with "AND" if there are any
    if (!empty($filterConditions)) {
        $sql .= " WHERE " . implode(" AND ", $filterConditions);
    }

    if ($limit) {
        $sql .= " LIMIT $perPage OFFSET $offset";
    }

    // Prepare and execute the SQL query
    $stmt = $mysql->prepare($sql);

    if (!empty($searchFilter)) {
        $searchFilter = '%' . $searchFilter . '%';
        $stmt->bindParam(':searchFilter', $searchFilter, PDO::PARAM_STR);
    }

    $stmt->execute();

    // Return the result set
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

