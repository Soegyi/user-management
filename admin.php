<!DOCTYPE html>
<?php 

session_start();
$role = $_SESSION["role"];
if (!isset($_SESSION["username"]) or ($role != "Admin")){
    header("location:login.php");
}
include("./connection.php");
include "user.php";
/* Validate Input */
function validate_input($data) {
  $data =  trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


$ermail=$errpass=$succ="";

if (isset($_POST["create"])){
    $user = validate_input($_POST["username"]);
    $password = validate_input($_POST["password"]);
    $email  = validate_input($_POST["email"]);
    $role = "user";
    
    if(strlen($password) < 5){
        $errpass = "password must be at least 5 character";
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $ermail = "Invalid email format";
    }
    else {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $usr = new user($con);
     $use =  $usr->registerUser($user, $password, $email, $role);
         if ($use){
             $succ = "Account Created Successfully !";
         }
        
    }
}


?>
<html>
    <head>
        <?php include './head.php'; ?>
        <title>Admin Panel</title>
    </head>
    <body>
    <nav class="navbar navbar-inverse navbar-fixed-top ">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                       Ayawaddy Online</a>
                </div>
                    <ul class="nav navbar-nav navbar-right">
                        <li> <span class="navbar-text">Welcome!</span></li>
                        <li class="active"><a href="#"><span class="glyphicon glyphicon-user">&nbsp; </span><?php echo "Admin" ?></a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out">&#32;</span>&#32;&#32;Logout</a></li>
                    </ul>
            </div>
    </nav>
        <br/><br/><br/><br/>
    <h2 class="text-center text-primary">Admin Control Panel</h2>
    <div class="container-fluid bg-grey">
        <div class="row">
                <div class="col-lg-2">
                    <ul class="nav nav-pills nav-stacked text-center">
                        <li class="active"><a href="admin.php">Create Accounts</a></li>
                        <li><a href="manage.php">Manage Account</a></li>

                    </ul>
                </div>
            <div class="col-lg-10">
            <div class="container-fluid">
            <h2 class=" col-lg-6 col-lg-offset-2 white text-center">Create New Accounts</h2>
            <div class="row">
                <div class="col-lg-5 col-lg-offset-3 col-xs-6 col-xs-offset-3">
                    
                    <form class="form-horizontal" method="POST" action="admin.php">
                        
                        <div class="">
                            <h3><span class="label label-success"><?php echo $succ ;?></span></h3>
                        </div>
                        
                        <div class="form-group">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
                                        <input type="text" class="form-control" id="inputEmail3" placeholder="username" name="username" required="">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <span class="label-danger white"></span>    
                                </div>          
                            </div>
                        </div>
                        </div>
                        <div class="form-group">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
                                        <input type="password" class="form-control"  placeholder="password" name="password" required="">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                <span class="label label-danger white"><?php echo $errpass; ?></span>    
                                </div>          
                            </div>
                        </div>
                        </div>
                        <div class="form-group">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-envelope"></span></span>
                                        <input type="email" class="form-control" id="inputEmail3" placeholder="email" name="email" required="">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                <span class="label label-danger white"><?php echo $ermail;?></span>    
                                </div>          
                            </div>
                        </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <button type="submit" name="create"  class="btn btn-success btn-lg btn-block">Create</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>   
                
            </div>

                    

                    

                </div>
            </div>

        
        
        
        
    </body>
</html>
