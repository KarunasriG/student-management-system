<?php
include '../../db/database.php';
include '../../includes/functions.php';
include '../../includes/header.php';

// Fetch classes for dropdown
$sql = "SELECT * FROM classes";
$stmt = $conn->prepare($sql);
$stmt->execute();
$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $name = sanitizeInput($_POST['name']);
    $email = sanitizeInput($_POST['email']);
    $address = sanitizeInput($_POST['address']);
    $class_id = (int)$_POST['class_id'];

    // Validate email
    if (!validateEmail($email)) {
        die("Invalid email address.");
    }

    // Validate image
    if (!validateImage($_FILES['image'])) {
        die("Invalid image file.");
    }

    // Handle image upload
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    // Insert student into database
    $sql = "INSERT INTO student (name, email, address, class_id, image) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$name, $email, $address, $class_id, $image]);

    header("Location: ../../index.php");
    exit();
}
?>

<div class="container">
    <h1>Create Student</h1>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Address</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label>Class</label>
            <select name="class_id" class="form-control" required>
                <?php foreach ($classes as $class): ?>
                    <option value="<?php echo $class['class_id']; ?>"><?php echo $class['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php include '../../includes/footer.php'; ?>