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
            position: relative;  /* Make the body relative to control absolute elements */
        }

        /* Custom alert message styling */
        .alert-message {
            padding: 15px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            font-weight: bold;
            margin: 20px auto;
            text-align: left;
            width: 100%;
            max-width: 870px; /* Constrain the width to match the breadcrumb */
            position: relative; /* Ensures alert stays at the top */
            z-index: 2; /* Ensure it appears above the breadcrumb */
        }

        .alert-message ul {
            font-weight: lighter; /* Make the text in the <ul><li> thinner */
        }

        .alert-message li {
            font-weight: lighter; /* Make the text in each <li> thinner */
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

        /* Styling for the h1 title "Register a New Student" */
        #page-title {
            font-family: 'Arial', sans-serif;
            font-weight: 100; /* Thin font weight */
            font-size: 32px;  /* Larger font size */
            text-align: left;
            color: #333;
            margin: 20px auto;
            padding-left: 20px; /* Add some space from the left */
            max-width: 1000px; /* Ensure it aligns with the breadcrumb */
        }

        /* Styling for the breadcrumb with rectangle background on the left */
        .breadcrumb {
            background-color: #e8e9eb;
            padding: 10px;
            border-radius: 4px;
            font-size: 14px;
            max-width: 1000px;
            margin: 10px auto 15px;  /* Reduced top margin and bottom margin to bring closer */
            width: 100%;  /* Ensures breadcrumb stretches across */
            text-align: left;  /* Align breadcrumb to the left */
            padding-left: 20px; /* Add space from the left side */
            position: relative; /* Ensures breadcrumb positioning is in context */
            z-index: 1; /* Below the alert message */
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
            margin: 0 auto;  /* Reduced margin to pull the container up */
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

        .submit-btn {
            padding: 12px;
            font-size: 16px;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
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
            gap: 10px;
        }

        .edit-btn {
            background-color: #f0ad4e;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .delete-btn {
            background-color: #d9534f;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <!-- Alert Container for Error Messages, placed above the breadcrumb -->
    <div id="alert-container"></div>

    <!-- "Register a New Student" Title (h1) placed above breadcrumb -->
    <h2 id="page-title">Register a New Student</h2>

    <!-- Breadcrumb placed outside dashboard, left-aligned within the rectangle -->
    <div class="breadcrumb">
        <a href="../dashboard.php">Dashboard</a> / Register Student
    </div>

    <div class="dashboard-container" id="dashboard-container">
        

        <!-- Registration Form -->
        <form id="register-form">
            <label for="student_id">Student ID</label>
            <input type="text" id="student_id" name="student_id" oninput="validateNumberInput(event)" />

            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name">

            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name">

            <button type="submit" class="submit-btn">Add Student</button>
        </form>

        <!-- List of Registered Students -->
        <h3>Registered Students</h3>
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

