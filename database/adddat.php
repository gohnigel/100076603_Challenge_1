<?php
    // Check whether the session has started
    if(session_id() == '' || !isset($_SESSION)){session_start();}

    // Include configuration file to access MySQL
    include("config.php");

    //Initialise variables as values passed through POST
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $country = $_POST["country"];
    $file1 = $_FILES["file1"]["name"];
    $file2 = $_FILES["file2"]["name"];
    $descr = $_POST["descr"];
    
    // Initialise session variable as PHP variable
    $user_id = $_SESSION["user_id"];

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert values into table
    $sql = "INSERT INTO form (user_id, name, gender, address, country, file1, file2, descr, form_date, approve) VALUES ('$user_id', '$name', '$gender', '$address', '$country', '$file1', '$file2', '$descr', CURDATE(), 'Pending')";

    //Check if connection is added
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
        move_uploaded_file($_FILES["file1"]["tmp_name"], '../files/'.$file1);
        move_uploaded_file($_FILES["file2"]["tmp_name"], '../files/'.$file2);
        header("location:../index.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        header("location:../add.php");
    }

    // Close the connection
    mysqli_close($conn);

?>