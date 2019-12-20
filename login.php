<!DOCTYPE html>
<?php
    // Check whether the session has started
    if(session_id() == '' || !isset($_SESSION)){session_start();}
    if(isset($_SESSION["user_id"])){
        header("location:index.php");
    }

  // Include configuration file to access MySQL
  require("database/config.php");
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
            <!-- Filling in the form -->
            <form action="database/logdat.php" method="post">
                <!-- Register of the form -->
                <fieldset>
                    <legend>Login</legend>

                    <p class="manager">* Required fields</p>

                    <p>
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
                    </p>
                    
                </fieldset>
    
                <p><input type="submit" class="button" value="Login"> <input type="reset" class="button"></p>
            </form>

            <p>Haven't made an account? <a href="register.php">Click here to register</a></p>
       </section>

    </body>
</html>