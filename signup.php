<?php
$warning="";
if(count($_POST)>0) {
    $info = json_decode(file_get_contents("info.json"));
    
    $email = $_POST["email"];
    $name = $_POST["name"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    
    if(in_array($email ,array_column($info, 'email'))){
        $warning = "This email has been registered";
    }else if (empty($email) || empty($name)  || empty($password)  || empty($confirmpassword)){
        $warning = "No field should be empty";
    }else{
        if($_POST["password"] === $_POST["confirmpassword"]){
            array_push($info, [
                "email" => $email,
                "password" => $password,
                "name" => $name
            ]);

            file_put_contents('info.json', json_encode($info));
            session_start();
            $_SESSION['user_login'] = $name;
            header("Location: success.php");
        }else{
            $warning = "Password mismatch";
        }
    }
    
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>KymopoleiaBot | Sign Up</title>
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
                    <li><a href="login.html"><span class="loginbutton">LogIn </span></a></li>
                    <a href="javascript:void(0);" class="nav-icon" onclick="myFunction()">
                        <img src="img/mdi_menu.png" alt="">
                    </a>
                </ul> 
            </div>-->
       
        </section>
    </header>
    </center>      

    <div class="container">
        <center><div class="main">
            <div class="content">
            
                <h1>Sign Up </h1>
                
                <form id="form" action="" method="POST">
                    <div class="message"><?php if($warning!="") { echo $warning; } ?></div>
                    <label>Full Names</label><br>
                    <input type="text" id="username" name="name"  placeholder="Firstname Lastname " required><span id="Evalid"></span><br><br>
                    
                    <label>Email</label><br>
                    <input type="email" id="email" name="email"  placeholder="example@xyz.com" required><span id="Evalid"></span><br><br>
                   
                    <label>Password</label><br>
                    <input type="password" name="password" id="password" placeholder="Minimum of 8 Characters" required><br><br>
                    
                   <label>Confirm Password</label><br>
                    <input type="password" name="confirmpassword" id="password2" placeholder="Retype Password" required onkeyup='checkPassword();'>
                    <span id="message"></span><br><br>
                    
                    <input id="submit" type="submit">Sign Up</button><br><br>
                    <span>Already have an account? Log In <a href="login.html"><span class="here">here</span></a>.</span><br><br>
                    <span class="terms">By clicking the Sign Up button, you agree to our</span><br>
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