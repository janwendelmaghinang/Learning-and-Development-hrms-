<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Training List</title>
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

    <h1>Online Training List</h1>
    <button class="print-button" onclick="window.print()">Print this page</button>

    <table>
        <thead>
            <tr>
                <th>Training ID</th>
                <th>Training Name</th>
                <th>Instructor</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>TR101</td>
                <td>Web Development Bootcamp</td>
                <td>Dr. Jane Smith</td>
                <td>2024-06-01</td>
                <td>2024-06-30</td>
                <td>Upcoming</td>
            </tr>
            <tr>
                <td>TR102</td>
                <td>Data Science with Python</td>
                <td>Dr. John Doe</td>
                <td>2024-05-15</td>
                <td>2024-06-15</td>
                <td>Ongoing</td>
            </tr>
            <tr>
                <td>TR103</td>
                <td>Digital Marketing Essentials</td>
                <td>Prof. Alice Johnson</td>
                <td>2024-06-05</td>
                <td>2024-07-05</td>
                <td>Upcoming</td>
            </tr>
            <tr>
                <td>TR104</td>
                <td>Advanced Excel Training</td>
                <td>Dr. Michael Brown</td>
                <td>2024-05-20</td>
                <td>2024-06-20</td>
                <td>Ongoing</td>
            </tr>
            <tr>
                <td>TR105</td>
                <td>Cybersecurity Fundamentals</td>
                <td>Prof. Emily Davis</td>
                <td>2024-07-01</td>
                <td>2024-07-31</td>
                <td>Upcoming</td>
            </tr>
        </tbody>
    </table>

</body>
</html>
