<?php
    require_once '../load.php';

    $ip = $_SERVER['REMOTE_ADDR'];
    
// attempt for login and lockout code

    //  $date = $_SERVER['REQUEST_TIME_FLOAT'];

//     if (empty($_SESSION['failed_login'])) 
// {
//     $_SESSION['failed_login'] = 1;
// } 
// elseif (isset($_POST['submit'])) 
// {
//     $_SESSION['failed_login']++;
// }


// // if login fail 3 times
// if ($_SESSION['failed_login'] > 3) {
// 	$message = 'U failed to login 3 times ' .$_SESSION['failed_login'];
// }

// session_start();
    

	// if (isset($_POST["username"]) && isset($_POST["password"]))
	// {
	// 	// This checks if the value has ever been set, if not, declares it as zero.
	// 	if (!isset($_SESSION["attempts"]))
	// 		$_SESSION["attempts"] = 0;
			
	// 	if ($_SESSION["attempts"] < 3)
	// 	{
	// 		$username = $_POST["username"];
	// 		$password = $_POST["password"];
			
	// 		if ($username = "test" && $password == "test")
	// 		{
	// 			echo "Hello, you are logged in.";
	// 		}
	// 		else
	// 		{
	// 			echo "You failed to log-in, try again";
	// 			$_SESSION["attempts"] = $_SESSION["attempts"] + 1;
	// 		}
			
	// 	}
	// 	else
	// 	{
	// 		echo "You've failed too many times, dude.";
	// 	}
	// }


    if(isset($_POST['submit'])){



        if (!isset($_SESSION["attempts"]))
			$_SESSION["attempts"] = 0;
			
		if ($_SESSION["attempts"] < 3)
		{
			$username = $_POST["username"];
			$password = $_POST["password"];
			
			if(!empty($username) && !empty($password))
			{
				$message = login($username, $password, $ip);
			}
			else
			{
                $message = 'Please fill out the required field';
				$_SESSION["attempts"] = $_SESSION["attempts"] + 1;
			}
			
		}
		else
		{
			$message= "You've failed too many times, dude.";
		}



        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        //! means not
        if(!empty($username) && !empty($password)){
            //log user in
            $message = login($username, $password, $ip);
        }else{
            $message = 'Please fill out the required field';
        }
    }

        /* This sets the $time variable to the current hour in the 24 hour clock format */
        $time = date("H");
        /* Set the $timezone variable to become the current timezone */
        $timezone = date("e");
        /* If the time is less than 1200 hours, show good morning */
        if ($time < "12") {
            echo "Good morning";
        } else
        /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
        if ($time >= "12" && $time < "17") {
            echo "Good afternoon";
        } else
        /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
        if ($time >= "17" && $time < "19") {
            echo "Good evening";
        } else
        /* Finally, show good night if the time is greater than or equal to 1900 hours */
        if ($time >= "19") {
            echo "Good night";
        }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
</head>
<body>
    <h2>Login Page</h2>
    <?php echo !empty($message)? $message: ''; ?>
    <!-- post foes not reveal information on the site, and get does-->
    <form action="admin_login.php" method="post">
        <label for="">Username:</label>
        <input type="text" name="username" id="username" value="">

        <label for="">Password</label>
        <input type="password" name="password" id="password" value="">

        <button name="submit">Submit</button>
    </form>
</body>
</html>