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
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Custom alert message styling */
        .alert-message {
            padding: 10px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            font-weight: bold;
            margin: 20px 0;
            text-align: left;
            width: 100%;
            max-width: 900px;  /* Same width as the dashboard */
            position: relative;
            z-index: 2;
            margin-left: auto;
            margin-right: auto;
        }

        .alert-message ul {
            font-weight: lighter;
        }

        .alert-message li {
            font-weight: lighter;
        }

        /* Close "X" in top-right corner */
        .alert-message .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            font-weight: bold;
            color: #721c24;
            cursor: pointer;
        }

        .alert-message .close-btn:hover {
            color: #f1a2a8;
        }

        /* Adjust the alert container to match dashboard container width */
        #alert-container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        /* Styling for the "Register a New Student" title */
        #page-title {
            font-family: 'Arial', sans-serif;
            font-weight: 100;
            font-size: 32px;
            text-align: left;
            color: #333;
            margin: 50px;  /* Adjusted margins for better spacing */
            padding-left: 20px;  /* Align the title with the left side of the dashboard */
            max-width: 900px;  /* Ensure it aligns with the dashboard */
            width: 100%;
        }

        /* Styling for the breadcrumb */
        .breadcrumb {
            background-color: #e8e9eb;
            padding: 10px;
            border-radius: 4px;
            font-size: 14px;
            max-width: 1000px;
            margin: 10px auto 15px;
            width: 100%;
            text-align: left;
            padding-left: 20px;
        }

        .breadcrumb a {
            color: #007bff;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        /* Styling for the dashboard container */
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
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 20px;
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
            width: 100%;
        }

        /* Shortened "Add Student" button styling */
        .submit-btn {
            padding: 10px;
            font-size: 16px;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: auto;  /* Shortened width */
            margin-left: 0;  /* Align the button to the left */
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
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
            gap: 10px;  /* Adds space between the buttons */
        }

        .edit-btn {
            background-color: #007bff; /* Blue color */
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px; /* Add space to the right of the edit button */
        }

        .edit-btn:hover {
            background-color: #0056b3; /* Darker blue for hover effect */
        }

        .delete-btn {
            background-color: #dc3545; /* Red color */
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #c82333; /* Darker red for hover effect */
        }

        /* Styling for the student list container */
        .student-list-container {
            width: 100%;
            max-width: 900px;
            margin: 20px auto;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Align button below the last name input field */
        .form-btn-container {
            display: flex;
            justify-content: flex-start;
            margin-top: 10px;
        }

    </style>
</head>
<body>
    <!-- Alert Container for Error Messages -->
    <div id="alert-container"></div>

    <!-- Page Title -->
    <h2 id="page-title">Register a New Student</h2>

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="../dashboard.php">Dashboard</a> / Register Student
    </div>

    <!-- Dashboard Form -->
    <div class="dashboard-container" id="dashboard-container">
        <form id="register-form">
            <label for="student_id">Student ID</label>
            <input type="text" id="student_id" name="student_id" oninput="validateNumberInput(event)" placeholder="Enter Student ID" />

            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" placeholder="Enter First Name">

            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" placeholder="Enter Last Name">

            <!-- Button container aligned to the left -->
            <div class="form-btn-container">
                <button type="submit" class="submit-btn">Add Student</button>
            </div>
        </form>
    </div>

    <!-- Student List Section -->
    <div class="student-list-container">
        <h2>Student List</h2>
        <table id="students-table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Students will be dynamically added here -->
            </tbody>
        </table>
    </div>

    <script>
        const students = JSON.parse(localStorage.getItem('students')) || [];

        // Display registered students in the table
        const studentsTable = document.getElementById('students-table').getElementsByTagName('tbody')[0];
        students.forEach((student, index) => {
            const row = studentsTable.insertRow();
            row.insertCell(0).textContent = student.studentId;
            row.insertCell(1).textContent = student.firstName;
            row.insertCell(2).textContent = student.lastName;

            const actionCell = row.insertCell(3);
            const editBtn = document.createElement('button');
            editBtn.textContent = 'Edit';
            editBtn.classList.add('edit-btn');
            editBtn.onclick = () => window.location.href = `edit.php?edit=${index}`;
            actionCell.appendChild(editBtn);

            const deleteBtn = document.createElement('button');
            deleteBtn.textContent = 'Delete';
            deleteBtn.classList.add('delete-btn');
            deleteBtn.onclick = () => {
                // Redirect to delete.php page with the student index as a query parameter
                window.location.href = `delete.php?delete=${index}`;
            };
            actionCell.appendChild(deleteBtn);
        });

        // Handle form submission for adding a new student
        document.getElementById('register-form').addEventListener('submit', function(event) {
            event.preventDefault();

            // Get form input values
            const studentId = document.getElementById('student_id').value;
            const firstName = document.getElementById('first_name').value;
            const lastName = document.getElementById('last_name').value;

            // Array to hold errors
            let errors = [];

            // Validation checks
            if (!studentId) errors.push("Student ID is required.");
            if (!firstName) errors.push("First Name is required.");
            if (!lastName) errors.push("Last Name is required.");

            // Check for duplicate Student ID
            const existingStudent = students.find(student => student.studentId === studentId);
            if (existingStudent) {
                errors.push("A student with this ID already exists.");
            }

            if (errors.length > 0) {
                // Create error message HTML
                let errorMessage = "<strong>System Errors</strong><ul>";
                errors.forEach(function(error) {
                    errorMessage += `<li>${error}</li>`;
                });
                errorMessage += "</ul>";

                // Show the error message in the alert container
                document.getElementById('alert-container').innerHTML = ` 
                    <div class="alert-message">
                        ${errorMessage}
                        <span class="close-btn" onclick="closeAlert()">×</span>
                    </div>
                `;
                return; // Don't submit the form if validation fails
            }

            // If no errors, proceed with adding the student
            const newStudent = { studentId, firstName, lastName };
            students.push(newStudent);
            localStorage.setItem('students', JSON.stringify(students));

            // Clear the form and refresh the page
            document.getElementById('register-form').reset();
            window.location.reload();
        });

        // Function to close the alert
        function closeAlert() {
            document.getElementById('alert-container').innerHTML = ''; // Clear the alert
        }

        // Function to validate that only numbers are entered in the student_id field
        function validateNumberInput(event) {
            const input = event.target;
            // Remove any non-digit character
            input.value = input.value.replace(/\D/g, '');
        }
    </script>

</body>
</html>
