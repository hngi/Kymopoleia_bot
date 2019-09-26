<?php
$warning="";
$loggedIn="";
if(count($_POST)>0) {
    $info = json_decode(file_get_contents("info.json"));
    $email = $_POST["email"];
    
    $password = $_POST["password"];
    //$confirmpassword = $_POST["confirmpassword"];


    
    if(in_array($email ,array_column($info, 'email')) && in_array($password, array_column($info, "password"))){
        //$warning = "This email has been registered";
        // $name = $info->name;
        $loggedIn = "Log in successful";
        session_start();
        $_SESSION["user_login"] = "You";
        header("Location: index.php");
    }else{
        $warning = "Email or password incorrect";
    }
}
    
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>KymopoleiaBot | Log In</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='style.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

</head>

<body>
        <center><header class="header-signup">
        <section class="navigation">
            <div class="logo"> <i class="fa fa-robot" style="color: white"></i> <span class="logocolor">Kymopoleia</span>Bot</div>
            <!-- <div id="nav-div" class="nav-div">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="#">Features</a></li>
                    <li><a href="#">Guides</a></li>
                    <li><a href="signup.html"><span class="loginbutton">Sign Up</span></a></li>
                    <a href="javascript:void(0);" class="nav-icon" onclick="myFunction()">
                        <img src="img/mdi_menu.png" alt="">
                    </a>
                </ul>
            </div> -->
       
        </section>
    </header>      
    </center>
    <div class="container">
        <center><div class="main">
            <div class="content">
            
                <h1>Log In </h1>
                
                <form id="form" action="" method="POST">
                    <div class="message"><?php if($warning!="") { echo $warning; } ?></div>   
                    <label>Email</label><br>
                    <input type="email" id="email" name="email"  placeholder="example@xyz.com" required><span id="Evalid"></span><br><br>
                   
                    <label>Password</label><br>
                    <input type="password" name="password" id="password" placeholder="Minimum of 8 Characters" required><br><br>
                    
                    <button id="submit" type="submit">Log In</button><br><br>
                    <span>Don't have an account? Sign Up <a href="signup.html"><span class="here">here</span></a>.</span><br><br>
                    <span class="terms"><a href="">Terms & Conditions</a> and <a href=""> Privacy Policy</a></span>
                </form>           
            </div>
            
            <footer>
                <b>&copy; 2019 Kymopoleia </b>
            </footer>
        </div></center> 
    </div>
    <!-- <script src="script.js"></script> -->



</body>

</html>