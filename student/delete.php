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
        .dashboard-container {
            width: 100%;
            max-width: 900px;
            margin: 50px auto;
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
        }

        .breadcrumb {
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .breadcrumb a {
            color: #007bff;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
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

    <div class="dashboard-container">
        <!-- Breadcrumb -->
        <div id="breadcrumb" class="breadcrumb">
            <a href="../dashboard.php">Dashboard</a> / <a href="register.php">Register Student</a> / Delete Student
        </div>

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
