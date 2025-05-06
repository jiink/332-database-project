<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Search - Results</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Course Search - Results</h1>

    <?php
    require_once '../config.php';
    $servername = $db_config['servername'];
    $username = $db_config['username'];
    $password = $db_config['password'];
    $dbname = $db_config['dbname'];

    $link = mysqli_connect($servername, $username, $password, $dbname);
    if (!$link) {
        die('Could not connect: ' . mysql_error());
    }

    printf("<h3>Results for Course Num %s:</h3>\n", $_POST["course-num"]);
    $query = "SELECT S.SectionNumber, S.Classroom, S.MeetingDays, S.BeginTime, S.EndTime, (
            SELECT COUNT(E.CWID)
            FROM Enrollment E
            WHERE E.SectionNumber = S.SectionNumber
            ) AS NumStudents
        FROM Section S
        WHERE S.CourseNumber = ?;";
    $statement = $link->prepare($query);
    if (!$statement)
    {
        echo "Error: " . $link->error;
        return;
    }
    $statement->bind_param("i", $_POST["course-num"]);
    $statement->execute();
    $result = $statement->get_result();
    echo "<h3>" . $result->num_rows . " sections found.</h3>";
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Section Number</th>";
    echo "<th>Room</th>";
    echo "<th>Meeting days</th>";
    echo "<th>Begin time</th>";
    echo "<th>End time</th>";
    echo "<th>Number of students</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while($row = $result->fetch_assoc())
    {
        echo "<tr>";
        echo "<td>" . $row["SectionNumber"] . "</td>";
        echo "<td>" . $row["Classroom"] . "</td>";
        echo "<td>" . $row["MeetingDays"] . "</td>";
        $beginTime = sprintf("%02d:%02d", intdiv($row["BeginTime"], 100), $row["BeginTime"] % 100);
        echo "<td>" . $beginTime . "</td>";
        $endTime = sprintf("%02d:%02d", intdiv($row["EndTime"], 100), $row["EndTime"] % 100);
        echo "<td>" . $endTime . "</td>";
        echo "<td>" . $row["NumStudents"] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    $statement->close();
    $result->free_result();
    $link->close();
    ?>
    <br><br>
    <button onclick="location.href='course-search.html'" class="button">Go Back</button>
</body>
</html>