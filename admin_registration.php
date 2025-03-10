<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RCGI | SETTINGS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="icon" href="pics/rcgiph_logo.jpg" type="image/x-icon">
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
            top: 70px;
            width: 250px; /* Fixed width */
            z-index: 1000;
            padding: 1rem;
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
        .main-content {
            margin-left: 270px;
            padding: 20px;
        }

        /* Settings Container */
        .admin-form {
            max-width: 600px;
            background: #FFFFFF;
            border: 2px solid #7A8D7A;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 20px;
            padding: 30px;
            margin: auto;
            margin-top: 50px;
        }

        .admin-form label {
            font-weight: bold;
            margin-top: 10px;
        }

        .admin-form input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .admin-form .input-container {
            display: flex;
            align-items: center;
        }

        .admin-form .input-container input {
            width: 80px;
            text-align: center;
            margin-right: 10px;
        }

        .admin-form .small-text {
            font-size: 12px;
            font-style: italic;
            color: #666;
            margin-top: 5px;
        }

        .admin-form .save-button {
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

        .admin-form .save-button:hover {
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
<div class="navbar">
    <div class="left">
        <i class="fas fa-cog"></i>
        <span>Settings</span>
    </div>
    <div class="right">
        <i class="fas fa-bell"></i>
        <div class="profile">
            <i class="fas fa-user"></i>
        </div>
    </div>
</div>

<!-- Sidebar -->
<div class="sidebar">
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
        <a href="settings.php" class="list-group-item list-group-item-action active">
            <i class="fas fa-cog sidebar-icon"></i> Settings
        </a>
        <a href="logoutpage.php" class="list-group-item list-group-item-action">
            <i class="fas fa-sign-out-alt sidebar-icon"></i> Logout
        </a>
    </div>
</div>

<!-- Settings Form -->
<div class="main-content">
    <div class="admin-form">

        <label for="uname">Username</label>
        <input type="text" placeholder="Enter Email" name="email" autocomplete="off" required />

        <label for="psw">Password</label>
        <input type="password" placeholder="Enter Password" name="psw" id="password" autocomplete="off" required />


        <label for="psw-repeat">Repeat Password</label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" id="passwordRepeat" autocomplete="off" required />
        <button type="submit" name="create" class="save-button">Add admin</button>
    </div>
</div>


</body>
</html>
