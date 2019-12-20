<!DOCTYPE html>
<?php
    include('database/config.php');

    if(session_id() == '' || !isset($_SESSION)){session_start();}

    if(!isset($_SESSION["user_id"])) {
        header("location:login.php");
    }

    // Get values from previous page
    $form_id = $_GET["form_id"];
    $name = $_GET["name"];
    $gender = $_GET["gender"];
    $address = $_GET["address"];
    $country = $_GET["country"];
    $descr = $_GET["descr"];
    $file1 = $_GET["file1"];
    $file2 = $_GET["file2"];
    $verify1 = $_GET["verify1"];
    $verify2 = $_GET["verify2"];
    $reason = $_GET["reason"];
    $approve = $_GET["approve"];
       
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
            <form action="database/editdat.php" method="post" enctype="multipart/form-data" autocomplete="off">
                <!-- Section A of the form -->
                <fieldset>
                    <legend>Section A</legend>

                    <p>
                        <!-- Name of user -->
                        <label for="name">Name: </label>
                        <input type="text" name="name" id="name" maxlength="225" <?php echo "value='$name'"; if($_SESSION["role"] == "Manager") echo "disabled"; ?> required>
                        <span class="manager">*</span>
        
                        <!-- Gender of user -->
                        <label for="">Gender:</label>
                        <label for="gender_male"><input type="radio" name="gender" id="gender_male" value="M" <?php if($gender == "M") echo "checked"; ?> <?php if($_SESSION["role"] == "Manager") echo "disabled"; ?> required>M</label>
                        <label for="gender_female"><input type="radio" name="gender" id="gender_female" value="F" <?php if($gender == "F") echo "checked"; ?> <?php if($_SESSION["role"] == "Manager") echo "disabled"; ?> required>F</label>
                        <span class="manager">*</span>
                    </p>
    
                    <p>
                        <!-- Address of user -->
                        <label for="address">Address:</label>
                        <textarea name="address" id="address" cols="30" rows="" maxlength="225" <?php if($_SESSION["role"] == "Manager") echo "disabled"; ?> required><?php echo $address; ?></textarea>
                        <span class="manager">*</span>
    
                        <!-- Country of user -->
                        <label for="country">Country: </label>
                        <select name="country" id="country" <?php if($_SESSION["role"] == "Manager") echo "disabled"; ?> required>
                            <option value="Malaysia" <?php if($country == "Malaysia") echo "selected"; ?>>Malaysia</option>
                            <option value="Singapore" <?php if($country == "Singapore") echo "selected"; ?>>Singapore</option>
                            <option value="Indonesia" <?php if($country == "Indonesia") echo "selected"; ?>>Indonesia</option>
                            <option value="Brunei Darussalam" <?php if($country == "Brunei Darussalam") echo "selected"; ?>>Brunei Darussalam</option>
                        </select>
                        <span class="manager">*</span>
                    </p>
                    
                </fieldset>
    
                <!-- Section B of the form -->
                <fieldset>
                    <legend>Section B</legend>
    
                    <!-- Employee Section -->
                    <div class="file">
                        <!-- Select files of user -->
                        <p>
                            <label for="file1">File 1:</label>
                            <a class="file" <?php echo "href='files/". $file1 ."'"; ?> target="_blank"><?php echo "$file1"; ?></a>
                            <input type="file" name="file1" id="file1" maxlength="225" <?php if($_SESSION["role"] == "Manager") echo "disabled"; ?> required>
                            <span class="manager">*</span>
                        </p>
    
                        <p>
                            <label for="file2">File 2:</label>
                            <a class="file" <?php echo "href='files/". $file2 ."'"; ?> target="_blank"><?php echo "$file2"; ?></a>
                            <input type="file" name="file2" id="file2" maxlength="225" <?php if($_SESSION["role"] == "Manager") echo "disabled"; ?> required>
                            <span class="manager">*</span>
                        </p>
                        
                    </div>
    
                    <!-- Manager section -->
                    <div class="mansec">
                        <!-- Verify the files -->
                        <p>
                            <label for="verify1">Verified: </label>
                            <input type="checkbox" name="verify1" id="verify1" value="Verified" <?php if($_SESSION["role"] == "Employee") echo "disabled";?> <?php if($verify1 == 1) echo "checked"; ?> >
                        </p>
                        
                        <p>
                            <label for="verify2">Verified: </label>
                            <input type="checkbox" name="verify2" id="verify2" value="Verified" <?php if($_SESSION["role"] == "Employee") echo "disabled"; ?> <?php if($verify2 == 1) echo "checked"; ?>>
                        </p>
                        
                        <p class="manager">For office use only</p>
                    </div>
    
                </fieldset>
    
                <!-- Section C of the form -->
                <fieldset>
                        <legend>Section C</legend>
        
                        <!-- Select files of user -->
                        <label for="descr">Description:</label>
                        <textarea name="descr" id="descr" cols="30" rows="" maxlength="225" <?php if($_SESSION["role"] == "Manager") echo "disabled"; ?> required><?php echo $descr; ?></textarea>
                        <span class="manager">*</span>
    
                </fieldset>
    
                <!-- Section D of the form -->
                <fieldset <?php if($_SESSION["role"] == "Employee") echo "disabled"; ?>>
                        <legend>Section D</legend>
                        
                        <p>
                            <!-- Reason for approval -->
                            <label for="reason">Reason:</label>
                            <textarea name="reason" id="reason" cols="30" rows="" maxlength="225"><?php echo $reason; ?></textarea>
                        </p>
    
                        <p>
                            <!-- Choose approve or not approve -->
                            <label for="approve">Approved: </label>
                            <input type="checkbox" name="approve" id="approve" value="Approved" <?php if($approve == "Approved") echo "checked"; ?> >
                            
                            <label for="not-approve">Not Approved: </label>
                            <input type="checkbox" name="approve" id="not-approve" value="Not approved" <?php if($approve == "Not approved") echo "checked"; ?>>
                        </p>

                        <p class="manager">For office use only</p>
                </fieldset>

                <input type="hidden" name="form_id" <?php echo "value=". $form_id . ""; ?>>
    
                <p><input type="submit" class="button"> <input type="reset" class="button"></p>
            </form>
        </section>
        
        <!-- Add and use JQuery for checkbox adjustments -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="js/checkbox.js"></script>
    </body>
</html>