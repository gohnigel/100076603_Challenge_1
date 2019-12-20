<!DOCTYPE html>
<?php
    include('database/config.php');

    if(session_id() == '' || !isset($_SESSION)){session_start();}

    if(!isset($_SESSION["user_id"])) {
        header("location:login.php");
    }
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style/style.css">
        <title>Form Approval System</title>
    </head>
    <body>
        <!-- Show navigation bar -->
        <?php include('ui/nav.php'); ?>
        
       <section>
            <!-- Add new form -->
            <?php
                if($_SESSION["role"] != "Manager") {
                    echo "<h1><a href='add.php'>Add form</a></h1>";
                }
             ?>

            <!-- Show approved forms in a table -->
            <table>
                <tr>
                    <th>Owner</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                    <?php
                        // Show values based on roles
                        if($_SESSION["role"] == "Employee"){
                            // Initialise session variable as PHP variable
                            $user_id = $_SESSION["user_id"];

                            // Select values from database
                            $sql = "SELECT * FROM form WHERE user_id = $user_id";
                            // Place into connection
                            $result = mysqli_query($conn, $sql);
                            
                            // Get each row of object
                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <td><?php echo $row["name"]; ?></td>
                                    <td><?php  echo date_format(date_create($row["form_date"]), "d/m/Y"); ?></td>
                                    <td><?php echo $row["approve"]; ?></td>
                                    <td><a href="edit.php?form_id=<?php echo $row["form_id"]; ?>&name=<?php echo $row["name"]; ?>&gender=<?php echo $row["gender"]; ?>&address=<?php echo $row["address"]; ?>&country=<?php echo $row["country"]; ?>&descr=<?php echo $row["descr"]; ?>&file1=<?php echo $row["file1"]; ?>&file2=<?php echo $row["file2"]; ?>&verify1=<?php echo $row["verify1"]; ?>&verify2=<?php echo $row["verify2"]; ?>&reason=<?php echo $row["reason"]; ?>&approve=<?php echo $row["approve"]; ?>"><button <?php if($row["approve"] != "Not approved") echo "disabled"; ?>>Edit</button></a> <a href="database/deldat.php?form_id=<?php echo $row["form_id"]; ?>"><button onclick="if(!confirm('Are you sure you want to delete this form?')) return false;" <?php if($row["approve"] != "Not approved") echo "disabled"; ?>>Delete</button></td>
                                </tr>
                        <?php
                                }
                            }
                        } else if($_SESSION["role"] == "Manager") {
                            // Select values from database
                            $sql = "SELECT * FROM form";
                            // Place into connection
                            $result = mysqli_query($conn, $sql);
                            
                            // Get each row of object
                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <td><?php echo $row["name"]; ?></td>
                                    <td><?php  echo date_format(date_create($row["form_date"]), "d/m/Y"); ?></td>
                                    <td><?php echo $row["approve"]; ?></td>
                                    <td><a href="edit.php?form_id=<?php echo $row["form_id"]; ?>&name=<?php echo $row["name"]; ?>&gender=<?php echo $row["gender"]; ?>&address=<?php echo $row["address"]; ?>&country=<?php echo $row["country"]; ?>&descr=<?php echo $row["descr"]; ?>&file1=<?php echo $row["file1"]; ?>&file2=<?php echo $row["file2"]; ?>&verify1=<?php echo $row["verify1"]; ?>&verify2=<?php echo $row["verify2"]; ?>&reason=<?php echo $row["reason"]; ?>&approve=<?php echo $row["approve"]; ?>"><button <?php if($row["approve"] != "Pending") echo "disabled"; ?>>Edit</button></a> <a href="database/deldat.php?form_id=<?php echo $row["form_id"]; ?>"><button onclick="if(!confirm('Are you sure you want to delete this form?')) return false;" <?php if($row["approve"] != "Pending") echo "disabled"; ?>>Delete</button></td>
                                </tr>
                        <?php
                                }
                            }
                        } else {
                            // Select values from database
                            $sql = "SELECT * FROM form";
                            // Place into connection
                            $result = mysqli_query($conn, $sql);
                            
                            // Get each row of object
                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <td><?php echo $row["name"]; ?></td>
                                    <td><?php  echo date_format(date_create($row["form_date"]), "d/m/Y"); ?></td>
                                    <td><?php echo $row["approve"]; ?></td>
                                    <td><a href="edit.php?form_id=<?php echo $row["form_id"]; ?>&name=<?php echo $row["name"]; ?>&gender=<?php echo $row["gender"]; ?>&address=<?php echo $row["address"]; ?>&country=<?php echo $row["country"]; ?>&descr=<?php echo $row["descr"]; ?>&file1=<?php echo $row["file1"]; ?>&file2=<?php echo $row["file2"]; ?>&verify1=<?php echo $row["verify1"]; ?>&verify2=<?php echo $row["verify2"]; ?>&reason=<?php echo $row["reason"]; ?>&approve=<?php echo $row["approve"]; ?>"><button>Edit</button></a> <a href="database/deldat.php?form_id=<?php echo $row["form_id"]; ?>"><button onclick="if(!confirm('Are you sure you want to delete this form?')) return false;">Delete</button></td>
                                </tr>
                        <?php
                                }
                            }
                        }
                    ?>
            </table>

            <?php
                // Manage users
                if($_SESSION["role"] == "Admin"){
                
                    // Select values from database
                    $sql = "SELECT * FROM users";
                    // Place into connection
                    $result = mysqli_query($conn, $sql);
            ?>
                    <!-- Add a new user -->
                    <h1><a href='add2.php'>Add users</a></h1>
                        <!-- Show all users that the admin can manage -->
                        <table>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
            <?php
                    
                    // Get each row of object
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
            ?>
                            <tr>
                                <td><?php echo $row["name"]; ?></td>
                                <td><?php echo $row["email"]; ?></td>
                                <td><?php echo preg_replace("/./", "*", $row["password"]); ?></td>
                                <td><?php echo $row["role"]; ?></td>
                                
                                <td>
                                    <!-- Edit existing users -->
                                    <form class="hidden-form" action="edit2.php" method="post">
                                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $row["user_id"]; ?>">
                                        <input type="hidden" name="name" id="name" value="<?php echo $row["name"]; ?>">
                                        <input type="hidden" name="email" id="email" value="<?php echo $row["email"]; ?>">
                                        <input type="hidden" name="role" id="role" value="<?php echo $row["role"]; ?>">
                                        <input type="submit" value="Edit">
                                    </form>
                                    <form class="hidden-form" action="database/del2dat.php" method="post">
                                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $row["user_id"]; ?>">
                                        <input type="submit" onclick="if(!confirm('Are you sure you want to delete this user?')) return false;" value="Delete">
                                    </form>
                                </td>
                            </tr>
            <?php
                        }
                    }
            ?>
                </table>
            <?php
                    
                }
            ?>
       </section>

    </body>
</html>