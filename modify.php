<!DOCTYPE html>
<?php 


include 'user.php';
include "./connection.php";
/* Validate Input */
function validate_input($data) {
  $data =  trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


    $uname = $_GET["username"];
    $usr = new user($con);
    $result = $usr->getUserInfo($uname);

    $ermail=$errpass="";
    if(isset($_POST["update"])){
        
        $usid = $result["userid"];
        $password = validate_input($_POST["password"]);
        $newmail = validate_input($_POST["email"]);
        
        if(strlen($password) < 5){
            $errpass = "password must be atleast 5 character";
        }
        else if (!filter_var($newmail, FILTER_VALIDATE_EMAIL)){
            $ermail = "Invalid email format";
        }
        else {
             
            $password = password_hash($password, PASSWORD_BCRYPT);
            $result = $usr->updateUser($password, $newmail, $usid);
            if($result){
                header("location:manage.php");
            }
        }
        
    }
  

?>
<html>
    <head>
        <?php include'./head.php' ?>
        <title>Modify Account</title>
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
                        <li><a href="admin.php">Create Accounts</a></li>
                        <li class="active"><a href="manage.php">Manage Account</a></li>

                    </ul>
                </div>
            <div class="col-lg-10">
            <div class="container-fluid">
            <h2 class=" col-lg-6 col-lg-offset-2 white text-center">Modify Account</h2>
            <div class="row">
                <div class="col-lg-5 col-lg-offset-3 col-xs-6 col-xs-offset-3">
                    
                    <form class="form-horizontal" method="POST" action="">
                        
                        <div class="form-group">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
                                        <input type="text" class="form-control" value="<?php echo $result["username"]; ?>" name="username" disabled="">
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
                                        <input type="password" class="form-control"  placeholder="enter new password" name="password" required="">
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
                                        <input type="email" class="form-control" value="<?php echo $result["email"]; ?>"  name="email" required="">
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
                                        <button type="submit" name="update"  class="btn btn-success btn-lg btn-block">Update</button>
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
