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
    $servername = "localhost"; // Your MySQL server address
    $username = "root";       // Your MySQL username
    $password = "foo2foo#Bob"; // Your MySQL root password 
    $dbname = "my_db";        // The name of your database

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
        $sql = "SELECT id, name, email FROM users WHERE name LIKE ?";
        $stmt = $conn->prepare($sql);

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
            echo "<tr><th>ID</th><th>Name</th><th>Email</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td></tr>";
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