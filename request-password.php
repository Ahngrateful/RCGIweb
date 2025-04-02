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

$sql = "SELECT * FROM emp_forgotpass";
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
      background: #9FAC9F;
      padding: 15px 20px;
      border-bottom: 1px solid #9FAC9F;
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
      display: flex;
      flex-direction: column;
      justify-content: space-between;
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
      <span>Request Password Reset</span>
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
          <a href="manage-employee.php" class="list-group-item list-group-item-action">
            <i class="fas fa-users sidebar-icon"></i> Manage Employees
          </a>
          <a href="request-password.php" class="list-group-item list-group-item-action active">
            <i class="fas fa-users sidebar-icon"></i> Request Password
          </a>
          <a href="settings.php" class="list-group-item list-group-item-action">
            <i class="fas fa-cog sidebar-icon"></i> Settings
          </a>
          <a href="logoutpage.php" class="list-group-item list-group-item-action">
            <i class="fas fa-sign-out-alt sidebar-icon"></i> Logout
          </a>
        </div>
        <div class="w-100 text-center pb-3">
      <img src="pics/rcgiph_logo.jpg" class="img-fluid" alt="Logo" style="max-width: 50%; height: auto;">
    </div>
      </div>

      <!-- Main Content -->
      <div class="col-10 main-content">

        <!-- request password table-->
        <div class="card mb-4">
          <div class="card-header fw-bold d-flex justify-content-between align-items-center" style="background: #9FAC9F;">
            <span>PASSWORD RESET REQUESTS LIST</span>
            <div class="input-group" style="width: 250px;">
              <span class="input-group-text"><i class="fas fa-search"></i></span>
              <input type="text" class="form-control" placeholder="Search by name..." />
            </div>
          </div>
            <div class="card-body table-responsive">
              <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                  <tr>
                    <th>Request ID</th>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Reason</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (isset($result) && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['request_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['employee_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['reason']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                    echo "</tr>";
                    }
                  } else {
                    echo "<tr><td colspan='8'>No employees found.</td></tr>";
                  }
                ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- pop out notif if new emloyee requested for password reset-->

      </div> <!-- End Main Content -->
    </div> <!-- End Row -->
  </div> <!-- End Container -->
</body>
</html>
