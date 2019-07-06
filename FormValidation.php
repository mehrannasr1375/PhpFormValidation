<!DOCTYPE HTML>  
<html>
<head>
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/font-awesome.min.css">
    <!--<link rel="stylesheet" href="styles/rtl.css">-->
    <style>
        .error {
            display: block;
            color: #d37a7a;
            padding: 8px 12px;
            font-weight: 700;
            line-height: .8;
        }
    </style>
</head>
<body>  



<?php


    // define variables and set to empty values
    $name = $email = $gender = $comment = $job = "";

    $errors = [
            "name" => "",
            "email" => "",
            "gender" => "",
            "job" => "",
            "comment" => ""
    ];


    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        /* name */
        if (empty($_POST["name"]))
            $errors['name'] = "Name is required";
        else {
            $name = test_input($_POST["name"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$name))
                $errors['name'] = "Only letters and white space allowed";
        }

        /* email */
        if (empty($_POST["email"]))
            $errors['email'] = "Email is required";
        else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                $errors['email'] = "Invalid email format";
        }

        /* job */
        if (empty($_POST["job"]))
            $errors['job'] = "Job is required";
        else
            $job = test_input($_POST["job"]);

        /* comment */
        if (empty($_POST["comment"]))
            $errors['comment'] = "Comment is required";
        else
            $comment = test_input($_POST["comment"]);

        /* gender */
        if (empty($_POST["gender"]))
            $errors['gender'] = "Gender is required";
        else
            $gender = test_input($_POST["gender"]);

        /* Show Last Data */
        echo "<p class='p-3 bg-info''>name: " . $name . "<br>email: " . $email . "<br> job: " . $job . "<br> comment: " . $comment . "<br> gender: " . $gender . "</p>";


        /* Insert to DB if there is no errors */
        $is_empty = true;
        foreach ($errors as $key => $value)
            if ($value != '')
                $is_empty = false;
        if ($is_empty)
            saveToDb( $name, $email, $gender, $comment, $job );
        else
            echo "<p class='bg-danger text-light p-2'>Data is Wrong!</p>";


    }


    function saveToDb( $name, $email, $gender, $comment, $job ) {
        echo "<p class='bg-success text-light p-2'>Data has been saved successfuly!</p>";
    }


	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
    }


    function showErrorIfExists($err_var) {
        global $errors;
        if ($errors[$err_var] != '')
            echo
                "<div class='error'>".
                        $errors[$err_var].
                "</div>";
    }


?>


    <!-- Form -->
    <div class="container py-5">
        <h3 class="mb-4">Php Form Validation Example:</h3>
        <form method="post">
            <div class="row">

                <!-- name -->
                <div class="form-group col-12 col-lg-6">
                    <label for="name">Name:</label>
                    <div>
                        <input type="text" class="form-control" name="name" id="name" value="<?=$name;?>">
                        <?php showErrorIfExists('name'); ?>
                    </div>
                </div>

                <!-- email -->
                <div class="form-group col-12 col-lg-6">
                    <label for="email">Email:</label>
                    <div>
                        <input type="text" class="form-control" name="email" id="email" value="<?=$email;?>">
                        <?php showErrorIfExists('email'); ?>
                    </div>
                </div>
            </div>

            <!-- job -->  
            <div class="form-group">
                <label for="email">Job:</label>
                    <select name="job" id="job" class="form-control">
                        <option value="Employee">Employee</option>
                        <option value="Student">Student</option>
                        <option value="Engeenier">Engeenier</option>
                        <option value="Other">Other</option>
                    </select>
                    <?php showErrorIfExists('job'); ?>
            </div>

            <!-- comment --> 
            <div class="form-group">
                <label for="email">Comment:</label>
                <div>
                    <textarea name="comment" class="form-control" id="comment" rows="5" cols="40"><?=$comment;?></textarea>
                    <?php showErrorIfExists('comment'); ?>
                </div>
            </div> 

            <!-- gender -->
            <div class="py-3">
                <div class="form-group row">
                    <label for="email" class="col-2">Gender:</label>
                    <div class="custom-control custom-radio col-2 col-lg-1">
                        <input type="radio" class="custom-control-input" id="male" name="gender" value="male" <?php if (isset($gender) && $gender=="male") echo "checked";?> >
                        <label class="custom-control-label" for="male">male</label>
                    </div>
                    <div class="custom-control custom-radio col-2 col-lg-1">
                        <input type="radio" class="custom-control-input" id="female" name="gender" value="female" <?php if (isset($gender) && $gender=="female") echo "checked";?> >
                        <label class="custom-control-label" for="female">female</label>
                    </div>
                    <?php showErrorIfExists('gender'); ?>
                </div>
            </div>

            <input type="submit" class="btn btn-success" name="submit" value="Submit">
        </form>
    </div>



    <!-- scripts -->
    <script src="scripts/jquery-3.3.1.js"></script>
    <script src="scripts/popper.min.js"></script>
    <script src="scripts/bootstrap.min.js"></script>
</body>
</html>
