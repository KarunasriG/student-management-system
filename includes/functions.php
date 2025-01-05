<?php
function getAllStudents($conn)
{
    $query = "SELECT student.*, classes.name AS class_name 
            FROM student 
            LEFT JOIN classes ON student.class_id = classes.class_id";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getStudentById($conn, $id)
{
    $query = "SELECT student.*, classes.name AS class_name 
            FROM student 
            LEFT JOIN classes ON student.class_id = classes.class_id 
            WHERE student.id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function getAllClasses($conn)
{
    $query = "SELECT * FROM classes";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}


function validateImage($file)
{
    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    $imageExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    return in_array($imageExtension, $allowedExtensions) && $file['size'] <= 2 * 1024 * 1024; // Max 2MB
}


function sanitizeInput($data)
{
    return htmlspecialchars(trim($data));
}
