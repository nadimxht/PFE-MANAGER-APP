<?php
require_once 'connection.php';
require_once "securite.php";
// // Get the list of teachers
$req="select user_id,first_name,last_name,email, 
from users u
where u.role = 'teacher'";
$res=mysqli_query($con,$req);

// // Get the list of projects
// $sql = "SELECT * FROM projects WHERE status = 'pending'";
// $result_projects = $conn->query($sql);

// // Get the list of upcoming defenses
// $sql = "SELECT * FROM defenses WHERE status = 'pending'";
// $result_defenses = $conn->query($sql);
// ?> 

<!DOCTYPE html>
<html>
<head>
    <title>Chef Department Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Chef Department Dashboard</h1>

    <h2>Gestion des enseignants</h2>
    <!-- Display the list of teachers here -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($res->num_rows > 0) {
                while($row = $res->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["role"] . "</td>";
                    echo "<td><a href='edit_teacher.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete_teacher.php?id=" . $row["id"] . "'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No teachers found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <h2>Validation des projets</h2>
    <!-- Display the list of pending projects here -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result_projects->num_rows > 0) {
                while($row = $result_projects->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["title"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    echo "<td><a href='validate_project.php?id=" . $row["id"] . "'>Validate</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No pending projects found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <h2>Coordination des plannings</h2>
    <!-- Display the list of upcoming defenses here -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Student</th>
                <th>Project</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result_defenses->num_rows > 0) {
                while($row = $result_defenses->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["student"] . "</td>";
                    echo "<td>" . $row["project"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td><a href='schedule_defense.php?id=" . $row["id"] . "'>Schedule</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No upcoming defenses found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>