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
    <title>Register Student</title>
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
            text-align: center;
            color: #333;
            font-size: 24px;
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

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 16px;
            color: #333;
        }

        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .submit-btn {
            padding: 12px;
            font-size: 16px;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            margin-top: 40px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons button {
            padding: 5px 10px;
            font-size: 14px;
            cursor: pointer;
        }

        .action-buttons .edit-btn {
            background-color: #f0ad4e;
            color: white;
        }

        .action-buttons .delete-btn {
            background-color: #d9534f;
            color: white;
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        <div class="breadcrumb">
            <a href="dashboard.php">Dashboard</a> / Register Student
        </div>

        <h3>Register a New Student</h3>

        <!-- Student Registration Form -->
        <form id="registration-form">
            <label for="student_id">Student ID</label>
            <input type="text" id="student_id" name="student_id" placeholder="Enter Student ID" required>

            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" placeholder="Enter First Name" required>

            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" placeholder="Enter Last Name" required>

            <button type="submit" class="submit-btn">Add Student</button>
        </form>

        <!-- Student List Table -->
        <h3>Student List</h3>
        <table id="student-table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dynamic content will be inserted here -->
            </tbody>
        </table>
    </div>

    <script>
        // Function to handle the form submission
        document.getElementById('registration-form').addEventListener('submit', function(event) {
            event.preventDefault();  // Prevent form from submitting normally

            const studentId = document.getElementById('student_id').value;
            const firstName = document.getElementById('first_name').value;
            const lastName = document.getElementById('last_name').value;

            // Create a student object
            const student = { studentId, firstName, lastName };

            // Get the existing students from localStorage or create an empty array if none exists
            let students = JSON.parse(localStorage.getItem('students')) || [];

            // Add the new student to the array
            students.push(student);

            // Save the updated students array back to localStorage
            localStorage.setItem('students', JSON.stringify(students));

            // Clear the form inputs
            document.getElementById('student_id').value = '';
            document.getElementById('first_name').value = '';
            document.getElementById('last_name').value = '';

            // Update the student list table
            displayStudents();
        });

        // Function to display the list of students
        function displayStudents() {
            const students = JSON.parse(localStorage.getItem('students')) || [];
            const studentTableBody = document.querySelector('#student-table tbody');
            studentTableBody.innerHTML = '';  // Clear the existing rows

            // Loop through the students and add rows to the table
            students.forEach((student, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${student.studentId}</td>
                    <td>${student.firstName}</td>
                    <td>${student.lastName}</td>
                    <td class="action-buttons">
                        <button class="edit-btn" onclick="editStudent(${index})">Edit</button>
                        <button class="delete-btn" onclick="deleteStudent(${index})">Delete</button>
                    </td>
                `;
                studentTableBody.appendChild(row);
            });
        }

        // Function to handle editing a student
        function editStudent(index) {
            const students = JSON.parse(localStorage.getItem('students')) || [];
            const student = students[index];

            document.getElementById('student_id').value = student.studentId;
            document.getElementById('first_name').value = student.firstName;
            document.getElementById('last_name').value = student.lastName;

            // Remove the student from the array (we will update them later)
            students.splice(index, 1);
            localStorage.setItem('students', JSON.stringify(students));
        }

        // Function to handle deleting a student
        function deleteStudent(index) {
            const students = JSON.parse(localStorage.getItem('students')) || [];
            students.splice(index, 1);  // Remove the student from the array
            localStorage.setItem('students', JSON.stringify(students));  // Update localStorage

            // Re-display the updated student list
            displayStudents();
        }

        // Initial display of students
        displayStudents();
    </script>

</body>
</html>
