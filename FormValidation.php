<!DOCTYPE HTML>  
<html>
<head>
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/font-awesome.min.css">
    <!--<link rel="stylesheet" href="styles/rtl.css">-->
    <style>
        .error {
            color: #FF0000;
            padding: 8px;
        }
    </style>
</head>
<body>  


<?php



    // define variables and set to empty values
    $nameErr = $emailErr = $genderErr = $websiteErr 
        = $name = $email = $gender = $comment = $website = "";




    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {


        /* name */
        if (empty($_POST["name"]))
            $nameErr = "Name is required";
        else {
            $name = test_input($_POST["name"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$name))
                $nameErr = "Only letters and white space allowed"; 
        }
    

        /* email */
        if (empty($_POST["email"]))
            $emailErr = "Email is required";
        else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                $emailErr = "Invalid email format";  
        }
            

        /* website */
        if (empty($_POST["website"]))
            $website = "";
        else {
            $website = test_input($_POST["website"]);
            if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website))
                $websiteErr = "Invalid URL"; 
        }


        /* comment */
        if (empty($_POST["comment"]))
            $comment = "";
        else 
            $comment = test_input($_POST["comment"]);
        


        /* gender */
        if (empty($_POST["gender"]))
            $genderErr = "Gender is required";
        else
            $gender = test_input($_POST["gender"]);
    
    }





	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
    }
    

?>



    <div class="container py-5">
    <h2 class="mb-4">PHP Form Validation Example</h2>


        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
            
            
            
            <!-- name -->    
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" id="name" value="<?=$name;?>">
                <span class="error"> * 
                    <?=$nameErr;?>
                </span>
            </div>


            <!-- email -->  
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="text" class="form-control" name="email" id="email" value="<?=$email;?>">
                <span class="error"> * 
                    <?=$emailErr;?>
                </span>
            </div>


            <!-- website -->  
            <div class="form-group">
                <label for="email">Website:</label>
                <input type="text" class="form-control" name="website" id="website" value="<?=$website;?>">
                <span class="error">
                    <?=$websiteErr;?>
                </span>
            </div>

            
            <!-- comment --> 
            <div class="form-group">
                <label for="email">comment:</label>
                <textarea name="comment" class="form-control" id="comment" rows="5" cols="40">
                    <?=$comment;?>
                </textarea>
            </div> 


            
            <!-- comment --> 
            <div class="form-group">
                <label for="email">gender:</label>

                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="male" name="gender" value="male" <?php if (isset($gender) && $gender=="male") echo "checked";?> >
                    <label class="custom-control-label" for="male">male</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="female" name="gender" value="female" <?php if (isset($gender) && $gender=="female") echo "checked";?> >
                    <label class="custom-control-label" for="female">female</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="other" name="gender" value="other" <?php if (isset($gender) && $gender=="other") echo "checked";?> >
                    <label class="custom-control-label" for="other">other</label>
                </div>

 
                <span class="error">* 
                    <?=$genderErr;?>
                </span>
            </div> 
            



            <input type="submit" class="btn btn-success" name="submit" value="Submit"> 

        </form>


        <h2>
            <?php
                echo $name . "<br>";
                echo $email . "<br>";
                echo $website . "<br>";
                echo $comment . "<br>";
                echo $gender;
            ?>
        </h2>
    </div>




    <!-- scripts -->
    <script src="scripts/jquery-3.3.1.js"></script>
    <script src="scripts/popper.min.js"></script>
    <script src="scripts/bootstrap.min.js"></script>
</body>
</html>
