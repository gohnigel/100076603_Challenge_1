<?php
    // Check whether the session has started
    if(session_id() == '' || !isset($_SESSION)){session_start();}

    // Include configuration file to access MySQL
    include("config.php");

    //Initialise variables as values passed through POST
    $form_id = $_GET["form_id"];

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert values into table
    $sql = "DELETE FROM form WHERE form_id = '$form_id'";

    //Check if connection is added
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
        header("location:../index.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        header("location:../index.php");
    }

    // Alter table to set autoincrement back to original
    $autoIn = "ALTER TABLE form AUTO_INCREMENT = 1";

    //Check if connection is added
    if (mysqli_query($conn, $autoIn)) {
        echo "Form automatically reset";
    } else {
        echo "Error: " . $autoIn . "<br>" . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);

?>