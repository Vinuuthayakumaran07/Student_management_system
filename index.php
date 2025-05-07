<?php
require 'database.php';
require 'Student.php';

$db = (new Database())->getConnection();
$student = new Student($db);
$search = $_GET['search'] ?? '';
$students = $student->search($search);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Students List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2>Student List</h2>

    <form method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" placeholder="Search by name or course" class="form-control" value="<?= htmlspecialchars($search) ?>">
            <button class="btn btn-outline-secondary">Search</button>
        </div>
    </form>

    <a href="add.php" class="btn btn-primary mb-3">Add Student</a>

    <table class="table table-bordered">
        <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Course</th><th>Actions</th></tr></thead>
        <tbody>
            <?php foreach ($students as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['phone']) ?></td>
                    <td><?= htmlspecialchars($row['course']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>
