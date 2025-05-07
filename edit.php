<?php
require 'database.php';
require 'Student.php';

$db = (new Database())->getConnection();
$student = new Student($db);

$id = $_GET['id'] ?? null;
$data = $student->getById($id);

if (!$data) die("Student not found");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $course = trim($_POST['course']);

    if ($name && $email && $phone && $course) {
        $student->update($id, [
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
<head><title>Edit Student</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"></head>
<body class="container mt-4">
    <h2>Edit Student</h2>
    <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="POST">
        <input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>" class="form-control mb-2">
        <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" class="form-control mb-2">
        <input type="text" name="phone" value="<?= htmlspecialchars($data['phone']) ?>" class="form-control mb-2">
        <input type="text" name="course" value="<?= htmlspecialchars($data['course']) ?>" class="form-control mb-2">
        <button class="btn btn-primary">Update</button>
    </form>
</body>
</html>
