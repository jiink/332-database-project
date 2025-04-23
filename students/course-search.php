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
    echo 'Connected successfully<p>';

    printf("<h3>Results for Course Num %s:</h3>\n", $_POST["course-num"]);

    // **** THIS IS A PLACEHOLDER QUERY. UPDATE IT AND REMOVE THIS COMMENT ****/
    printf("THIS IS A PLACEHOLDER QUERY. UPDATE IT AND REMOVE THIS MESSAGE.<br>\n");
    $query = "SELECT * FROM Student WHERE ZipCode=" . $_POST["course-num"];
    $result = $link->query($query);
    $row = $result->fetch_assoc();
    printf("ZIP: %s<br>\n", $row["ZipCode"]);
    printf("Name: %s %s<br>\n", $row["FirstName"], $row["LastName"]);
    $result->free_result();
    $link->close();
    ?>
    <br><br>
    <button onclick="location.href='course-search.html'" class="button">Go Back</button>
</body>
</html>