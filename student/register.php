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
            <a href="../dashboard.php">Dashboard</a> / Register Student
        </div>

        <h3 id="form-title">Register a New Student</h3>

        <!-- Registration Form -->
        <form id="register-form">
            <label for="student_id">Student ID</label>
            <input type="text" id="student_id" name="student_id" required>

            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" required>

            <button type="submit" class="submit-btn">Register Student</button>
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
                students.splice(index, 1);
                localStorage.setItem('students', JSON.stringify(students));
                window.location.reload();
            };
            actionCell.appendChild(deleteBtn);
        });

        // Handle form submission for adding a new student
        document.getElementById('register-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const newStudent = {
                studentId: document.getElementById('student_id').value,
                firstName: document.getElementById('first_name').value,
                lastName: document.getElementById('last_name').value
            };

            students.push(newStudent);
            localStorage.setItem('students', JSON.stringify(students));

            // Clear the form and refresh the page
            document.getElementById('register-form').reset();
            window.location.reload();
        });
    </script>

</body>
</html>
