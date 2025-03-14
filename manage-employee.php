<?php
session_start();

// Make sure admin_ID is set in session
if (!isset($_SESSION['admin_ID'])) {
    echo "Unauthorized. Admin not logged in.";
    exit;
}
$admin_id = $_SESSION['admin_ID'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_rcgi";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD']  == "POST" && isset($_POST['submit'])) {
    $employee_id = $_POST['employee_ID'];
    $name = $_POST['name'];
    $fingerprint_id = $_POST['fingerprint_ID'];
    $startshift = $_POST['shift_start_time'];
    $endshift = $_POST['shift_end_time'];
    $hiredate = $_POST['hire_date'];
    $org = $_POST['org'];

    // Check if an image is uploaded
    $employee_image = null;
    if (isset($_FILES['employee_image']) && $_FILES['employee_image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "employee_image/";
        $file_name = basename($_FILES['employee_image']['name']);
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (in_array($file_ext, ['jpg', 'jpeg', 'png', 'gif'])) {
            $unique_name = uniqid() . "_" . $file_name;
            $target_file = $target_dir . $unique_name;

            if (move_uploaded_file($_FILES['employee_image']['tmp_name'], $target_file)) {
                $employee_image = $target_file;
            } else {
                echo "<script>alert('Error uploading the file.');</script>";
                exit;
            }
        } else {
            echo "<script>alert('Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.');</script>";
            exit;
        }
    } else {
        echo "<script>alert('No image uploaded or upload error.');</script>";        
        exit;
    }

    $conn->begin_transaction();
    try {
        // Updated SQL to include admin_ID
        $stmt = $conn->prepare("INSERT INTO employee (admin_ID, employee_id, name, fingerprint_id, photo, hire_date, shift_start_time, shift_end_time, org) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iisisssss", $admin_id, $employee_id, $name, $fingerprint_id, $employee_image, $hiredate, $startshift, $endshift, $org);
        $stmt->execute();

        $conn->commit();
        echo "<script>alert('Employee added successfully.');</script>";
    } catch (Exception $e) {
        $conn->rollback();
        error_log($e->getMessage());
        echo "<script>alert('Error adding employee. Please try again.');</script>";
    }
}

// Fetch all employees
$sql = "SELECT employee_id, photo, name, fingerprint_id, shift_start_time, shift_end_time, hire_date, org FROM employee";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>RCGI | Manage Employees</title>
  <link rel="icon" href="pics/rcgiph_logo.jpg" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"/>

  <style>
    body {
      font-family: 'Inter', sans-serif;
      font-weight: 600;
      font-size: 15px;
      background: #F3F4F6;
      margin: 0;
    }

    .navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: white;
      padding: 15px 20px;
      border-bottom: 1px solid #DFDDDD;
      box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
      height: 60px;
    }

    .navbar .left {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 18px;
      font-weight: bold;
    }

    .navbar .right {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .navbar .profile {
      width: 35px;
      height: 35px;
      background: black;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
    }

    .layout {
      display: flex;
      height: calc(100vh - 60px); /* full height minus navbar */
    }

    .sidebar {
      background-color: #f8f9fa;
      width: 250px;
      border-right: 1px solid #ddd;
      padding-top: 20px;
    }

    .list-group-item {
      background: none;
      border: none;
      padding: 12px 20px;
      font-weight: bold;
      display: flex;
      align-items: center;
      color: #000;
      transition: background 0.3s ease-in-out;
    }

    .list-group-item:hover {
      background: #e0e0e0;
    }

    .list-group-item.active {
      background-color: #99A191;
      color: white;
      border-radius: 5px;
    }

    .sidebar-icon {
      width: 20px;
      height: 20px;
      margin-right: 10px;
    }

    .main-content {
      flex: 1;
      padding: 20px;
      overflow-y: auto;
    }

    .table img {
      width: 60px;
      height: 60px;
    }
  </style>
</head>
<body>


  <!-- Navbar -->
  <div class="navbar">
    <div class="left">
      <i class="fas fa-building"></i>
      <span>Dashboard</span>
    </div>
    <div class="right">
      <i class="fas fa-bell"></i>
      <div class="profile">
        <i class="fas fa-user"></i>
      </div>
    </div>
  </div>

  <!-- Layout -->
  <div class="container-fluid">
    <div class="row vh-100">
      
      <!-- Sidebar -->
      <div class="col-2 sidebar">
        <div class="list-group">
          <a href="dashboard.php" class="list-group-item list-group-item-action">
            <i class="fas fa-tachometer-alt sidebar-icon"></i> Dashboard
          </a>
          <a href="view-attendance.php" class="list-group-item list-group-item-action">
            <i class="fas fa-clock sidebar-icon"></i> View Attendance
          </a>
          <a href="manage-employee.php" class="list-group-item list-group-item-action active">
            <i class="fas fa-users sidebar-icon"></i> Manage Employees
          </a>
          <a href="settings.php" class="list-group-item list-group-item-action">
            <i class="fas fa-cog sidebar-icon"></i> Settings
          </a>
          <a href="logoutpage.php" class="list-group-item list-group-item-action">
            <i class="fas fa-sign-out-alt sidebar-icon"></i> Logout
          </a>
        </div>
      </div>

      <!-- Main Content -->
      <div class="col-10 main-content">
        <form action="" method="POST" enctype="multipart/form-data" class="mt-4">
          <!-- Add New Employee -->
          <div class="card mb-4">
            <div class="card-header fw-bold bg-light">Add New Employees</div>
            <div class="card-body row">
              <!-- Profile Image -->
              <div class="col-3 text-center">
                <img src="placeholder.jpg" class="img-thumbnail mb-3" alt="Profile Image" id="employee_image" style="width: 120px; height: 120px;">
                <input type="file" class="form-control" name="employee_image" required>
              </div>

              <!-- Form Fields -->
              <div class="col-9">
                <div class="row mb-3">
                  <div class="col-md-3">
                    <label class="form-label">Employee ID</label>
                    <input type="text" class="form-control" name="employee_ID" placeholder="Enter employee ID" required>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter name" required>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">Fingerprint ID</label>
                    <input type="text" class="form-control" name="fingerprint_ID" placeholder="Enter fingerprint ID" required>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">Hire Date</label>
                    <input type="date" class="form-control" name="hire_date" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-md-4">
                    <label class="form-label">Start Shift</label>
                    <select class="form-select" name="shift_start_time" required>
                      <option selected>Select Shift</option>
                      <option>8:00 AM</option>
                      <option>9:00 AM</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">End Shift</label>
                    <select class="form-select" name="shift_end_time" required>
                      <option selected>Select Shift</option>
                      <option>5:00 PM</option>
                      <option>6:00 PM</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">Organization</label>
                    <select class="form-select" name="org" required>
                      <option selected>RCGI</option>
                      <option>Terraco</option>
                    </select>
                  </div>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">ADD NEW</button>
              </div>
            </div>
          </div>
        </form>

        <!-- Employee List -->
        <div class="card">
          <div class="card-header fw-bold bg-light">Employee List</div>
          <div class="card-body table-responsive">
            <table class="table table-bordered text-center align-middle">
              <thead class="table-light">
                <tr>
                  <th>Employee ID</th>
                  <th>Photo</th>
                  <th>Name</th>
                  <th>Fingerprint ID</th>
                  <th>Shift</th>
                  <th>Organization</th>
                  <th>Member Since</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  if (isset($result) && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . htmlspecialchars($row['employee_id']) . "</td>";
                      echo "<td><img src='" . htmlspecialchars($row['photo']) . "' class='img-thumbnail' style='width: 60px; height: 60px;' onerror=\"this.src='placeholder.jpg'\" /></td>";
                      echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['fingerprint_id']) . "</td>";
                      echo "<td>" . date("H:i", strtotime($row['shift_start_time'])) . " AM - " . date("H:i", strtotime($row['shift_end_time'])) . " PM</td>";
                      echo "<td>" . htmlspecialchars($row['org']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['hire_date']) . "</td>";
                      echo "<td>
                              <a href='edit_employee.php?id={$row['employee_id']}' class='icon-btn'>
                                <i class='fas fa-edit'></i>
                              </a>
                              <a href='delete_employee.php?id={$row['employee_id']}' class='icon-btn' onclick='return confirm(\"Are you sure you want to delete this employee?\")'>
                                <i class='fas fa-trash'></i>
                              </a>
                            </td>";
                      echo "</tr>";
                    }
                  } else {
                    echo "<tr><td colspan='8'>No employees found.</td></tr>";
                  }
                ?>
              </tbody>
            </table>
            <nav>
              <ul class="pagination justify-content-end">
                <li class="page-item disabled"><a class="page-link">Previous</a></li>
                <li class="page-item disabled"><a class="page-link">Next</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div> <!-- End Main Content -->
    </div> <!-- End Row -->
  </div> <!-- End Container -->
</body>
</html>
