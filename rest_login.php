<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-eqiv="Content-Type" content="'text/html;charset=UTF-8">
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/foodshala-%20favicon.png">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

    <script defer src="https://use.fontawesome.com/releases/v5.6.1/js/all.js" integrity="sha384-R5JkiUweZpJjELPWqttAYmYM1P3SNEJRM6ecTQF05pFFtxmCO+Y1CiUhvuDzgSVZ" crossorigin="anonymous"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Inconsolata|Noto+Serif+TC" rel="stylesheet">

    <!-- BootStrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- custom CSS -->
    <link href="assets/css/custom.css" rel="stylesheet">

    <title>Food Shala</title>
    <!-- HTML5 shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body>
  
<! -- RESTAURANT-LOGIN-PHP
    ================================================== --->
      <?php
            $rl_emailErr = $rl_passwordErr = $rl_encPassword = null;
            $rl_email = $rl_password = null;
            
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['r_login'])) {
            if (empty($_POST["rl_email"])) {
                $rl_emailErr = "Email is required";
              } else {
                $rl_email = test_input($_POST["rl_email"]);
                // check if e-mail address is well-formed
                if (!filter_var($rl_email, FILTER_VALIDATE_EMAIL)) {
                  $rl_emailErr = "Invalid email format"; 
                }
              }

              if (empty($_POST["rl_password"])) {
                $rl_passwordErr = "Password is required";
                    } else {
                $rl_password = test_input($_POST["rl_password"]);
                $rl_encPassword = passwordEnc($rl_password);                    
                }
              
            }
              
              
            function passwordEnc($password){
        
                $salt = 'HackNahiKarSakte';
                $encPassword = hash('gost', $password.$salt);
                return $encPassword;
        }
              
              function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                return $data;
              }

      ?>
      
      <?php include("db_connect.php");
      
        $_SESSION["r_id"] = $_SESSION["r_name"] = $_SESSION["r_email"] = null; 
        
        $r_Tpassword = null;
        $msg = $msgErr = $sqlErr = null;
      
      if ($con_status == 1 && isset($_POST['r_login']) && $$rl_emailErr == null &&  $rl_passwordErr == null){
               // checking for registered user
        $sql = "SELECT restaurant_id,restaurant_name,restaurant_email,restaurant_password,restaurant_table_name FROM restaurant_signup WHERE restaurant_email LIKE '$rl_email';";
        
        $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                $_SESSION["r_id"] = $row["restaurant_id"]; $_SESSION["r_name"] = $row["restaurant_name"] ;
                $_SESSION["r_email"] = $row["restaurant_email"]; $r_Tpassword = $row["restaurant_password"];
                $_SESSION["r_TName"] = $row["restaurant_table_name"];
                //echo $_SESSION["r_id"], $_SESSION["r_name"],$_SESSION["r_email"], $r_password;
                }
                
                if ($rl_encPassword == $r_Tpassword){
                    $msg = "You have Logged in ";
                    header("location:rest_homepage.php");
                } 
                
            
            
            }
            else {
                $sqlErr =  "Error: " . $sql . "<br>" . mysqli_error($conn);     
                $msgErr = "You have entered a wrong email or password";
            }

            
            
        }
        

    

        // closing connection
        mysqli_close($conn);
        //echo "closing connection";

        

      ?>

      

          



<! -- HEADER
    ================================================== --->
    <header class="site-header" role="banner">
        <! -- NAVBAR
        ================================================== --->

        <nav class="navbar navbar-expand-lg navbar-fixed-top navbar-dark bg-dark">
            <button class="navbar-toggler navbar-toggler-left" type="button" data-toggle="collapse" data-target="#hbNavbar" aria-controls="hbNavbar" aria-expanded="False" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

            <a class="navbar-brand navbar-center" href="index.php">
                <h3>Food Shala</h3>
            </a>
            <div class="collapse navbar-collapse justify-content-left" id="hbNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <h4>Home</h4>
                        </a>

                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="rest_login.php">
                            <h4>Restaurant Login</h4><span class="sr-only">(current)</span>
                        </a>

                    </li>

                </ul><!-- unorederd list -->
            </div><!-- hbnavbar -->
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#sbnavbar" aria-controls="sbnavbar" aria-expanded="False" aria-label="Toggle navigation"><i class="fas fa-user"></i></button>

            <div class="collapse navbar-collapse justify-content-end" id="sbnavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                     <form action="" method="post" class="form-disable">  
                    <button class="btn btn-secondary" type="button" name="whoisactive" id="whoisactive" disabled value="true"><i class="fas fa-user"></i>who is active</button>
                    
                    </form>
                  </li><!-- nav-item-1 -->
                 
            </ul>
            </div><!-- sbNavbar -->
       

        </nav><!-- navbar -->
    </header><!-- header -->



    <! -- RESTAURANT_LOGIN
    ================================================== --->

    <section id="restaurant_login">
        <article>
            <div class="container clearfix">
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Welcome To FoodShala Restaurant login</h2>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        
                        <h4>Please fill the required details to get logged in</h4><span class="error"><?php echo $msgErr;?></span><span class="message"><?php echo $msg;?></span><span class="error"><?php echo $sqlErr;?></span>
                        <hr>
                        

                        <form method="post" action="rest_login.php">
                                                    
                            <h4>E-mail: <span class="error">&#42;
                                <?php echo $rl_emailErr;?></span></h4>
                            <input type="email" name="rl_email" placeholder="enter your registered e-mail" required>
                            <br>

                            <h4>Password:<span class="error">&#42;<?php echo $rl_passwordErr; ?> </span></h4>
                        <input type="password" name="rl_password" placeholder="and your password">
                        <br>

                            <input class="btn btn-success btn-block" type="submit" name="r_login" value="Submit">
                        </form>
                    </div>
                </div>


            </div><!-- container -->
        </article>

    </section>

     <!-- BOOTSTRAP CORE JAVASCRIPT
          Placed at the end of the document so the pages load 
          Faster!
    ================================================== --->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="assets/js/jquery-2.1.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <script src="assets/js/main.js"></script>

    
    
    
    
    

</body>


</html>