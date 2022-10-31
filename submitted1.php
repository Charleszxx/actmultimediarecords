<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="submitted.css">
	<title></title>
</head>
<body>
<?php 
    /*$host = "fdb29.awardspace.net";
    $userName = "4170741_sinking";
    $userPass = "actsinking123";
    $database = "4170741_sinking";*/
    $host = "localhost";
    $userName = "root";
    $userPass = "";
    $database = "sinking";

    $connectQuery = mysqli_connect($host,$userName,$userPass,$database);

    if(mysqli_connect_errno()){
        echo mysqli_connect_error();
        exit();
    }else{
        $selectQuery = "SELECT * FROM `tshirt` ORDER BY id, username, grade, section, strand, size, create_datetime ASC";
        $result = mysqli_query($connectQuery,$selectQuery);
        if(mysqli_num_rows($result) > 0){
        }else{
            $msg = "No Record found";
        }
    }
    date_default_timezone_set('Asia/Manila');
    require('db.php');
    if (isset($_REQUEST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);
        $grade    = stripslashes($_REQUEST['grade']);
        $grade    = mysqli_real_escape_string($con, $grade);
        $section    = stripslashes($_REQUEST['section']);
        $section    = mysqli_real_escape_string($con, $section);
        $strand    = stripslashes($_REQUEST['strand']);
        $strand    = mysqli_real_escape_string($con, $strand);
        $size    = stripslashes($_REQUEST['size']);
        $size    = mysqli_real_escape_string($con, $size);
        $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into `tshirt` (username, grade, section, strand, size, create_datetime)
                     VALUES ('$username', '$grade', '$section', '$strand', '$size', '$create_datetime')";
        $result   = mysqli_query($con, $query);
    }
    if ($result) {
        echo "<div class='form'>
            <h3>You submitted successfully.</h3><br/>
            <p class='link'>Click here to <a href='tshirt.php'>close.</a></p>
            </div>";
        } else {
        echo "<div class='form'>
            <h3>Required fields are missing.</h3><br/>
            <p class='link'>Click here to <a href='index.php'>fill up</a> again.</p>
            </div>";
    }
?>    
</body>
</html>
