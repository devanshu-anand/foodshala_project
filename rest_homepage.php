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

<! -- HEADER-PHP
    ================================================== --->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["r_logout_submit"])){
        // remove all session variables
            session_unset();
            header("location:index.php"); 
            
        }
    }

    ?>



<! -- HEADER-HTML
    ================================================== --->
    <header class="site-header" role="banner">
        <! -- NAVBAR
        ================================================== --->

        <nav class="navbar navbar-expand-lg navbar-fixed-top navbar-dark bg-dark">
        <button class="navbar-toggler navbar-toggler-left" type="button" data-toggle="collapse" data-target="#hbNavbar" aria-controls="hbNavbar" aria-expanded="False" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

        <a class="navbar-brand navbar-center" href="rest_homepage.php"><h3>Food Shala</h3></a>
        <div class="collapse navbar-collapse justify-content-left" id="hbNavbar">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="rest_homepage.php"><h4>Home</h4></a>
                    
                </li>
                
                
                

                <li class="nav-item">
                <a class="nav-link" href="rest_view_order.php"><h4>View Orders</h4></a>
                </li><!-- nav-item-1 -->
                
            </ul><!-- unorederd list -->
        </div><!-- hbnavbar -->
        <?php include("db_connect.php");
                 $ordernotif= null;
                 if($con_status == 1){
                    $restOrderTable = " ".$_SESSION["r_TName"]."_restaurant_orders"." ";
                    $sql = "SELECT count(restaurant_order_id) AS total FROM $restOrderTable;"; 
                    $result = mysqli_query($conn,$sql);
                    $values = mysqli_fetch_assoc($result);

                    $orderNotif = $values['total'];
                    
                    
                 }
                 mysqli_close($conn);
                 ?>
                
        
        
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#sbnavbar" aria-controls="sbnavbar" aria-expanded="False" aria-label="Toggle navigation"><i class="fas fa-user"></i></button>

            <div class="collapse navbar-collapse justify-content-end" id="sbnavbar">
            <ul class="navbar-nav">
            </li><!-- nav-item-1 -->
                    <button type="button" class="btn btn-secondary" >
                     <?php echo $_SESSION["r_name"]." ";?>Orders <span class="badge badge-light"><?php echo $orderNotif;?></span>
                    </button>
                </li>
                
                <li class="nav-item">
                <a class="btn btn-secondary" href="rest_profile.php" role="button"><?php echo $_SESSION["r_name"]." "."Profile";?></a>
                </li><!-- nav-item-1 -->

                 <li class="nav-item">
                 <form method="post" action="rest_homepage.php">
                 <input class="btn btn-danger btn-block" type="submit" name="r_logout_submit" value="Logout">
                </form>
                    
                
                 </li><!-- nav-item-1 -->
            </ul>
            </div><!-- sbNavbar -->
        </nav><!-- navbar -->
    </header><!-- header -->

        
        <! -- HERO
    ================================================== --->
    <section id="hero" data-type="background" data-speed="2">
        <article>
            <div class="container clearfix">
                <div class="row">

                    <div class="col-sm-5">
                        <img src="assets/foodshala-banner-logo.png" alt="Food Shala" class="logo">
                    </div><!-- col -->

                    <div class="col-sm-7">
                        <h1>Food Shala</h1>
                        <h3>One stop to have exciting food in town !<br><br>Select any food item<br>&amp;<br>Order with your Favourite Restaurant</h3>

                        
                        
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- container -->
        </article>

    </section>

         
      <! -- MENU_SECTION
    ================================================== --->        
    <section id="menu">
        <article>
            <div class="container clearfix">
                
                
                            
                            <?php include("db_connect.php");

                            if($con_status == 1){
                                $sql = "SELECT restaurant_id,restaurant_name,restaurant_table_name FROM restaurant_signup order by restaurant_id asc;";
                                $result = mysqli_query($conn,$sql);
                                
                                    if (mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_assoc($result)){
                                                $resId = $row["restaurant_id"];
                                                $resName = $row["restaurant_name"];
                                                $resTableName = $row["restaurant_table_name"];
                                                $resMenuTable = " ".$resTableName."_restaurant_menu"." ";
                                                echo '<h2>'.$resName.' '.'dishes'.'</h2><hr>';
                                                $sql1 = "SELECT dish_image_dir,dish_id,dish_name,dish_type,dish_description,dish_price FROM $resMenuTable order by dish_id asc;";
                                                $result1 = mysqli_query($conn,$sql1);
                                                if (mysqli_num_rows($result1) > 0){
                                                    ?>
                                                    <div class="row">
                                                        <?php
                                                    while($row = mysqli_fetch_assoc($result1)){
                                                        $cardImg = $row["dish_image_dir"];
                                                        ?>
                                                        
                                                        <div class="col-sm-4">
                                                        <div class="card boundary" style="width: 20rem;">
                                                        <img src="<?php echo $cardImg;?>" class="card-img-top" alt="Dish Image" >
                                                        <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">Restaurant Name:<?php echo $resName; ?></li>
                                                        <li class="list-group-item"> Dish Name: <?php echo $row["dish_name"];?></li>
                                                        <li class="list-group-item"> Dish Type: <?php echo $row["dish_type"];?></li>
                                                        <li class="list-group-item"> Dish Description:<?php echo $row["dish_description"];?></li>
                                                        <li class="list-group-item"> Dish price:<?php echo $row["dish_price"];?></li>
                                                        <li class="list-group-item">
                                                        <form action="index.php" method="post">
                                                        <input type="hidden" name="dishImg" value="<?php echo $cardImg;?>">
                                                        <input type="hidden" name="dishName" value="<?php echo $row["dish_name"];?>">
                                                        <input type="hidden" name="dishType" value="<?php echo $row["dish_type"];?>">
                                                        <input type="hidden" name="dishDesc" value="<?php echo $row["dish_type"];?>">
                                                        <input type="hidden" name="dishPrice" value="<?php echo $row["dish_price"];?>">

                                                        <input type="hidden" name="resID" value="<?php echo $resId;?>">
                                                        <input type="hidden" name="resTable" value="<?php echo $resMenuTable;?>">
                                                        <input type="hidden" name="dishID" value="<?php echo $row["dish_id"];?>">
                                                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#login_modal" disabled>Order Here !</button>
                                                        </form></li></ul>
                                                        </div></div>
                                                        
                                                        <?php
                                                    } ?>
                                                    </div><br>
                                                    <?php   
                                                   }
                                                   }
                                                   }
                                                   }
                                                   mysqli_close($conn);   ?>
                                                        
                                                        






                           
                            
                                
                            
                            
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
