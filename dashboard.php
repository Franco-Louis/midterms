<?php
session_start();  // Start the session to access session data

// Check if user is logged in (session variable is set)
if (!isset($_SESSION['user_email'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();  // Make sure no further code is executed
}

$user_email = $_SESSION['user_email'];  // Get the logged-in user's email
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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

        /* Flex container for heading and cards */
        .header-container {
            display: flex;
            justify-content: flex-start; /* Align the heading to the left */
            margin-bottom: 20px; /* Add some space between the heading and the cards */
        }

        h3 {
            color: #333;
            font-size: 24px;
        }

        /* Flex container for cards */
        .cards-container {
            display: flex;
            justify-content: space-around;
            gap: 20px;
            margin-top: 40px;
        }

        /* Card styling - remove white background */
        .card {
            width: 45%;
            border: 2px solid #ddd; /* Light border around each card */
            border-radius: 8px;
            padding: 20px;
            text-align: left; /* Align text inside cards to the left */
            transition: all 0.3s ease;
            background-color: transparent; /* No background color inside the card */
        }
        .card:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Light shadow on hover */
        }

        /* Title and description section in the card */
        .card h4 {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px; /* Space between text and the button */
        }

        /* Adding a border to separate text from button */
        .card-content {
            margin-bottom: 20px;
        }

        /* Button styling */
        .card button {
            padding: 12px;
            font-size: 16px;
            color: white;
            background-color: #007bff; /* Blue color */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%; /* Make the button extend inside the card */
        }

        .card button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        <!-- Header Container -->
        <div class="header-container">
            <h3>Welcome to the System, <?php echo htmlspecialchars($user_email); ?></h3>
        </div>

        <!-- Cards for Subject and Student Registration -->
        <div class="cards-container">

            <!-- Card for Adding a Subject -->
            <div class="card">
                <div class="card-content">
                    <h4>Add a Subject</h4>
                    <p>This section allows you to add a new subject in the system. Click the button below to proceed with the adding process.</p>
                </div>
                <form action="add_subject.php" method="GET">
                    <button type="submit">Add Subject</button>
                </form>
            </div>

            <!-- Card for Registering a Student -->
            <div class="card">
                <div class="card-content">
                    <h4>Register a Student</h4>
                    <p>This section allows you to register a new student in the system. Click the button below to proceed with the registration process.</p>
                </div>
                <!-- Change action to point to 'student/register.php' -->
                <form action="student/register.php" method="GET">
                    <button type="submit">Register</button>
                </form>
            </div>

        </div>
    </div>

</body>
</html>
