<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }


         /* Styling for the h1 title "Edit Student" */
         #page-title {
            font-family: 'Arial', sans-serif;
            font-weight: 100; /* Thin font weight */
            font-size: 32px;  /* Larger font size */
            text-align: left;
            color: #333;
            margin: 50px auto;
            padding-left: 20px; /* Add some space from the left */
            max-width: 1000px; /* Ensure it aligns with the breadcrumb */
        }

        /* Centered Breadcrumb with lighter gray background */
        .breadcrumb {
            background-color: #e8e9eb;  /* Lighter gray */
            padding: 10px;
            border-radius: 4px;
            font-size: 14px;
            text-align: left;
            width: 100%;  /* Full width */
            max-width: 1000px;  /* Make it slightly wider than the form */
            margin: 50px auto 20px;  /* Add top margin for space, center it, and add bottom margin */
            box-sizing: border-box; /* Include padding in the width calculation */
        }

        .breadcrumb a {
            color: #007bff;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .breadcrumb .current {
            color: #999; /* Light gray color for 'Delete Student' */
        }

        .dashboard-container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h3 {
            text-align: left;
            color: #333;
            font-size: 24px;
            margin-top: 0;
            font-weight: 300; /* Thinner font weight */
        }

        .submit-btn, .cancel-btn {
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .submit-btn {
            background-color: #007bff;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        .cancel-btn {
            background-color: #6c757d; /* Set to gray */
        }

        .cancel-btn:hover {
            background-color: #5a6268; /* Darker gray on hover */
        }

        ul {
            list-style-type: disc;
            padding-left: 40px; /* Increase padding to mimic tab indent */
            margin: 20px 0;
        }

        li {
            font-size: 18px;
            margin: 10px 0;
        }

        li strong {
            font-weight: bold;
        }

        .actions {
            display: flex;
            justify-content: flex-start; /* Align buttons to the left */
            gap: 15px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <!-- "Delete Student" Title (h1) placed above breadcrumb -->
    <h2 id="page-title">Delete a Student</h2>

    <!-- Breadcrumb placed above the form, centered and slightly wider -->
    <div id="breadcrumb" class="breadcrumb">
        <a href="../dashboard.php">Dashboard</a> / <a href="register.php">Register Student</a> / <span class="current">Delete Student</span>
    </div>

    <div class="dashboard-container">
        <h3>Are you sure you want to delete the following student record?</h3>

        <div id="student-info">
            <!-- Student details will be displayed here -->
        </div>

        <form id="delete-form">
            <div class="actions">
                <button type="button" class="cancel-btn" onclick="window.location.href='register.php'">Cancel</button>
                <button type="submit" class="submit-btn">Delete Student Record</button>
            </div>
        </form>
    </div>

    <script>
        const studentIndex = new URLSearchParams(window.location.search).get('delete');
        const students = JSON.parse(localStorage.getItem('students')) || [];

        if (studentIndex !== null && students[studentIndex]) {
            const student = students[studentIndex];

            // Display the student details in an unordered list
            const studentInfoDiv = document.getElementById('student-info');
            studentInfoDiv.innerHTML = ` 
                <ul>
                    <li><strong>Student ID:</strong> ${student.studentId}</li>
                    <li><strong>First Name:</strong> ${student.firstName}</li>
                    <li><strong>Last Name:</strong> ${student.lastName}</li>
                </ul>
            `;

            // Handle the deletion of the student record
            document.getElementById('delete-form').addEventListener('submit', function(event) {
                event.preventDefault();

                // Remove the student from the array
                students.splice(studentIndex, 1);

                // Save the updated list back to localStorage
                localStorage.setItem('students', JSON.stringify(students));

                // Redirect back to the register page
                window.location.href = 'register.php';
            });
        } else {
            // If invalid or no student found, redirect to the register page
            window.location.href = 'register.php';
        }
    </script>

</body>
</html>
