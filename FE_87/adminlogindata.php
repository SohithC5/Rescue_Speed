<?php
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Data</title>
    <style>
        body {
            background: linear-gradient(to right, #e0f7fa, #fff9c4); /* Soft gradient background */
            font-family: Arial, sans-serif; /* Set a nice font for readability */
        }
        table {
            border-collapse: collapse; /* Collapse borders for a cleaner look */
            width: 80%; /* Make the table wider */
            margin: 20px auto; /* Center the table */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Add a shadow for depth */
        }
        th, td {
            padding: 15px; /* Add padding for table cells */
            text-align: center; /* Center align text */
        }
        th {
            background-color: #4caf50; /* Green header background */
            color: white; /* White text color for headers */
        }
        tr:nth-child(even) {
            background-color: #f2f2f2; /* Light gray background for even rows */
        }
        tr:hover {
            background-color: #e0f2f1; /* Highlight row on hover */
        }
        a {
            display: block; /* Make the link block level */
            text-align: center; /* Center the text */
            margin: 20px auto; /* Margin for spacing */
            color: #4caf50; /* Link color */
            font-size: 18px; /* Font size for link */
            text-decoration: none; /* Remove underline */
        }
    </style>
</head>
<body>
    <table border="2" cellspacing="0" cellpadding="10">
        <tr>
            <th>Sid</th>
            <th>Name</th>
            <th>Image</th>
            <th>Status</th>
        </tr>
        <?php
        $i = 1;
        $rows = mysqli_query($conn, "SELECT * FROM tb_upload ORDER BY id DESC");
        ?>

        <?php foreach ($rows as $row) : ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo htmlspecialchars($row["name"]); ?></td>
            <td><img src="img/<?php echo htmlspecialchars($row["image"]); ?>" width="200" title="<?php echo htmlspecialchars($row['image']); ?>"></td>
            <td><?php echo htmlspecialchars($row["status"]); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="meetings.html">Login page</a>
    <a href="index.html">Back to Home</a> <!-- Added link to index.html -->
</body>
</html>
