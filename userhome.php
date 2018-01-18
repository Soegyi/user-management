<!DOCTYPE html>
<?php 

session_start();
if(!isset($_SESSION["username"]) or ($_SESSION["role"] != "user")){
    header("location:login.php");
}

?>

<html>
    <head>
        <?php include './head.php'; ?>
        <title>User Home Page</title>
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
                        <li class="active"><a href="#"><span class="glyphicon glyphicon-user">&nbsp; </span><?php echo ucfirst($_SESSION["username"]); ?></a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out">&#32;</span>&#32;&#32;Logout</a></li>
                    </ul>
            </div>
    </nav>
        <br/><br/><br/><br/>
        <h1 class=" text-center text-info"> Welcome to the User Home Page</h1>
    </body>
</html>
