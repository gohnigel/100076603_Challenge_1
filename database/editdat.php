<?php
    // Check whether the session has started
    if(session_id() == '' || !isset($_SESSION)){session_start();}

    // Include configuration file to access MySQL
    include("config.php");

    $form_id = $_POST["form_id"];

    //Initialise variables as values passed through POST
    if($_SESSION["role"] != "Manager"){
        $name = $_POST["name"];
        $gender = $_POST["gender"];
        $address = $_POST["address"];
        $country = $_POST["country"];
        $file1 = $_FILES["file1"]["name"];
        $file2 = $_FILES["file2"]["name"];
        $descr = $_POST["descr"];
    } else if($_SESSION["role"] != "Employee") {
        $verify1 = isset($_POST["verify1"]);
        $verify2 = isset($_POST["verify2"]);
        $reason = $_POST["reason"];
        if(isset($_POST["approve"])) $approve = $_POST["approve"];
        else $approve = "Pending";
    }

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert values into table
    if($_SESSION["role"] == "Employee"){
        $sql = "UPDATE form SET name = '$name', gender = '$gender', address = '$address', country = '$country', file1 = '$file1', file2 = '$file2', descr = '$descr', approve = 'Pending', form_date = CURDATE() WHERE form_id = '$form_id'";
    } else if($_SESSION["role"] == "Manager"){
        $sql = "UPDATE form SET verify1 = '$verify1', verify2 = '$verify2', reason = '$reason', approve = '$approve', form_date = CURDATE() WHERE form_id = '$form_id'";
    } else {
        $sql = "UPDATE form SET name = '$name', gender = '$gender', address = '$address', country = '$country', file1 = '$file1', file2 = '$file2', descr = '$descr', verify1 = '$verify1', verify2 = '$verify2', reason = '$reason', approve = '$approve', form_date = CURDATE() WHERE form_id = '$form_id'";
    }
    

    // //Check if connection is added
    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
        if($_SESSION["role"] != "Manager"){
            move_uploaded_file($_FILES["file1"]["tmp_name"], '../files/'.$file1);
            move_uploaded_file($_FILES["file2"]["tmp_name"], '../files/'.$file2);
        }
        header("location:../index.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        header("location:../edit.php");
    }

    // Close the connection
    mysqli_close($conn);

?>