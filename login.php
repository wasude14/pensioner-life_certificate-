 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="pension.css">
 </head>
 <body>
 <h1 class="heading">
            <font face="tahoma" size="5" >Pensioner Digital Life Certificate Processing System
            </font>
            <font face="tahoma" size="3" >GOVERNMENT OF BIHAR</font>
        </h1>
        
        
        <nav id="navbar">
            
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="home.html">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pension.html">Process</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="customer.php">Life Cerificate Status </a>
                  </li>   
                  <li class="nav-item">
                    <a class="nav-link" href="about.html">About Us </a>
                  </li>
              </ul>
           
    </nav> 
    
    <form action='login.php'  method="post">
        <div style="text-align:center; margin-top:13%; margin-right:15%">
            <h2 style="text-align:center; margin-top:5%; margin-left:0%">Admin Login </h2>
            <br>
        User ID : <input type="text" id="userid" name="userid" placeholder="Enter ID" required>
        <br><br>
        Password : <input  id="password" name="password" type="password" placeholder="Enter password" required>
      </div>
      <div style="text-align:center; margin-right:15%; ">
      <br>
        <button type="submit" value="login" id = "login" name="login" class="btn btn-primary">Submit</button>
      </div>
    </form>

    <?php

$userid= $_POST['userid'];
$password = $_POST['password'];
$con = mysqli_connect("localhost","root","","booking");

// check connection
if(!$con){
    echo 'connection error: ' . mysqli_connect_error();
}
else {
    $stmt = $con->prepare("SELECT * FROM login WHERE userid=?");
    $stmt->bind_param("s",$userid);
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    if ($stmt_result->num_rows >0) {
        $data = $stmt_result->fetch_assoc();
        
        if ($data['password'] === $password) {
            header("location:project/pension.html");
        }
        
        else {
            echo "invalid";
        }
    }
}

// session_start();
// // check if the user is already loged in
// if(isset($_SESSION['userid']))
// {
//     header("location: pension.html");
//     exit;
// }

//    $userid = $password = "";
//    $userid_err = $password_err ="";

//    // if request method is post

//    if($_SERVER['REQUEST_METHOD']== "POST")
//    {
//        if(empty(trim($_POST['userid'])) || empty(trim($_POST['password'])))
//        {
//            $err = "Please enter Userid or Password";
//        }
//        else
//        {
//            $userrid = trim($_POST['userid']);
//            $password = trim($_POST['password']);
//        }
//        if(empty($err))
//        {
//            $sql = "SELECT userid,password FROM login WHERE userid=?";
//            $stmt = mysqli_prepare($con, $sql);
//            mysqli_stmt_bind_param($stmt,"s",$param_userid);
//            // set the value of param userid
//            $param_userid = trim($_POST['userid']);
//            // try to execute  statement
//            if(mysqli_stmt_execute($stmt))
//            {
//                mysqli_stmt_store_result($stmt);
//                echo "Hello";
//                   print_r($stmt);
//                if(mysqli_stmt_num_rows($stmt) > 0)
//                {
//                    mysqli_stmt_bind_result($stmt,$userid,$hashed_password);
//                    if(mysqli_stmt_fetch($stmt))
//                    {
//                        if(password_verify($password, $hashed_password))
//                        {
//                            // this means the password is correct
//                            session_start();
//                            $_SESSION['userid'] = $userid;
//                            $_SESSION["password"] = $password;
//                            $_SESSION["loggedin"] = true;

//                            //redirect userr to admin page
//                            header("location: pension.html");
//                        }
//                    }
//                }
//            }
//        }
//    }
    ?>

<footer style=" text-align: center; margin-top: 15%; background-color: aquamarine;">
        <p >
          <a href="home.html" >Home</a> | <a href="pension.html" >Process</a> |   <a href="customer.php" >Life Cerificate Status</a> | <a href="about.html" >About Us</a> | <br>Email :bsptclbihar@gmail.com |<br> Mobile: +0538-308743<br>
          <div id="copy">Copyright © <b>2022</b> BSPHCL, All Rights are Reserved</div>
                    </div>
                    <div class="rightBox">
                    <div id="counter"></div>
                  </div>
                    <div class="clear"></div></div>
        </p>
    </footer>
 </body>
 </html>