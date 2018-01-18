<!DOCTYPE html>
<?php

include("./connection.php"); 
include "./user.php";

/* Validate Input */
function validate_input($data) {
  $data =  trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

  $usr = new user($con);
  $error="";
  
if(isset($_POST["login"])){
    
    $user = validate_input($_POST["username"]);
    $password = validate_input($_POST["password"]);
    
    $result = $usr->getUserInfo($user);
    
    $hash = $result["password"];
    if(password_verify($password, $hash)){
        
        $role = $result["role"];
        if($role == "Admin"){
            session_start();
            $_SESSION["username"] = $user;
            $_SESSION["role"]  = $role;
            header("location:admin.php");
        }
       else {
            session_start();
            $_SESSION["username"] = $user;
            $_SESSION["role"] = $role;
            header("location:userhome.php");
       }
    }
    else {
        $error = "Invalid Username or Password";
    }
    
}

?>
<html>
    <head>
        <?php include "./head.php"; ?>
        <title>Login</title>
    </head>
    <body>
    <div class="container-fluid navbar navbar-inverse"> <!-- Nav-bar top -->
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    Ayawaddy Online</a>
            </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                </ul>
    </div>
        <div class="container-fluid">
            <h1 class="white text-center">Login to Your Account</h1>
            <div class="row">
                <div class="col-lg-5 col-lg-offset-4 col-xs-6 col-xs-offset-3">

                    <form class="form-horizontal" method="POST" action="login.php">
                        <div class="">
                            <h3><span class="label label-danger"><?php echo $error ;?></span></h3>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
                                <input type="text" class="form-control" id="inputEmail3" placeholder="username" name="username" required="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="password" class="form-control"  placeholder="password" name="password" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="login"  class="btn btn-success btn-lg btn-block">Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
