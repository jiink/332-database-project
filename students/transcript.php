<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transcript - Results</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Transcript - Results</h1>

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
    echo 'Connected successfully<p>';

    printf("<h3>Results for CWID %s:</h3>\n", $_POST["cwid"]);
    $query = "SELECT S.CourseNumber, C.Title, E.Grade
        FROM Enrollment E
        JOIN Section S ON E.SectionNumber = S.SectionNumber
        JOIN Course C ON S.CourseNumber = C.CourseNumber
        WHERE E.CWID = ?;";
    $statement = $link->prepare($query);
    if (!$statement)
    {
        echo "Error: " . $link->error;
        return;
    }
    $statement->bind_param("i", $_POST["cwid"]);
    $statement->execute();
    $result = $statement->get_result();
    echo "<h3>" . $result->num_rows . " classes found.</h3>";
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Class title</th>";
    echo "<th>Course number</th>";
    echo "<th>Grade</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while($row = $result->fetch_assoc())
    {
        echo "<tr>";
        echo "<td>" . $row["Title"] . "</td>";
        echo "<td>" . $row["CourseNumber"] . "</td>";
        echo "<td>" . $row["Grade"] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    $statement->close();
    $result->free_result();
    $link->close();
    ?>
    <br><br>
    <button onclick="location.href='transcript.html'" class="button">Go Back</button>
</body>
</html>