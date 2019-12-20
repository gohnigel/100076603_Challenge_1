<?php
    // Include configuration file to access MySQL
    include("config.php");

    //Initialise variables as values passed through POST
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert values into table
    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";

    //Check if connection is added
    if (mysqli_query($conn, $sql)) {
        echo "New user created successfully";
        header("location:../index.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        header("location:../add2.php");
    }

    // Close the connection
    mysqli_close($conn);

?>