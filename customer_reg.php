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
                        <a class="nav-link" href="customer_reg.php">
                            <h4>Customer Registration</h4><span class="sr-only">(current)</span>
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
    
   <! -- CUSTOMER_REGISTRATION 
    ================================================== --->
    


    <?php
// define variables and set to empty values
$c_nameErr = $c_emailErr = $c_addErr = $c_passwordErr = $c_passwordcErr = $c_prefErr = null;
$c_name = $c_UName = $c_email = $c_add = $c_password = $c_c_password = $c_pref = $c_encPassword = $status_1 = $status_2 = $temp_1 =  $temp_2 = null;
$form_status = null; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["c_name"])) {
    $c_nameErr = "Name is required";
  } else {
    $c_name = test_input($_POST["c_name"]);
    $c_UName = preg_replace('/\s+/', '_', $c_name);
    
  }
  
  if (empty($_POST["c_email"])) {
    $c_emailErr = "Email is required";
  } else {
    $c_email = test_input($_POST["c_email"]);
    // check if e-mail address is well-formed
    if (!filter_var($c_email, FILTER_VALIDATE_EMAIL)) {
      $c_emailErr = "Invalid email format"; 
    }
  }
    
  if (empty($_POST["c_add"])) {
    $c_addErr = "Delivery Address is required";
  } else {
    $c_add = test_input($_POST["c_add"]);
    
    }
    
    if (empty($_POST["c_password"])) {
    $c_passwordErr = "Password is required";
        } else {
    $temp_1 = isPasswordValid(test_input($_POST["c_password"]));
    $c_passwordErr = $temp_1["message"];
    $status_1 = $temp_1["status"];
    if ($status_1 == 1){
        $c_password = test_input($_POST["c_password"]);
    } 
        
    }
    
    if (empty($_POST["c_c_password"])) {
    $c_passwordcErr = "Confirmation password is required";
        } else {
    $temp_2 = isPasswordValid(test_input($_POST["c_c_password"]));
    $c_passwordcErr = $temp_2["message"];
    $status_2 = $temp_2["status"];
    if ($status_2 == 1){
        $c_c_password = test_input($_POST["c_c_password"]);
        if ($c_password == $c_c_password) {
            $c_encPassword = passwordEnc($c_c_password);
            $form_status = 1;
        } else {
            $c_passwordErr = "Password is not Matched";
            $c_passwordcErr = "Password is not Matched";
            $form_status = null;
        }
    
    
    
    } 
        
    }
    
    
    if (isset($_POST["food_pref"])) {
        $c_pref = $_POST["food_pref"];
    
  } else
    {
        $c_prefErr = "Please choose atleast one preferenece";
    }
  







}

function passwordEnc($password){
        
    $salt = 'HackNahiKarSakte';
    $encPassword = hash('gost', $password.$salt);
    return $encPassword;
}

   
    
    
    
    
    
    function isPasswordValid($password){
            $whiteListed = "\$\@\#\^\|\!\~\=\+\-\_\.";
            $status = false;
            $message = "Password is invalid";
            $containsLetter  = preg_match('/[a-zA-Z]/', $password);
            $containsDigit   = preg_match('/\d/', $password);
            $containsSpecial = preg_match('/['.$whiteListed.']/', $password);
            $containsAnyOther = preg_match('/[^A-Za-z-\d'.$whiteListed.']/', $password);
            if (strlen($password) < 8 ) $message = "Password should be at least 8 characters long";
            else if (strlen($password) > 20 ) $message = "Password should be at maximum 20 characters long";
            else if(!$containsLetter) $message = "Password should contain at least one letter.";
            else if(!$containsDigit) $message = "Password should contain at least one number.";
            else if(!$containsSpecial) $message = "Password should contain at least one of these ".stripslashes( $whiteListed )." ";
            else if($containsAnyOther) $message = "Password should contain only the mentioned characters";
            else {
                $status = true;
                $message = "Password is valid";
            }
            return array(
                "status" => $status,
                "message" => $message
            );
            
    }
   

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  return $data;
}
?>

 <?php
/*echo "<h2>Your Input:</h2>";
echo $c_name;
echo "<br>";
echo $c_email;
echo "<br>";
echo $c_add;
echo "<br>";
echo $c_password;
echo "<br>";
echo $c_passwordErr;
echo "<br>";
echo $status_1_2;
echo $c_c_password;
echo "<br>";
echo $c_passwordcErr;
echo "<br>";
echo $status_2_1;
echo "<br>";
echo $f_status_1;

   */ ?> 


    <?php include("db_connect.php");

        $reguser = $msg = $sqlErr = $msgErr = null; 


        if ($form_status == 1 &&  $c_nameErr == null && $c_emailErr == null && $c_addErr == null && $c_prefErr == null ){
 
                if ($con_status == 1 && $msgErr == null){
                    // checking for registered user
                    $sql = "SELECT customer_email FROM customer_signup WHERE customer_email LIKE '$c_email';";
                    
                    $result = mysqli_query($conn, $sql);

                                if ( mysqli_num_rows($result) > 0) {
                                $reguser = "This email address"." ".$c_email." "."is already registered to a account,<br><br>Please Login to your profile on customer login page";
                                $c_passwordErr = $c_passwordcErr = null;
                                
                            }
                        }else {
                            $msgErr = "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
               
    
    if ($con_status == 1 && $reguser == null && $msgErr == null)
        {
        //singing up new user
        
        $sql1 = "INSERT INTO customer_signup (customer_name, customer_food_preference, customer_email, customer_address, customer_password,customer_table_name) VALUES ('$c_name','$c_pref','$c_email','$c_add','$c_encPassword','$c_UName');";
        
       
        
        
                        if (mysqli_query($conn, $sql1)){
                        
                            
                        // query to create a new customer order table
                                    
                                    $custOrderTable = " ".$c_UName."_orders"." ";

                                    $sql2 ="CREATE TABLE $custOrderTable ( customer_order_id INT NOT NULL AUTO_INCREMENT,
                                    
                                    dish_name VARCHAR(255) NOT NULL,
                                    restaurant_name VARCHAR(255) NOT NULL,
                                    dish_price INT NOT NULL,
                                    dish_image_dir VARCHAR(255) NULL, 
                                    order_status  VARCHAR(255) NULL,
                                    PRIMARY KEY ( customer_order_id ));";
                    
                    
                                            if(mysqli_query($conn, $sql2)){
                                                //echo "customer order table created";
                                                
                                                $msg = "You Have successfully Registered<br>Please login to Your profile";
                                                $c_name = $c_email = $c_add = $c_password = $c_c_password = $c_pref = $c_encPassword = $c_UName = null;
                                                header("location:customer_login.php");
                                                exit();
                                                }
                                                else {
                                                    $msgErr = "your order table could not be created</br>";
                                                    $sqlErr = "Error: " . $sql2 . "<br>" . mysqli_error($conn);}

                                                }
                                                else {
                                                    $msgErr = "your are not signed up right now,<br> due to some technical issue!";
                                                    $sqlErr = "Error: " . $sql1 . "<br>" . mysqli_error($conn);}
                                                }
                                    }
        // closing connection
        mysqli_close($conn);
        //echo "closing connection";               
        ?>           
                        
   
        
      
                     
    
    
    
                     
                
                    
   <! -- CUSTOMER_REGISTRATION_HTML 
    ================================================== ---> 
    
    


    <section id="customer_reg">
        <article>
            <div class="container clearfix">
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Welcome To FoodShala Customer Registration</h2>
                        <h3>You can register here, to start ordering to your favourite restaurants </h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        
                        <h4>Please fill the required details to get registered</h4><span class="error"><?php echo $msgErr;?></span><span class="message"><?php echo $msg;?></span><span class="error"><?php echo $sqlErr;?></span>
                        <hr>
                        

                        <form method="post" action="customer_reg.php">

                             
                               Name: <span class="error">&#42;
                                <?php echo $c_nameErr;?></span>

                            <input type="text" name="c_name" placeholder="Enter your Name " required>
                            
                            <br>
                          
                               Food Preference: <span class="error">&#42;
                                <?php echo $c_prefErr;?></span>
                            <div class="row">
                                
                                   <div class="col-sm-2">
                                    <label class="radio-inline" for="veg_radio">Vegetarian</label>
                                    <input type="radio" name="food_pref" id="veg_radio" value="veg">
                                </div>
                                
                                
                                <div class="col-sm-2">
                                 <label class="radio-inline" for="nonveg_radio">Non - Vegetarian</label>            
                            <input type="radio" name="food_pref" id="nonveg_radio" value="non-veg">
                                </div>
                            
                             </div>
                                
                            
                                         
                           
                                        

                            <br>
                            
                            E-mail: <span class="error">&#42;
                                <?php echo $c_emailErr;?></span>
                            <input type="email" name="c_email" placeholder="and your contact e-mail" required>
                            <br>
                                                        
                            Delivery Address: <span class="error">&#42;
                                <?php echo $c_addErr;?></span>

                            <input type="text" name="c_add" placeholder="and your delivery address" required>
                            <br>
                            Password: <span class="error">&#42;
                                <?php echo $c_passwordErr;?></span>

                            <input type="password" name="c_password" placeholder="Enter your password" required>
                            <br>
                            Confirm Password: <span class="error">&#42;
                                <?php echo $c_passwordcErr;?></span>

                            <input type="password" name="c_c_password" placeholder="Confirm your password" required>
                            <br>

                            <input class="btn btn-success btn-block" type="submit" name="c_reg_submit" value="Submit">
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