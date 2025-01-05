<?php
include '../../db/database.php';

$id = $_GET['id'];

// Fetch student image path
$sql = "SELECT image FROM student WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

// Delete image from server
if ($student['image']) {
    unlink("uploads/" . $student['image']);
}

// Delete student from database
$sql = "DELETE FROM student WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);

header("Location: ../../index.php");
exit();
