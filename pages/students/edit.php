<?php
include '../../db/database.php';
include '../../includes/functions.php';
include '../../includes/header.php';

$id = $_GET['id'];

$student = getStudentById($conn, $id);

$classes = getAllClasses($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $class_id = $_POST['class_id'];

    // Handle image upload
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    } else {
        $image = $student['image'];
    }

    // Update student in database
    $query = "UPDATE student SET name = ?, email = ?, address = ?, class_id = ?, image = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$name, $email, $address, $class_id, $image, $id]);

    header("Location: ../../index.php");
    exit();
}
?>


<div class="container">
    <h1>Edit Student</h1>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $student['name']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo $student['email']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control" required><?php echo $student['address']; ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Class</label>
            <select name="class_id" class="form-control" required>
                <?php foreach ($classes as $class): ?>
                    <option value="<?php echo $class['class_id']; ?>" <?php echo ($class['class_id'] == $student['class_id']) ? 'selected' : ''; ?>>
                        <?php echo $class['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <img class="p-1 ms-3" src="../../uploads/<?php echo $student['image']; ?>" width="50">
            <input type="file" name="image" class="form-control" accept="image/*">

        </div>
        <div class="d-flex justify-content-between">
            <a href="../../index.php" class="btn btn-secondary">Back</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>

<?php include '../../includes/footer.php'; ?>