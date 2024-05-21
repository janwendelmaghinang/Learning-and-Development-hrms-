<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course List</title>
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

    <h1>List of Courses</h1>
    <button class="print-button" onclick="window.print()">Print this page</button>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Duration</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $val): ?>
            <tr>
                <td><?php echo $val['name'] ?></td>
                <td><?php echo $val['department'] ?></td>
                <td><?php echo $val['designation'] ?></td>
                <td><?php echo $val['duration'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
