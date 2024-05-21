<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Assessment List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .print-button {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <h1>Online Assessment List</h1>
    <button class="print-button" onclick="window.print()">Print this page</button>

    <table>
        <thead>
            <tr>
                <th>Assessment ID</th>
                <th>Assessment Name</th>
                <th>Course</th>
                <th>Instructor</th>
                <th>Due Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>AS101</td>
                <td>Midterm Exam</td>
                <td>Introduction to Computer Science</td>
                <td>Dr. Jane Smith</td>
                <td>2024-05-25</td>
                <td>Completed</td>
            </tr>
            <tr>
                <td>AS102</td>
                <td>Project Proposal</td>
                <td>Calculus I</td>
                <td>Dr. John Doe</td>
                <td>2024-06-01</td>
                <td>Pending</td>
            </tr>
            <tr>
                <td>AS103</td>
                <td>Essay on Shakespeare</td>
                <td>English Literature</td>
                <td>Prof. Alice Johnson</td>
                <td>2024-05-30</td>
                <td>In Progress</td>
            </tr>
            <tr>
                <td>AS104</td>
                <td>Research Paper</td>
                <td>World History</td>
                <td>Dr. Michael Brown</td>
                <td>2024-06-15</td>
                <td>Not Started</td>
            </tr>
            <tr>
                <td>AS105</td>
                <td>Final Exam</td>
                <td>General Physics</td>
                <td>Prof. Emily Davis</td>
                <td>2024-06-10</td>
                <td>Pending</td>
            </tr>
        </tbody>
    </table>

</body>
</html>
