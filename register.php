<?php
    // Check whether the session has started
    if(session_id() == '' || !isset($_SESSION)){session_start();}
    if(isset($_SESSION["user_id"])){
        header("location:index.php");
    }

  // Include configuration file to access MySQL
  require("database/config.php");
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
            <form action="database/regdat.php" method="post">
                <!-- Register of the form -->
                <fieldset>
                    <legend>Register</legend>

                    <p class="manager">* Required fields</p>

                    <p>
                        <!-- Name of user -->
                        <label for="name">Name: </label>
                        <input type="text" name="name" id="name" maxlength="225" required>
                        <span class="manager">*</span>
        
                        <!-- Email of user -->
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" maxlength="225" required>
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
                        <option value="Employee">Employee</option>
                        <option value="Manager">Manager</option>
                        <option value="Admin">Admin</option>
                        </select>
                        <span class="manager">*</span>
                    </p>
                    
                </fieldset>
    
                <p><input type="submit" class="button" value="Register"> <input type="reset" class="button"></p>
            </form>

            <p>Already made an account? <a href="login.php">Click here to login</a></p>
       </section>

    </body>
</html>