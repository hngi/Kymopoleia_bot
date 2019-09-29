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
        header("Location: success.php");
    }else{
        $warning = "Email or password incorrect";
    }
}    
?>

<!DOCTYPE html>
<html>

<head>
    <title>KymopoleiaBot | Sign Up</title>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>    
    <meta name='viewport' content='width=device-width, initial-scale=1'>           
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel='stylesheet' href='style.css'>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> 
    <script src="https://kit.fontawesome.com/833e0cadb7.js" crossorigin="anonymous"></script>        
</head>

<body>
    <header class="header-signup">
        <nav class="navbar navbar-expand-lg navbar-light justify-content-right">                                
            <ul class="navbar-nav navbar-brand">
                <li class="nav-item active">
                    <i class="fa fa-robot logo" style="color: white"></i> <span class="logocolor">Kymopoleia</span><span style="color: white">Bot</span>
                </li>                        
            </ul>
                                    
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" 
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbarNavDropdown" class="navbar-collapse collapse">
                
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" style="color: white" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: white" href="signup.php"><span class="loginbutton">Sign Up </span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header> 

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
                    <span>Don't have an account? Sign Up <a href="signup.php"><span class="here">here</span></a>.</span><br><br>
                    <span class="terms"><a href="">Terms & Conditions</a> and <a href=""> Privacy Policy</a></span>
                </form>           
            </div>
            
            <footer>
                <b>&copy; 2019 Kymopoleia </b>
            </footer>
        </div></center> 
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>