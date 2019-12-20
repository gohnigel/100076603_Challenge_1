<?php
    // Check whether the session has started
    if(session_id() == '' || !isset($_SESSION)){session_start();}

    // Include configuration file to access MySQL
    include("config.php");

    //Initialise variables as values passed through POST
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Select values from database
    $sql = "SELECT * FROM users";
    // Place into connection
    $result = mysqli_query($conn, $sql);

    // Get each row of object
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            // If row data equals to POST values
            if($row["email"] == $email && $row["password"] == $password){
                // Set session variables
                $_SESSION["user_id"] = $row["user_id"];
                $_SESSION["name"] = $row["name"];
                $_SESSION["role"] = $row["role"];

                // Redirect to index page
                header("location:../index.php");
            } else {
                // Redirect to login page
                header("location:../login.php");
            }
        }
    } else {
        echo "0 results";
    }
    

    // Close the connection
    mysqli_close($conn);
?>