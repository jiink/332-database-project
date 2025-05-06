<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Section Grades - Search Results</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Section Grades - Search Results</h1>

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
    printf("<h3>Results for Course Num %s and Section Num %s:</h3>\n",
        $_POST["course-num"],
        $_POST["section-num"]);
    $query = "SELECT E.Grade, COUNT(E.CWID) AS NumOfStudents
        FROM Enrollment E
        JOIN Section S ON E.SectionNumber = S.SectionNumber
        WHERE S.CourseNumber = ?
        AND E.SectionNumber = ?
        GROUP BY E.Grade
        ORDER BY E.Grade;";
    $statement = $link->prepare($query);
    if (!$statement)
    {
        die('Error: ' . $link->error);
    }
    $statement->bind_param("ii", $_POST["course-num"], $_POST["section-num"]);
    $statement->execute();
    $result = $statement->get_result();
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Grade</th>";
    echo "<th>Number of students</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    $allGrades = [
        'A+', 'A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'C-', 'D+', 'D', 'D-', 'F'
    ];
    $gradesFromDB = [];
    while ($row = $result->fetch_assoc()) {
        $gradesFromDB[$row["Grade"]] = $row["NumOfStudents"];
    }
    $idx = 0;
    foreach ($allGrades as $grade) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($grade) . "</td>";
        if (isset($gradesFromDB[$grade])) {
            echo "<td>" . htmlspecialchars($gradesFromDB[$grade]) . "</td>";
        } else {
            echo "<td>0</td>";
        }
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    $statement->close();
    $result->free_result();
    $link->close();
    ?>
    <br><br>
    <button onclick="location.href='section-grades.html'" class="button">Go Back</button>
</body>
</html>