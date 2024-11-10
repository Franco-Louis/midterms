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

    <div class="dashboard-container">
        <!-- Breadcrumb -->
        <div id="breadcrumb" class="breadcrumb">
            <a href="#">Register Student</a>
        </div>

        <h3 id="form-title">Register a New Student</h3>

        <!-- Registration Form -->
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
        // Handle form submission
        document.getElementById('registration-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const studentId = document.getElementById('student_id').value;
            const firstName = document.getElementById('first_name').value;
            const lastName = document.getElementById('last_name').value;

            const student = { studentId, firstName, lastName };
            let students = JSON.parse(localStorage.getItem('students')) || [];

            students.push(student);
            localStorage.setItem('students', JSON.stringify(students));
            clearForm();
            displayStudents();
        });

        // Display students
        function displayStudents() {
            const students = JSON.parse(localStorage.getItem('students')) || [];
            const studentTableBody = document.querySelector('#student-table tbody');
            studentTableBody.innerHTML = '';

            students.forEach((student, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${student.studentId}</td>
                    <td>${student.firstName}</td>
                    <td>${student.lastName}</td>
                    <td class="action-buttons">
                        <!-- Redirect to edit.php with student index -->
                        <a href="edit.php?edit=${index}" class="edit-btn">Edit</a>
                        <button class="delete-btn" onclick="deleteStudent(${index})">Delete</button>
                    </td>
                `;
                studentTableBody.appendChild(row);
            });
        }

        // Delete student
        function deleteStudent(index) {
            const students = JSON.parse(localStorage.getItem('students')) || [];
            students.splice(index, 1);
            localStorage.setItem('students', JSON.stringify(students));
            displayStudents();
        }

        // Clear form fields
        function clearForm() {
            document.getElementById('student_id').value = '';
            document.getElementById('first_name').value = '';
            document.getElementById('last_name').value = '';
        }

        // Initial display of students
        displayStudents();
    </script>

</body>
</html>
