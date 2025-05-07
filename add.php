<?php
require 'database.php';
require 'Student.php';

$db = (new Database())->getConnection();
$student = new Student($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $course = trim($_POST['course']);

    if ($name && $email && $phone && $course) {
        $student->create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'course' => $course
        ]);
        header('Location: index.php');
        exit;
    } else {
        $error = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Add Student</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"></head>
<body class="container mt-4">
    <h2>Add Student</h2>
    <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="POST">
        <input type="text" name="name" placeholder="Name" class="form-control mb-2">
        <input type="email" name="email" placeholder="Email" class="form-control mb-2">
        <input type="text" name="phone" placeholder="Phone" class="form-control mb-2">
        <input type="text" name="course" placeholder="Course" class="form-control mb-2">
        <button class="btn btn-success">Add</button>
    </form>
</body>
</html>
