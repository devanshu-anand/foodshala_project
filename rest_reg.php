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
                        <a class="nav-link" href="rest_reg.php">
                            <h4>Restaurant Registration</h4><span class="sr-only">(current)</span>
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
    
    

    <! -- RESTAURANT_REGISTRATION 
    ================================================== --->

    <?php
// define variables and set to empty values
$r_nameErr = $r_emailErr = $r_addErr = $r_passwordErr = $r_passwordcErr = $r_encPassword = null;
$r_name = $r_UName = $r_email = $r_add = $r_password = $r_c_password = $status_1 = $status_2 = $temp1 = $temp2 =null;
$form_status = null; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["r_name"])) {
    $r_nameErr = "Name is required";
  } else {
    $r_name = test_input($_POST["r_name"]);
    $r_UName = preg_replace('/\s+/', '_', $r_name);
  }
  
  if (empty($_POST["r_email"])) {
    $r_emailErr = "Email is required";
  } else {
    $r_email = test_input($_POST["r_email"]);
    // check if e-mail address is well-formed
    if (!filter_var($r_email, FILTER_VALIDATE_EMAIL)) {
      $r_emailErr = "Invalid email format";
       
    }
  }
    
  if (empty($_POST["r_add"])) {
    $r_addErr = "Restaurant Address is required";
  } else {
    $r_add = test_input($_POST["r_add"]);
    
    }
    
    if (empty($_POST["r_password"])) {
    $r_passwordErr = "Password is required";
        } else {
    $temp1 = isPasswordValid(test_input($_POST["r_password"]));
    $r_passwordErr = $temp1["message"];
    $status_1 = $temp1["status"];
    if ($status_1 == 1){
        $r_password = test_input($_POST["r_password"]);
    } 
        
    }
    
    if (empty($_POST["r_c_password"])) {
    $r_passwordcErr = "Confirmation password is required";
        } else {
    $temp2 = isPasswordValid(test_input($_POST["r_c_password"]));
    $r_passwordcErr = $temp2["message"];
    $status_2 = $temp2["status"];
    if ($status_2 == 1){
        $r_c_password = test_input($_POST["r_c_password"]);
        if ($r_password == $r_c_password) {
            $r_encPassword = passwordEnc($r_c_password);
            $form_status = 1;
        } else {
            $r_passwordErr = "Password is not Matched";
            $r_passwordcErr = "Password is not Matched";
            $form_status = null;
        }
    
    } 
        
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
echo $r_name;
echo "<br>";
echo $r_email;
echo "<br>";
echo $r_add;
echo "<br>";
echo $r_password;
echo "<br>";
echo $passwordErr;
echo "<br>";
echo $status_1;
echo $r_c_password;
echo "<br>";
echo $passwordcErr;
echo "<br>";
echo $status_2;
echo "<br>";
echo $f_status;
*/
    ?> 


    <?php include("db_connect.php");

        
        $reguser = $msg = $sqlErr = $msgErr = null;
        
        

    if ($form_status == 1 &&  $r_nameErr == null && $r_emailErr == null && $r_addErr == null ){



        
    if ($con_status == 1 && $msgErr == null){
        // checking for registered user
        $sql = "SELECT restaurant_email FROM restaurant_signup WHERE restaurant_email LIKE '$r_email';";
        
        $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
            $reguser = "This email address"." ".$r_email." "."is already registered to a restaurant,<br><br>Please Login to your profile on Restaurant login page";
            $r_passwordErr = $r_passwordcErr = null;
        }
    }else {
            $msgErr = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    
    if ($con_status == 1 && $reguser == null && $msgErr == null )
        {
        //singing up new user
        //echo "signing up new user";
        
        $sql1 = "INSERT INTO restaurant_signup (restaurant_name, restaurant_email, restaurant_address, restaurant_password,restaurant_table_name) VALUES ('$r_name','$r_email','$r_add','$r_encPassword','$r_UName');";
        
        
        
        if (mysqli_query($conn, $sql1)) {
                    //echo "new record created";
                    // query to create a new restaurant menu table
                    
                    $r_menuTable = " ".$r_UName."_restaurant_menu"." ";

                    $sql2="CREATE TABLE $r_menuTable ( dish_id INT NOT NULL AUTO_INCREMENT,
                    dish_name VARCHAR(255) NOT NULL,
                    dish_type VARCHAR(30) NOT NULL,
                    dish_description VARCHAR(255) NOT NULL,
                    dish_price FLOAT NOT NULL,
                    dish_image_dir VARCHAR(255) NULL,
                    restaurant_id INT NOT NULL,
                    PRIMARY KEY ( dish_id ));";
        
        if (mysqli_query($conn, $sql2)){
                      //echo "New menu table created successfully";
                        // query to create new order table for restaurant
                        $r_orderTable = " ".$r_UName."_restaurant_orders"." ";
                        
                     $sql3= "CREATE TABLE $r_orderTable ( restaurant_order_id INT NOT NULL AUTO_INCREMENT,
                    customer_order_id INT NOT NULL,
                    customer_order_table_name VARCHAR(255) NOT NULL,
                    customer_name VARCHAR(255) NOT NULL,
                    customer_address VARCHAR(255) NOT NULL,
                    dish_name VARCHAR(255) NOT NULL,
                    dish_image_dir VARCHAR(255) NULL,
                    dish_price INT NOT NULL,

                    PRIMARY KEY ( restaurant_order_id ));";
        
                                if (mysqli_query($conn, $sql3)){
                                            //echo "New order table created";
                                           // echo "You have registered Successfully";
                                           $rest_DeliveredTable = " ".$r_UName."_delivered_orders"." ";
                                           $sql4= "CREATE TABLE $rest_DeliveredTable ( restaurant_delivered_order_id INT NOT NULL,
                                           
                                           customer_name VARCHAR(255) NOT NULL,
                                           customer_address VARCHAR(255) NOT NULL,
                                           dish_name VARCHAR(255) NOT NULL,
                                           dish_image_dir VARCHAR(255) NULL,
                                           dish_price INT NOT NULL,
                                           PRIMARY KEY ( restaurant_delivered_order_id ));";

                                           if(mysqli_query($conn,$sql4)){

                                           
                       

                                                $msg = "You Have successfully Registered<br>Please login to Your profile";
                                                
                                                $r_name = $r_email = $r_add = $r_password = $r_c_password = $r_encPassword = $r_UName= null;
                                                header("location:rest_login.php");
                                                exit();

                                        } 
                                        else {
                                            $msgErr = "your delivered order table could not be created<br>";
                                            $sqlErr = "Error: " . $sql4 . "<br>" . mysqli_error($conn);}

                                        
                                        }else{
                                            $msgErr = "your order table could not be created<br>";
                                            $sqlErr = "Error: " . $sql3 . "<br>" . mysqli_error($conn);}
                                    } else {
                                                $msgErr = "your menu table could not be created<br>";
                                                $sqlErr = "Error: " . $sql2 . "<br>" . mysqli_error($conn);}
                                        } else {
                                            $msgErr = "your are not able to signup right now, due to some technical issue !<br>";
                                            $sqlErr = "Error: " . $sql1 . "<br>" . mysqli_error($conn);
                                                    }
                                    }
                        
    
        // closing connection
        mysqli_close($conn);
        //echo "closing connection";
      
    }                  
    
    
   ?>                     
                
                    
    
    

        




    


    <section id="rest_reg">
        <article>
            <div class="container clearfix">
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Welcome To FoodShala Restraunt Registration</h2>
                        <h3>You can register here, to start doing business with our online order platform</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        
                        <h4>Please fill the required details to get registered</h4><span class="error"><?php echo $msgErr;?></span><span class="message"><?php echo $msg;?></span><span class="error"><?php echo $sqlErr;?></span>
                        <hr>
                        

                        <form method="post" action="rest_reg.php">

                            Restaurant's Name: <span class="error">&#42;
                                <?php echo $r_nameErr;?></span>

                            <input type="text" name="r_name" placeholder="Enter Restaurant's Name " required>

                            <br>
                            
                            E-mail: <span class="error">&#42;
                                <?php echo $r_emailErr;?></span>
                            <input type="email" name="r_email" placeholder="and your contact e-mail" required>
                            <br>
                            <div class="row">
                                <div class="col-sm-6">
                                    <h4 class="error">
                                    <?php echo $reguser;?>
                                    </h4>
                                    </div>
                                    
                                </div>
                            
                            Restaurant's Address: <span class="error">&#42;
                                <?php echo $r_addErr;?></span>

                            <input type="text" name="r_add" placeholder="and your restaurant address" required>
                            <br>
                            Password: <span class="error">&#42;
                                <?php echo $r_passwordErr;?></span>

                            <input type="password" name="r_password" placeholder="Enter your password" required>
                            <br>
                            Confirm Password: <span class="error">&#42;
                                <?php echo $r_passwordcErr;?></span>

                            <input type="password" name="r_c_password" placeholder="Confirm your password" required>
                            <br>

                            <input class="btn btn-success btn-block" type="submit" name="r_reg_submit" value="Submit">
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