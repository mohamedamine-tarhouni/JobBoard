
<?php
require('../connection.php');
$table = $_POST['tableName'];
$id = isset($_POST['id']) ? $_POST['id'] : null;
$sql = "DELETE FROM $table";
$sql .= " WHERE id=$id";
$stmt = $mysql->prepare($sql);
$stmt->execute();
echo 1;
