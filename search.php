<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
</head>
<body>
    <h1>Search Results</h1>

    <?php
    // Database credentials
    require_once './config.php';
    $servername = $db_config['servername'];
    $username = $db_config['username'];
    $password = $db_config['password'];
    $dbname = $db_config['dbname'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the form was submitted and the 'name' field is set
    if (isset($_GET['name']) && !empty($_GET['name'])) {
        $searchName = $_GET['name'];

        // Prepare the SQL statement to prevent SQL injection
        $sql = "SELECT CWID, FirstName, LastName, City FROM Student WHERE FirstName LIKE ?";
        $stmt = $conn->prepare($sql);

        // Check if the statement was prepared successfully
        if ($stmt === false) {
            die("Error preparing the SQL statement: " . $conn->error);
        }

        // Bind the parameter (add wildcards for partial matching)
        $searchTermWithWildcards = "%" . $searchName . "%";
        $stmt->bind_param("s", $searchTermWithWildcards);

        // Execute the query
        $stmt->execute();

        // Get the result set
        $result = $stmt->get_result();

        // Display the results
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>CWID</th><th>First Name</th><th>Last Name</th><th>City</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["CWID"] . "</td><td>" . $row["FirstName"] . "</td><td>" . $row["LastName"] . "</td><td>" . $row["City"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No users found matching your search criteria.</p>";
        }

        // Close the prepared statement
        $stmt->close();

    } else {
        echo "<p>Please enter a name to search for.</p>";
    }

    // Close the database connection
    $conn->close();
    ?>

    <p><a href="index.html">Back to Search Form</a></p>
</body>
</html>