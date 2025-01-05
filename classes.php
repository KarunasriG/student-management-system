<?php
include './db/database.php';
include './includes/header.php';

// Fetch all classes
$sql = "SELECT * FROM classes";
$stmt = $conn->prepare($sql);
$stmt->execute();
$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_class'])) {
        $name = $_POST['name'];
        $sql = "INSERT INTO classes (name) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name]);
        header("Location: classes.php");
        exit();
    } elseif (isset($_POST['edit_class'])) {
        $class_id = $_POST['class_id'];
        $name = $_POST['name'];
        $sql = "UPDATE classes SET name = ? WHERE class_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $class_id]);
        header("Location: classes.php");
        exit();
    }
}

if (isset($_GET['delete_class'])) {
    $class_id = $_GET['delete_class'];
    $sql = "DELETE FROM classes WHERE class_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$class_id]);
    header("Location: classes.php");
    exit();
}
?>

<div class="container">
    <h1>Manage Classes</h1>

    <!-- Form to add a new class -->
    <form method="POST" class="mb-3">
        <div class="form-group">
            <label>Class Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" name="add_class" class="btn btn-primary">Add Class</button>
    </form>

    <!-- Table to display all classes -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Class Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($classes as $class): ?>
                <tr>
                    <td><?php echo $class['name']; ?></td>
                    <td>
                        <!-- Edit Button (opens modal) -->
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editClassModal"
                            data-class-id="<?php echo $class['class_id']; ?>"
                            data-class-name="<?php echo $class['name']; ?>">
                            Edit
                        </button>
                        <!-- Delete Button -->
                        <a href="classes.php?delete_class=<?php echo $class['class_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Edit Class Modal -->
<div class="modal" id="editClassModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editClassModalLabel">Edit Class</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editClassForm" method="POST">
                    <input type="hidden" name="class_id" id="editClassId">
                    <div class="form-group">
                        <label>Class Name</label>
                        <input type="text" name="name" id="editClassName" class="form-control" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                <button type="submit" name="edit_class" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editClassModal = document.getElementById('editClassModal');
        editClassModal.addEventListener('show.bs.modal', function(event) {

            var button = event.relatedTarget;

            var classId = button.getAttribute('data-class-id');
            var className = button.getAttribute('data-class-name');

            var editClassIdInput = document.getElementById('editClassId');
            var editClassNameInput = document.getElementById('editClassName');

            editClassIdInput.value = classId;
            editClassNameInput.value = className;
        });
    });
</script>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<?php include './includes/footer.php'; ?>