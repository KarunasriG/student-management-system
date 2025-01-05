<?php
include './db/database.php';
include './includes/functions.php';
include './includes/header.php';

// Fetch students with class names using JOIN
$students = getAllStudents($conn);
?>


<div class="container">
    <h2>Student List</h2>
    <a href="./pages/students/create.php" class="btn btn-primary mb-3">Add New Student</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Class</th>
                <th>Created At</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo $student['name']; ?></td>
                    <td><?php echo $student['email']; ?></td>
                    <td><?php echo $student['class_name']; ?></td>
                    <td><?php echo $student['created_at']; ?></td>
                    <td><img src="uploads/<?php echo $student['image']; ?>" width="50"></td>
                    <td>
                        <a href="./pages/students/view.php?id=<?php echo $student['id']; ?>" class="btn btn-info">View</a>
                        <a href="./pages/students/edit.php?id=<?php echo $student['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="./pages/students/delete.php?id=<?php echo $student['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include './includes/footer.php'; ?>