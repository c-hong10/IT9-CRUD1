<?php
include '../database/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM attendance WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Attendance</title>
  <link href="../statics/css/bootstrap.min.css" rel="stylesheet">
  <script src="../statics/js/bootstrap.js"></script>
</head>
<body>
  <div class="container d-flex justify-content-center mt-5">
    <div class="col-6">
      <div class="row">
        <p class="display-5 fw-bold">Edit Attendance</p>
      </div>
      <form action="../handlers/update_attendance_handler.php" method="POST">
        <input type="hidden" name="id" value="<?= $row['id']; ?>">
        <div class="mb-3">
          <label for="student_name" class="form-label">Student Name</label>
          <input type="text" class="form-control" id="student_name" name="student_name" value="<?= htmlspecialchars($row['student_name']); ?>" required>
        </div>
        <div class="mb-3">
          <label for="date" class="form-label">Date</label>
          <input type="date" class="form-control" id="date" name="date" value="<?= htmlspecialchars($row['date']); ?>" required>
        </div>
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <select class="form-select" id="status" name="status">
            <option value="Present" <?= $row['status'] == 'Present' ? 'selected' : ''; ?>>Present</option>
            <option value="Absent" <?= $row['status'] == 'Absent' ? 'selected' : ''; ?>>Absent</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Attendance</button>
      </form>
    </div>
  </div>
</body>
</html>