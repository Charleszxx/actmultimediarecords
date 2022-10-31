<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>T-SHIRT Recorder</title>
    <link rel="stylesheet" href="index.css"/>
</head>
<body onload="realtimeClock()">
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
?>
    <div class="logo">
        <img src="logo.png">
    </div>
    <form class="form" action="submitted1.php" method="post" name="login" autocomplete="off">
        <h1 class="login-title">T-SHIRT Recorder</h1>
        <span class="error" style="color:red;">Required*</span>
        <input type="text" class="login-input" name="username" placeholder="Full Name" required/>
        <span class="error" style="color:red;">Required*</span>
        <input type="text" class="login-input" name="grade" required placeholder="Grade Level"/>
        <span class="error" style="color:red;">Required*</span>
        <input type="text" class="login-input" name="section" required placeholder="Section"/>
        <span class="error" style="color:red;">Required*</span>
        <input type="text" class="login-input" name="strand" required placeholder="Strand"/>
        <span class="error" style="color:red;">Required*</span>
        <input type="text" class="login-input" name="size" required placeholder="Size of T-Shirt? (S-XL)"/>
        <input type="submit" name="submit" value="Submit" class="login-button">      
    </form>
    <div class="clocks">
        <div id="clock"></div>
    </div><br><br>
    <section class="history" style="
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        flex-direction: column;
        background: white;
        font-size: 0.9rem;
        border-radius: 5px;">
        <h1>HISTORY</h1>
        <table border="1px" style="
                width:100%; 
                line-height:40px;">
        <thead>
            <tr>
                <th>Name</th>
                <th>Grade</th>
                <th>Section</th>
                <th>Strand</th>
                <th>Size</th>
                <th>Paid Date & Time</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while($row = mysqli_fetch_assoc($result)){?>
            <tr>
                <td><?php echo $row['username']?></td>
                <td><?php echo $row['grade']; ?></td>
                <td><?php echo $row['section']; ?></td>
                <td><?php echo $row['strand']; ?></td>
                <td><?php echo $row['size']; ?></td>
                <td><?php echo $row['create_datetime']; ?></td>
            <tr>
        <?}?>
        </tbody>
    </section>
<?php
}
?>
</body>
<script>
function realtimeClock() {

        var rtClock = new Date();

        var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
        var day = days[ rtClock.getDay() ];
        var hours = rtClock.getHours();
        var minutes = rtClock.getMinutes();
        var seconds = rtClock.getSeconds();
        var date = (rtClock.getMonth()+1)+'-'+rtClock.getDate()+'-'+rtClock.getFullYear();

        // Add AM and PM system
        var amPm = ( hours < 12 ) ? "AM" : "PM";

        // Convert to hours component to 12-hour format
        hours = (hours > 12) ? hours - 12 : hours;

        // Pad the hours, minutes and seconds with leading zeros
        hours = ("0" + hours).slice(-2);
        minutes = ("0" + minutes).slice(-2);
        seconds = ("0" + seconds).slice(-2);

        // Display the clock
        document.getElementById('clock').innerHTML = 
            hours + "  :  " + minutes + "  :  " + seconds + " " + amPm + " " + date + " " + day;
        var t = setTimeout(realtimeClock, 500); 
}
</script>
</html>