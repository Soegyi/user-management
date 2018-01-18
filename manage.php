<!DOCTYPE html>
<?php   
include './user.php';
include './connection.php';

$usr = new user($con);

$delmes="";
if(isset($_POST["del"])){
    $delusr = key($_POST["del"]);
    
    $del = $usr->deleteUser($delusr);
    if($del){
        $delmes = "The account with userid - ".$delusr." has been deleted";
    }
}
$result = $usr->getAllUser();

?>
<html>
    <head>
        <?php include './head.php'; ?>
        <title>Manage Account</title>
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
                    <li ><a href="admin.php">Create Accounts</a></li>
                    <li class="active"><a href="manage.php">Manage Account</a></li>

                </ul>
            </div>
            <div class="col-lg-10">
            <h2 class=" col-lg-6 col-lg-offset-2 white text-center">Modify or Delete Accounts</h2>
            <form class="form-horizontal col-lg-10" method="POST" action="manage.php">
                <h3><span class="label label-danger"><?php echo $delmes; ?></span></h3>
                                <table class="table table-condensed"> 
                                    <thead> 
                                        <tr style="background-color: captiontext"> 
                                            <th>UserId</th> 
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Modify</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
 <?php
                                     $total = 0;
    foreach ($result as $user) {
        $uname = $user["username"];
        $uid = $user["userid"];
        $email = $user["email"];
        echo '<tr>'
        . '<td>' . $uid . '</td>'
        . '<td>' . $uname . '</td>'
        . '<td>' . $email . '</td>'
        . '<td>'
        . '<input type="submit" class="btn btn-danger" value="Delete" onclick="return confirm(\'Do you really want to delete this account!!?\');" name="del[' . $uid . ']">'
        . '</td>'
        . '<td>'
        . '<a role="button" class="btn btn-primary" href="modify.php?username=' . $uname . '">Modify</a>'
        . '</td>'
        . '</tr>';
        $total++;
    }
                                    
?>
                                    </tbody>

                                </table>
                            </form>
            <h3 class="col-lg-9">There are <span class="label label-default"><?php echo $total ?></span> accounts in our system.</h3>
            </div>
        </div>
    </div>
        
    </body>
</html>
