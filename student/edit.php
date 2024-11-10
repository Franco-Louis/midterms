<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
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
    </style>
</head>
<body>

    <div class="dashboard-container">
        <div id="breadcrumb" class="breadcrumb">
            <a href="register.php">Register Student</a> / Edit Student
        </div>

        <h3>Edit Student</h3>

        <form id="edit-form">
            <label for="student_id">Student ID</label>
            <input type="text" id="student_id" name="student_id" required>

            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" required>

            <button type="submit" class="submit-btn">Update Student</button>
        </form>
    </div>

    <script>
        const studentIndex = new URLSearchParams(window.location.search).get('edit');
        const students = JSON.parse(localStorage.getItem('students')) || [];

        // Load student data for editing
        if (studentIndex !== null && students[studentIndex]) {
            const student = students[studentIndex];
            document.getElementById('student_id').value = student.studentId;
            document.getElementById('first_name').value = student.firstName;
            document.getElementById('last_name').value = student.lastName;
        }

        // Handle form submission for updating student
        document.getElementById('edit-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const updatedStudent = {
                studentId: document.getElementById('student_id').value,
                firstName: document.getElementById('first_name').value,
                lastName: document.getElementById('last_name').value
            };

            students[studentIndex] = updatedStudent;
            localStorage.setItem('students', JSON.stringify(students));

            // Redirect back to register.php after updating
            window.location.href = 'register.php';
        });
    </script>

</body>
</html>
