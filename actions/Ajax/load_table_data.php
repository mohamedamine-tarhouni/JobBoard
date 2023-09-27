<?php
require('../connection.php');
$table = $_POST['tableName'];
$id = isset($_POST['id']) ? $_POST['id'] : null;
$sql = "SELECT * FROM $table";
if (isset($id)) {
    $sql .= " WHERE id=$id";
}
$stmt = $mysql->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);
