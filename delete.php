<?php
require 'database.php';
require 'Student.php';

$db = (new Database())->getConnection();
$student = new Student($db);

$id = $_GET['id'] ?? null;
if ($id) {
    $student->delete($id);
}

header("Location: index.php");
exit;
?>
