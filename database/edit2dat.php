<?php
    // Include configuration file to access MySQL
    include("config.php");

    //Initialise variables as values passed through POST
    $user_id = $_POST["user_id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert values into table
    $sql = "UPDATE users SET name = '$name', email = '$email', password = '$password', role = '$role' WHERE user_id = $user_id";

    //Check if connection is added
    if (mysqli_query($conn, $sql)) {
        echo "User edited successfully";
        header("location:../index.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        header("location:../edit2.php");
    }

    // Close the connection
    mysqli_close($conn);

?>