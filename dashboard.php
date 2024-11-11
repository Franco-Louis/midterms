<?php
session_start();  // Start the session to access session data

// Check if user is logged in (session variable is set)
if (!isset($_SESSION['user_email'])) {
    // If not logged in, redirect to login page
    header("location: index.php");
    exit();  // Make sure no further code is executed
}

$user_email = $_SESSION['user_email'];  // Get the logged-in user's email

// Logout functionality
if (isset($_POST['logout'])) {
    session_unset();  // Unset all session variables
    session_destroy();  // Destroy the session

    // Prevent the browser from caching the page (important for preventing Back button)
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");

    // Redirect to the index page after logout
    header("Location: index.php");
    exit();
}
?>

<?php 
    $_SESSION['title'] = 'Dashboard';
    include 'header.php'; 
?>

    <style>
        /* General body styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9; /* Background color for the page */
            margin: 0;
            padding: 0;
        }
        .dashboard-container {
            width: 100%;
            max-width: 900px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: transparent; /* Set background to transparent */
        }
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        h3 {
            color: #333;
            font-size: 24px;
        }
        .cards-container {
            display: flex;
            justify-content: space-around;
            gap: 20px;
            margin-top: 40px;
        }
        .card {
            width: 45%;
            border: 2px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: left;
            transition: all 0.3s ease;
            background-color: transparent;
        }
        .card:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .card h4 {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }
        .card p {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
        }
        .card button {
            padding: 12px;
            font-size: 16px;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        .card button:hover {
            background-color: #0056b3;
        }
        .logout-btn {
            padding: 10px 20px;
            background-color: #d9534f;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .logout-btn:hover {
            background-color: #c9302c;
        }
    </style>

    <script>
        // Handle back button press (logout and disable navigation)
        window.history.pushState(null, null, window.location.href);
        window.onpopstate = function() {
            window.history.pushState(null, null, window.location.href);
            alert('You have been logged out.');
            // Redirect to login page after logout
            window.location.href = "index.php";
        }

        // Prevent forward navigation after logout
        window.onbeforeunload = function() {
            sessionStorage.setItem('logoutRedirect', 'true');
        };

        if (sessionStorage.getItem('logoutRedirect') === 'true') {
            window.location.href = "index.php"; // Redirect to login page
        }
    </script>

</head>
<body>

    <div class="dashboard-container">
        <div class="header-container">
            <h3>Welcome to the System, <?php echo htmlspecialchars($user_email); ?></h3>
            <form method="POST" action="">
                <button type="submit" name="logout" class="logout-btn">Logout</button>
            </form>
        </div>

        <div class="cards-container">
            <div class="card">
                <h4>Add a Subject</h4>
                <p>This section allows you to add a new subject in the system. Click the button below to proceed with the adding process.</p>
                <form action="add_subject.php" method="GET">
                    <button type="submit">Add Subject</button>
                </form>
            </div>
            <div class="card">
                <h4>Register a Student</h4>
                <p>This section allows you to register a new student in the system. Click the button below to proceed with the registration process.</p>
                <form action="student/register.php" method="GET">
                    <button type="submit">Register</button>
                </form>
            </div>
        </div>
    </div>

<?php include 'footer.php';?>
