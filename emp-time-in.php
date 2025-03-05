<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RCGI | TIME IN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="icon" href="pics/rcgiph_logo.jpg" type="image/x-icon">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 15px;
            background: #F3F4F6;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .timein-container {
            max-width: 400px;
            background: #FFFFFF;
            border: 2px solid #7A8D7A;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 20px;
            padding: 30px;
            text-align: center;
        }

        .logo {
            display: block;
            margin: 0 auto 10px;
            width: 60px;
        }

        h4 {
            font-size: 18px;
            font-style: italic;
            margin-bottom: 10px;
        }

        #time {
            font-size: 18px;
            background: #DCE7D8;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
            font-weight: bold;
        }

        .clock-icon {
            font-size: 40px;
            margin: 15px 0;
            color: black;
        }

        select, input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input::placeholder {
            text-align: center;
        }

        .enter-button {
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

        .enter-button:hover {
            background-color: #5f6e5f;
        }
    </style>
</head>
<body>

<div class="timein-container">
    <img src="pics/rcgiph_logo.jpg" alt="Company Logo" class="logo">
    <h4 id="date"></h4>
    <span id="time">--:--:--</span>
    <div class="clock-icon"><i class="fas fa-clock"></i></div>

    <select class="form-control">
        <option selected>TIME IN</option>
        <option>TIME OUT</option>
    </select>

    <input type="text" class="form-control" placeholder="Employee ID" required>

    <button type="submit" class="enter-button">ENTER</button>
</div>

<script>
    function updateTime() {
        const now = new Date();
        const dateOptions = { weekday: 'long', month: 'long', day: '2-digit', year: 'numeric' };
        const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
        
        document.getElementById('date').textContent = now.toLocaleDateString('en-US', dateOptions);
        document.getElementById('time').textContent = now.toLocaleTimeString('en-US', timeOptions);
    }

    setInterval(updateTime, 1000);
    updateTime();
</script>

</body>
</html>
