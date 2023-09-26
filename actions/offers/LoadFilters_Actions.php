<?php
include 'actions/connection.php';
$sql_jobs = "SELECT * FROM jobs";
$stmt_jobs = $mysql->prepare($sql_jobs);
$stmt_jobs->execute();
$jobs=$stmt_jobs->fetchAll(PDO::FETCH_ASSOC);
$sql_cities = "SELECT * FROM cities";
$stmt_cities = $mysql->prepare($sql_cities);
$stmt_cities->execute();
$cities=$stmt_cities->fetchAll(PDO::FETCH_ASSOC);
$sql_contracts = "SELECT * FROM contracts";
$stmt_contracts = $mysql->prepare($sql_contracts);
$stmt_contracts->execute();
$contracts=$stmt_contracts->fetchAll(PDO::FETCH_ASSOC);
$sql_enterprises = "SELECT * FROM enterprises";
$stmt_enterprises = $mysql->prepare($sql_enterprises);
$stmt_enterprises->execute();
$enterprises=$stmt_enterprises->fetchAll(PDO::FETCH_ASSOC);
