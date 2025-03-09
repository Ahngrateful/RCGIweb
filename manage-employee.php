<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RCGI | Manage Employees</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
       body {
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 15px;
            background: #F3F4F6;
        }

        /* Navbar */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: white;
            padding: 15px 20px;
            border-bottom: 1px solid #DFDDDD;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        }

        /* Left Section */
        .navbar .left {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 18px;
            font-weight: bold;
        }

        /* Icons */
        .navbar .left i {
            font-size: 22px;
        }

        /* Right Section */
        .navbar .right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        /* Bell Icon */
        .navbar .right i {
            font-size: 20px;
            cursor: pointer;
        }

        /* Profile Icon */
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

        /* Sidebar */
        .sidebar {
            background-color: #f8f9fa;
            height: 100vh; /* Full height */
            display: flex;
            flex-direction: column;
            border-right: 1px solid #ddd;
            padding-top: 20px;
            position: fixed; /* Keep sidebar fixed */
            left: 0;
            top: 80px;
            width: 250px; /* Fixed width */
            z-index: 1000;
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

        /* Main Content */
        .col-md-10 {
            margin-left: 250px;
            padding: 20px;
        }

        /* Settings Container */
        .settings-container {
            max-width: 600px;
            background: #FFFFFF;
            border: 2px solid #7A8D7A;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 20px;
            padding: 30px;
            margin: auto;
            margin-top: 50px;
        }

        .settings-container label {
            font-weight: bold;
            margin-top: 10px;
        }

        .settings-container input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .settings-container .input-container {
            display: flex;
            align-items: center;
        }

        .settings-container .input-container input {
            width: 80px;
            text-align: center;
            margin-right: 10px;
        }

        .settings-container .small-text {
            font-size: 12px;
            font-style: italic;
            color: #666;
            margin-top: 5px;
        }

        .settings-container .submit {
            width: 100%;
            padding: 10px;
            background-color: #7A8D7A;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 15px;
        }

        .settings-container .submit:hover {
            background-color: #5f6e5f;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 10px;
            }
            .sidebar {
                width: 100%;
                position: relative;
                height: auto;
                padding-bottom: 10px;
            }
        }


    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
  <div class="left">
    <i class="fas fa-building"></i>
    <span>Manage Employees</span>
  </div>
  <div class="right">
    <i class="fas fa-bell"></i>
    <div class="profile-icon">
      <i class="fas fa-user"></i>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-2 sidebar py-3">
      <div class="list-group">
        <a href="dashboard.php" class="list-group-item"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
        <a href="view-attendance.php" class="list-group-item"><i class="fas fa-clock me-2"></i> View Attendance</a>
        <a href="manage-employee.php" class="list-group-item active"><i class="fas fa-users me-2"></i> Manage Employees</a>
        <a href="settings.php" class="list-group-item"><i class="fas fa-cog me-2"></i> Settings</a>
        <a href="logoutpage.php" class="list-group-item"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
      </div>
    </div>

    <!-- Main Content -->
    <div class="col-md-10 py-4">
      <!-- Add New Employee -->
      <div class="card mb-4">
        <div class="card-header fw-bold bg-light">Add New Employees</div>
        <div class="card-body row">
          <div class="col-md-3 text-center">
            <img src="placeholder.jpg" class="img-thumbnail mb-3" alt="Profile Image" style="width: 120px; height: 120px;">
            <input type="file" class="form-control">
          </div>
          <div class="col-md-9">
            <div class="row mb-3">
              <div class="col-md-4">
                <label class="form-label">Employee ID</label>
                <input type="text" class="form-control" placeholder="Enter employee ID">
              </div>
              <div class="col-md-4">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" placeholder="Enter name">
              </div>
              <div class="col-md-4">
                <label class="form-label">Fingerprint ID</label>
                <input type="text" class="form-control" placeholder="Enter fingerprint ID">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">Shift</label>
                <select class="form-select">
                  <option selected>Select Shift</option>
                  <option>8:00 AM - 5:00 PM</option>
                  <option>9:00 AM - 6:00 PM</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Organization</label>
                <select class="form-select">
                  <option selected>RCGI</option>
                  <option>Terraco</option>
                </select>
              </div>
            </div>
            <button class="btn btn-primary">ADD NEW</button>
          </div>
        </div>
      </div>

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
              <tr>
                <td>EMP001</td>
                <td><img src="placeholder.jpg" class="img-thumbnail" style="width: 60px;"></td>
                <td>Shaima Mangadang</td>
                <td>FP001</td>
                <td>8:00 AM - 5:00 PM</td>
                <td>RCGI</td>
                <td>2023-06-08</td>
                <td>
                  <button class="icon-btn"><i class="fas fa-edit"></i></button>
                  <button class="icon-btn"><i class="fas fa-trash"></i></button>
                </td>
              </tr>
              <tr>
                <td>EMP002</td>
                <td><img src="placeholder.jpg" class="img-thumbnail" style="width: 60px;"></td>
                <td>Danica Lepardo</td>
                <td>FP002</td>
                <td>9:00 AM - 6:00 PM</td>
                <td>Terraco</td>
                <td>2024-08-11</td>
                <td>
                  <button class="icon-btn"><i class="fas fa-edit"></i></button>
                  <button class="icon-btn"><i class="fas fa-trash"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="d-flex justify-content-between mt-3">
            <span>Showing 1 to 2 of 2 results</span>
            <div>
              <button class="btn btn-sm btn-outline-secondary">Previous</button>
              <button class="btn btn-sm btn-outline-secondary">Next</button>
            </div>
          </div>
        </div>
      </div>

    </div> <!-- End Main Content -->
  </div> <!-- End Row -->
</div> <!-- End Container -->

</body>
</html>
