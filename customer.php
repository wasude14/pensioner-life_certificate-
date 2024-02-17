<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pension status</title>
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
    <img class="bg" src="p2.jpg" alt="" style=" display: block;
  margin-left: auto;
  margin-right: auto;
  height:10%;
  width: 35%;">
    <form action="" method="post">
      <div style="text-align:center; margin-top:4%; margin-right:15%">
        <br>
        
        Aadhar : <input type="text" name="get_aadhar" placeholder="Enter aadhar" required>
      </div>
      <div style="text-align:center; margin-right:15%; ">
      <br>
        <button type="submit" name="search_by_aadhar" class="btn btn-primary">Submit</button>
      </div>
    </form>
      
    <?php

    $con= mysqli_connect("localhost","root","","booking");
    if(isset($_POST['search_by_aadhar']))
    {
      $aadhar = $_POST['get_aadhar'];
      $query = "SELECT * FROM output where aadhar='$aadhar' ";
      $query_run = mysqli_query($con,$query);
    //  echo $row['aadhar'];
       
    
    ?>

    <div class="table-responsive" style="margin-left:2%; margin-top:7%; text-align:center">
      <table class="table">
      <thead>
        <tr>
          <th scope="col">Bank_code</th>
          <th scope="col">ppo</th>
          <th scope="col">Bank_account</th>
          <th scope="col">LC</th>
          <th scope="col">remarraige</th>
          <th scope="col">reemployed</th>
          <th scope="col">authentication_date</th>
          <th scope="col">praman_id</th>
          <th scope="col">aadhar</th>
          <th scope="col">mobileno</th>
          <th scope="col">name</th>
          <th scope="col">gender</th>
          <th scope="col">dob</th>
          <th scope="col">remarks</th>
        </tr>
      </thead>
      <tbody>
        <?php
           if(mysqli_num_rows($query_run)>0)
           {
             while ($row = mysqli_fetch_array($query_run)) {
               

        ?>
        <tr>
          <td> <?php  echo $row['bankcode'];  ?> </td>
          <td> <?php  echo $row['ppo'];  ?> </td>
          <td> <?php  echo $row['bank_account'];  ?> </td>
          <td> <?php  echo $row['LC'];  ?> </td>
          <td> <?php  echo $row['remarraige'];  ?> </td>
          <td> <?php  echo $row['reemployed'];  ?> </td>
          <td> <?php  echo $row['authentication_date'];  ?> </td>
          <td> <?php  echo $row['praman_id'];  ?> </td>
          <td> <?php  echo $row['aadhar'];  ?> </td>
          <td> <?php  echo $row['mobileno'];  ?> </td>
          <td> <?php  echo $row['name'];  ?> </td>
          <td> <?php  echo $row['gender'];  ?> </td>
          <td> <?php  echo $row['dob'];  ?> </td>
          <td> <?php  echo $row['remarks'];  ?> </td>
          
    </tr>

    <?php
         }
        }
        else {
          ?>
          <tr>
          <td colspan="14">NO data or accepted </td>
        </tr>
        <?php
        }
    ?>
    </tbody>
  </table>
</div>

 <?php
    }
 ?>

<br></br>
<footer style="text-align:center; margin-top: 1%; background-color: aquamarine;">
  
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
          