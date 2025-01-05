<?php
include '../../db/database.php';
include '../../includes/header.php';

$id = $_GET['id'];
$query = "SELECT student.*, classes.name AS class_name 
        FROM student 
        LEFT JOIN classes ON student.class_id = classes.class_id 
        WHERE student.id = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h1>View Student</h1>
    <p><strong>Name:</strong> <?php echo $student['name']; ?></p>
    <p><strong>Email:</strong> <?php echo $student['email']; ?></p>
    <p><strong>Address:</strong> <?php echo $student['address']; ?></p>
    <p><strong>Class:</strong> <?php echo $student['class_name']; ?></p>
    <p><strong>Created At:</strong> <?php echo $student['created_at']; ?></p>
    <p><strong>Image:</strong> <img src="../../uploads/<?php echo $student['image']; ?>" width="100"></p>
    <a href="../../index.php" class="btn btn-secondary">Back</a>
</div>

<?php include '../../includes/footer.php'; ?>