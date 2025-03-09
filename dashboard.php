<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RCGI | DASHBOARD</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
  <link rel="icon" href="pics/rcgiph_logo.jpg" type="image/jpg" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
      font-weight: 600;
      font-size: 15px;
      background: #F3F4F6;
    }

    .navbar {
        display: flex;
            align-items: center;
            justify-content: space-between;
            background: white;
            padding: 15px 20px;
            border-bottom: 1px solid #DFDDDD;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    }

    .navbar .left {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 18px;
      font-weight: bold;
    }

    .navbar .left i {
      font-size: 22px;
    }

    .navbar .right {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .navbar .right i {
      font-size: 20px;
      cursor: pointer;
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

    .sidebar {
      background-color: #f8f9fa;
      height: 100vh;
      display: flex;
      flex-direction: column;
      border-right: 1px solid #ddd;
      padding-top: 20px;
      position: fixed;
      left: 0;
      top: 80px;
      width: 250px;
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

    .main-content {
      margin-left: 250px;
      padding: 20px;
    }

    .card {
      border: 1px solid #DFDDDD;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.25);
      border-radius: 3px;
    }

    .col-md-4 h4 {
      margin-left: 30px;
      font-family: 'Inika', serif;
      font-weight: 400;
      font-size: 13px;
      line-height: 17px;
      color: #000000;
    }

    .col-md-4 p {
      margin-top: -10px;
      margin-left: 40px;
      font-family: 'Inika', serif;
      font-weight: 400;
      font-size: 36px;
      color: #000000;
    }

    .activity-item {
      display: block;
      text-align: left;
      padding: 10px;
      border: none;
      background: none;
      width: 100%;
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

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-2 sidebar">
      <div class="list-group">
        <a href="dashboard.php" class="list-group-item list-group-item-action active">
          <i class="fas fa-tachometer-alt sidebar-icon"></i> Dashboard
        </a>
        <a href="view-attendance.php" class="list-group-item list-group-item-action">
          <i class="fas fa-clock sidebar-icon"></i> View Attendance
        </a>
        <a href="manage-employee.php" class="list-group-item list-group-item-action">
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
    <div class="col-md-10 main-content">
      <div class="row">
        <div class="col-md-4">
          <div class="card p-3">
            <h4>Total Employees</h4>
            <p>156 <i class="fas fa-users"></i></p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card p-3">
            <h4>Present Today</h4>
            <p>142 <i class="fas fa-user-check"></i></p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card p-3">
            <h4>On Leave</h4>
            <p>14 <i class="fas fa-user-times"></i></p>
          </div>
        </div>
      </div>

      <!-- Recent Activities -->
      <div class="row mt-4">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header text-white" style="background-color: #9FAC9F;">
              <h5 class="mb-0">Recent Activities</h5>
            </div>
            <div class="card-body">
              <ul class="list-group">
                <li class="list-group-item">
                  <button class="activity-item">
                    <i class="fas fa-user"></i> <span>Employee #123 checked in</span>
                    <p class="text-muted ms-4 mb-0">Today at 8:00 AM</p>
                  </button>
                </li>
                <li class="list-group-item">
                  <button class="activity-item">
                    <i class="fas fa-user"></i> <span>Employee #456 checked out</span>
                    <p class="text-muted ms-4 mb-0">Today at 5:00 PM</p>
                  </button>
                </li>
                <li class="list-group-item">
                  <button class="activity-item">
                    <i class="fas fa-user"></i> <span>Employee #789 requested leave</span>
                    <p class="text-muted ms-4 mb-0">Today at 2:00 PM</p>
                  </button>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- End of main-content -->
  </div>
</div>

</body>
</html>
