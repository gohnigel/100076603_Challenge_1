<?php
    include('database/config.php');

    if(session_id() == '' || !isset($_SESSION)){session_start();}

    if(!isset($_SESSION["user_id"])) {
        header("location:login.php");
    }

    // Get values from previous page
    $user_id = $_POST["user_id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $role = $_POST["role"];
?>
<!DOCTYPE html>
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
            <!-- Filling in the form -->
            <form action="database/edit2dat.php" method="post">
                <!-- Register of the form -->
                <fieldset>
                    <legend>Edit new users</legend>

                    <p class="manager">* Required fields</p>

                    <p>
                        <!-- Name of user -->
                        <label for="name">Name: </label>
                        <input type="text" name="name" id="name" maxlength="225" <?php echo "value='". $name ."'"; ?> required>
                        <span class="manager">*</span>
        
                        <!-- Email of user -->
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" maxlength="225" <?php echo "value='". $email ."'"; ?> required>
                        <span class="manager">*</span>
                    </p>

                    <p>
                        <!-- Password of user -->
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" minlength="6" maxlength="225" required>
                        <span class="manager">*</span>

                        <!-- Role of user -->
                        <label for="role">Role of user: </label>
                        <select name="role" id="role">
                        <option value="Employee" <?php if($role == "Employee") echo "selected"; ?>>Employee</option>
                        <option value="Manager" <?php if($role == "Manager") echo "selected"; ?>>Manager</option>
                        <option value="Admin" <?php if($role == "Admin") echo "selected"; ?>>Admin</option>
                        </select>
                        <span class="manager">*</span>
                    </p>

                    <input type="hidden" name="user_id" <?php echo "value=". $user_id . ""; ?>>
                    
                </fieldset>
    
                <p><input type="submit" class="button" value="Edit"> <input type="reset" class="button"></p>
            </form>
       </section>

    </body>
</html>