<?php error_reporting (E_ALL ^ E_NOTICE); ?>
<?php require_once('connection.php'); ?>
<?php session_start();?>
<?php

$errors = array();
$Email ="";
$passwrd ="";
   
   // check for form submission
   if(isset($_POST['submit'])){

    
  //  {
       //save username and password into variables
       $Email = $_POST['email'];
       $passwrd = $_POST['pass'];
  

     //  database query 
     $query = "SELECT * FROM editors
                WHERE email = '{$Email}' 
                AND pass = '{$passwrd}'
                limit 1";

    //execute sql query
    $result_set = mysqli_query($connection,$query);

         if ($result_set)
             {
                // check if the user is valid
                  if(mysqli_num_rows($result_set) == 1)
                    {
                      $editors =mysqli_fetch_assoc($result_set);
                      $_SESSION['user_id']=$editors['editor_id'];                  
                      $_SESSION['pass']=$editors['pass'];
                      $_SESSION['email']=$editors['email'];



                     //redirect to add nominee
                    
                      header("Location: AddNominee.php");
                        
                      

                    }
                   else
                   {
                          //user name or password invalid
                         $errors[] = 'Invalid Email/Password';
                 
                   }

                }
           else
            {
                $errors[] ='Database query failed';
                echo"<script> alert('database')</script>";
            }
    } 
?>
<!DOCTYPE html>
<html>

  <head>
    <meta name="viewport" content="width=device-width , intial-scale=1.0">
    <title>Admin Login</title>
    <link rel = "icon" href = "Images/lg.png" type = "image/x-icon" >
    <link rel="stylesheet" href="CSS/Login.css">
  </head>

  <body>
    <div class="container" >

    <nav>
        <img src="images/r.png" class="logo">
    </nav>
    <hr>
    <br><br><br>

    <a class="title">Admin Login</a>
        <br>

    <form method="POST" action="admin login.php">
        <div class="form">
          
           

            <label for="email"><a class="frmd">Email</a></label><br>
            <input type="text" name="email" id="fname" placeholder="Email" required>
            <br>
            <br>
            <label for="password"><a class="frmd">Password</a></label><br>
            <input type="password" name="pass" id="pswrd" placeholder="At least 6 characters" required>
            <br>
            <br>
            <?php
           if(isset($errors) && !empty($errors))
           {
            
             echo'<div class="alert" id="er">
             <span class="closebtn" onclick="closeerror()">&times;</span> 
             <strong>Invalid!</strong> Email or Password.
             
           </div>';   
  
           echo'<script>
  
           function closeerror(){
  
            document.getElementById("er").style.display = "none"
            }
  
           </script>';
  
           }
      ?>
            <button type="submit" name="submit" class="loginbtn">LOG IN</button>
        </div>
    </form>
    <img class="devlogin" src="Images/Devlogin.png" alt="devlogin">

    <hr class="bottom-hr">

    <p class="copyright">Copyright ©2021 All Rights Reserved | System Developed By Y1 S2 Assignment Group MLB_G01_2_11</p>
    <br>

      

    </div>
  </body>
</html>
