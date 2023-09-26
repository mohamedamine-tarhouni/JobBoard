<?php
// *** FILTERS *** //
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
    $enterpriseFilter = $filters['enterpriseFilter'];
    $searchFilter = $filters['searchFilter'];
    $Order_by = $filters['Order_by'];

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
    if (!empty($enterpriseFilter)) {
        $filterConditions[] = "offers.enterprise_id = $enterpriseFilter";
    }

    if (!empty($searchFilter)) {
        $filterConditions[] = "(enterprises.enterprise_name LIKE :searchFilter OR offer_title LIKE :searchFilter OR offer_description LIKE :searchFilter)";
    }

    // Combine filter conditions with "AND" if there are any
    if (!empty($filterConditions)) {
        $sql .= " WHERE " . implode(" AND ", $filterConditions);
    }
    if (!empty($Order_by)) {
        $Order_by = explode("€€", $Order_by);
        $Order_column = $Order_by[0];
        $Order_type = $Order_by[1];
        $sql .= " Order by $Order_column $Order_type";
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
// *** FORM VERIFICATIONS *** //
function verify_valid_characters($str, $data): string
{
    for ($i = 0; $i < strlen($str); $i++) {
        if ((strtoupper($str[$i]) < 'A' || strtoupper($str[$i]) > 'Z')
            && ($str[$i] < '0' || $str[$i] > '9')
            && ($str[$i] !== '-') && ($str[$i] !== '_')
        ) {
            return $data . " doit contenir que A-Za-z0-9_-";
        }
    }
    return "true";
}
function verify_data_length($str, $MIN_LENGTH, $MaxLength, $data): string
{
    if (strlen($str) < $MIN_LENGTH || strlen($str) > $MaxLength) {
        return "La taille du " . $data . " doit etre entre " . $MIN_LENGTH . " et " . $MaxLength;
    }
    return "true";
}
function final_Verification($str, $data, $minLength, $maxLength)
{
    if (verify_valid_characters($str, $data) != "true") {
        return verify_valid_characters($str, $data);
    } else if (verify_data_length($str, $minLength, $maxLength, $data) != "true") {
        return  verify_data_length($str, $minLength, $maxLength, $data);
    }
    return "true";
}
function User_exists($data, $strdata)
{
    $mysql = new PDO('mysql:host=localhost;dbname=jobboard_db;charset=utf8;', 'root', '');
    $req_User_Exists = $mysql->prepare("SELECT $strdata FROM users WHERE $strdata= ?");
    $req_User_Exists->execute(array($data));
    return $req_User_Exists;
}
// *** FUNCTIONS *** //
function generateRandomString($length = 20) {
    // Define characters to use in the random string
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
    // Calculate the number of characters in the character set
    $charLength = strlen($characters);
    
    // Initialize the random string
    $randomString = '';
    
    // Generate random bytes
    $bytes = random_bytes($length);
    
    for ($i = 0; $i < $length; $i++) {
        // Get a random index from the bytes and use it to select a character
        $randomIndex = ord($bytes[$i]) % $charLength;
        $randomString .= $characters[$randomIndex];
    }
    
    return $randomString;
}
