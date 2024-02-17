<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Process</title>
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
                  <a class="nav-link" href="pension.html">Process </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="customer.php">Life Cerificate Status </a>
                  </li>   
                  <li class="nav-item">
                    <a class="nav-link" href="about.html">About Us </a>
                  </li>
              </ul>
           
    </nav> 
   


    <?php
   

        class pension{
            public $bankcode;
            public $ppo;
            public $bank_account;
            public $LC;
            public $remarraige;
            public $reemployed;
            public $authentication_date;
            public $praman_id;
            public $aadhar;
            public $mobileno;
            public $name;
            public $gender;
            public $dob;
            public $remarks;

            function __construct($b,$ppo,$ba,$LC,$rem,$re,$ad,$pi,$aa,$mn,$aname,$gen,$dob,$rema){
                $this->bankcode = $b;
                $this->ppo = $ppo;
                $this->bank_account = $ba;
                $this->LC = $LC;
                $this->remarraige = $rem;
                $this->reemployed = $re;
                $this->authentication_date = $ad;
                $this->praman_id = $pi;
                $this->aadhar = $aa;
                $this->mobileno = $mn;
                $this->name = $aname;
                $this->gender = $gen;
                $this->dob = $dob;
                $this->remarks = $rema;

              
            }
            function get_pension()
            {
               echo $this->bankcode;
               echo $this->ppo ;
               echo $this->bank_account ;
               echo $this->LC ;
               echo $this->remarraige ;
               echo $this->reemployed ;
               echo $this->authentication_date ;
               echo $this->praman_id ;
               echo $this->aadhar ;
               echo $this->mobileno ;
               echo $this->name ;
               echo $this->gender;
               echo $this->dob ;
               echo $this->remarks  ;

            }
        }       
        
            echo "<br>";
        $user= array();
                  
           /* for reading  input csv file reading by impoting  */
           
             if(isset($_POST["import"])){
                 $fileName = $_FILES ["file"]["tmp_name"];

                 if($_FILES["file"]["size"] > 0){
                     $file = fopen($fileName,"r");

                    while(list($bankcode,$ppo,$bank_account,$LC,$remarraige,$reemployed,$authentication_date,$praman_id,$aadhar,$mobileno,$name,$gender,$dob,$remarks )= fgetcsv($file,1024,','))
                    {
                        array_push($user, new pension($bankcode,$ppo,$bank_account,$LC,$remarraige,$reemployed,$authentication_date,$praman_id,$aadhar,$mobileno,$name,$gender,$dob,$remarks));
                    }
                    }
                 
          /* connect to database */
        $con = mysqli_connect("localhost","root","","booking");

        // check connection
        if(!$con){
            echo 'connection error: ' . mysqli_connect_error();
        }

        // Query for selecting all data from master table
        $sql = 'SELECT * FROM master_test';

        //Make query and get result
        $result = mysqli_query($con,$sql);

        // Fetch the resulting rows as an array
        $pensiondata = mysqli_fetch_all($result, MYSQLI_ASSOC);
       
        // Matching downloaded or uploaded data from jeevan praman website with Bsptcl database
        $output= array();
        for($i=1;$i<count($user);$i++)
        {
             $found=false;
             for($j=0;$j<count($pensiondata);$j++)
             {
                 if($user[$i]->name == $pensiondata[$j]['name'] && $user[$i]->aadhar == $pensiondata[$j]['aadhar'] ){
                    $user[$i]->remarks = 'Accepted';
                    array_push($output,$user[$i]);
                    $found=true;
                 }

             }
             if($found!=true)
             {
                $user[$i]->remarks = 'Rejected';
                 array_push($output,$user[$i]);
             }

            }
            
            // Insertiing output in Output database of mysqli 
            
             echo "<br>";
             for($i=0;$i<count($output);$i++)
             {
                 $bankcode=  $output[$i]->bankcode;
                  $ppo = $output[$i]->ppo;
                  $bank_account = $output[$i]->bank_account;
                  $LC = $output[$i]->LC;
                  $remarraige =$output[$i]->remarraige;
                  $reemployed = $output[$i]->reemployed;
                  $authentication_date = $output[$i]->authentication_date;
                  $praman_id = $output[$i]->praman_id;
                  $aadhar = $output[$i]->aadhar;
                  $mobileno = $output[$i]->mobileno;
                  $name = $output[$i]->name;
                  $gender = $output[$i]->gender;
                  $dob = $output[$i]->dob;
                  $remarks = $output[$i]->remarks;

                 $final_output= "INSERT INTO booking
                 .output(bankcode,ppo,bank_account,LC,remarraige,reemployed,authentication_date,praman_id,aadhar,mobileno,name,gender,dob,remarks ) VALUES ('$bankcode','$ppo','$bank_account','$LC','$remarraige','$reemployed','$authentication_date','$praman_id','$aadhar','$mobileno','$name','$gender','$dob','$remarks') ";

}
                 $run = mysqli_query($con,$final_output) or die(mysqli_error());
                 if($run){
                         echo "rows inserted";
                     }
                     else{
                             echo "! ERROR ";
            }

            // echo "<br><br>";
            // echo count($accept);
            // print_r($accept);
            // echo "<br> <br> <br>";
            // echo count($reject);
            // print_r($reject);


     

        }
?>

<?php
         $select= "select * from output";
         $query = mysqli_query($con,$select);
         $nums = mysqli_num_rows($query);
         
           
        ?>

<div class="table-responsive" >
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
            while ($row = mysqli_fetch_array($query)) {
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
             
            ?>
   
    
 
     </tbody>
        </table>
</div> 


<br></br>
<footer style="text-align:center; margin-top:15%; background-color: aquamarine;">

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