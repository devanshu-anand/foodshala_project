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


<?php include("db_connect.php");
                            
                            $custID = $custOrderTableName = $restOrderID = $dishName = $custName = $dishPrice = $custAdd = $dishImage = null;
                            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['orderStatus'])){
                                
                                if(!empty($_POST["custID"])){
                                    $custID = test_input($_POST['custID']);
                                }

                                if(!empty($_POST["custOrderTable"])){
                                    $custOrderTableName = test_input($_POST["custOrderTable"]);
                                }
                                if(!empty($_POST["restOrderID"])){
                                    $restOrderID = test_input($_POST["restOrderID"]);
                                }
                                if(!empty($_POST["dishName"])){
                                    $dishName = test_input($_POST["dishName"]);
                                }
                                if(!empty($_POST["custName"])){
                                    $custName = test_input($_POST["custName"]);
                                }
                                if(!empty($_POST["dishPrice"])){
                                    $dishPrice = test_input($_POST["dishPrice"]);
                                }
                                if(!empty($_POST["custAdd"])){
                                    $custAdd = test_input($_POST["custAdd"]);
                                }
                                if(!empty($_POST["dishImage"])){
                                    $dishImage = test_input($_POST["dishImage"]);
                                }


                                   
                                    $restDeliveredOrderTableName = " ".$_SESSION["r_TName"]."_delivered_orders"." ";
                                    $restOrderTableName = " ".$_SESSION["r_TName"]."_restaurant_orders"." ";
                                    //echo $restOrderTableName;
                                    $orderStatus ="Delivery_is_on_the_way";
                                    
                                    
                                    if($con_status == 1 && $custID !== null && $custOrderTableName !== null && $restOrderID !== null && $dishName !== null && $custName !== null && $dishPrice !== null && $custAdd !== null && $dishImage !== null){
                                        
                                        $sql = "INSERT INTO $restDeliveredOrderTableName (restaurant_delivered_order_id,customer_name,customer_address,dish_name, dish_image_dir, dish_price) VALUES ( '$restOrderID', '$custName','$custAdd', '$dishName','$dishImage', '$dishPrice');";
                                        
                                        if (mysqli_query($conn,$sql)){
                                            $sql1 = "UPDATE $custOrderTableName SET order_status='delivery is on the way' WHERE customer_order_id=$custID";

                                            if (mysqli_query($conn,$sql1)){

                                                $sql2 = "DELETE FROM $restOrderTableName WHERE restaurant_order_id=$restOrderID;";
                                
                                                if(mysqli_query($conn,$sql2)){
                                                    //$tMsg = "card has been deleted";
                                                    $restOrderID = $custName = $custAdd = $dishName = $dishImage = $dishPrice = null;
                                                    $custID = $custOrderTableName = null; 
                                                    
                                                    
                                                    
                                                    
                                                    header("location:rest_view_order.php");
                                                    exit(); 
                            
                                                }
                                                else {
                                                    $msgErr = "could not delete the order from the order table";
                                                    $sqlErr = "Error: " . $sql2 . "<br>" . mysqli_error($conn);
                                                }
                                            }else {
                                                $msgErr = "could not update the order status in customer order table ";
                                            $sqlErr = $sqlErr = "Error: " . $sql1 . "<br>" . mysqli_error($conn);
                                            }
                                        }
                                        else{
                                            $msgErr = "could not insert the data from order table to delivered table";
                                            $sqlErr = $sqlErr = "Error: " . $sql . "<br>" . mysqli_error($conn);
                                        }

                                    }
                                } 
                            

                            function test_input($data) {
                                $data = trim($data);
                                $data = stripslashes($data);
                                return $data;
                              }
                              //closing connection
                              mysqli_close($conn);
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
                <li class="nav-item">
                    <a class="nav-link" href="rest_homepage.php"><h4>Home</h4></a>
                    
                </li>
                
                
                

                <li class="nav-item active">
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


    <! -- RESTAURANT ORDER TABLE SECTION
    ================================================== --->

    <section id="restaurant_order">
        <article>
            <div class="container clearfix">
                    
               <?php  $OrdermsgErr = null;?>
                <div class="row">
                    <div class="col-sm-12">
                        <h2><?php echo $_SESSION["r_name"]." "."your orders";?></h2><span class="error"><?php echo $OrdermsgErr;?></span>
                        <hr>
                        <table class="table table-dark table-responsive-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Dish Name</th>
                                    <th scope="col">Dish Image</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Customer Address</th>
                                    <th scope="col">Dish Price &#40; Rs. &#41;</th>
                                    <th scope="col">Order Status<th>
                                </tr>
                            </thead>
                            <tbody>
                <?php include("db_connect.php");
                    
                   if($con_status == 1){
                    $restOrderTableName = " ".$_SESSION["r_TName"]."_restaurant_orders"." ";    
                    $sql = "SELECT restaurant_order_id,customer_name,customer_address,dish_name,dish_image_dir,dish_price,customer_order_id,customer_order_table_name FROM $restOrderTableName order by restaurant_order_id asc;";
                        $result = mysqli_query($conn,$sql);
                        
                               if (mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_assoc($result)){

                                        ?>

                                        <tr>
                                            <th scope="row"><?php echo $row["restaurant_order_id"];?></th>
                                            <td><?php echo $row["dish_name"];?></td>
                                            <td><img src="<?php echo $row["dish_image_dir"];?>" width="100" height="100" ></td>
                                            <td><?php echo $row["customer_name"];?></td>
                                            <td><?php echo $row["customer_address"];?></td>
                                            <td><?php echo $row["dish_price"];?></td>
                                            <td><form action="rest_view_order.php" method="post">
                                                <input type="hidden" name="restOrderID" value="<?php echo $row["restaurant_order_id"];?>">
                                                <input type="hidden" name="dishName" value="<?php echo $row["dish_name"];?>">
                                                <input type="hidden" name="dishImage" value="<?php echo $row["dish_image_dir"];?>">
                                                <input type="hidden" name="custName" value="<?php echo $row["customer_name"];?>">
                                                <input type="hidden" name="dishPrice" value="<?php echo $row["dish_price"];?>">
                                                <input type="hidden" name="custAdd" value="<?php echo $row["customer_address"];?>">
                                                <input type="hidden" name="custID" value="<?php echo $row["customer_order_id"];?>">
                                                <input type="hidden" name="custOrderTable" value="<?php echo $row["customer_order_table_name"];?>">
                                                <button class="btn btn-success btn-block" name ="orderStatus"type="submit">send to delivery</button>
                                                </form>
                                            </td> 
                                            </tr>
                                        
                                       
                                        <?php 
                                    }
                                }
                                else {
                                    $OrdermsgErr = "You Have no orders Yet!";
                                }
                       }
                     mysqli_close($conn);  
                ?>
                                   
                                        </tbody>
                                    </table>
                                    <hr>
   
                </div><!-- row end -->
                       


<?php $deliveredOrdermsgErr =null;?>
                <div class="row">
                    <div class="col-sm-12">
                        <h2><?php echo $_SESSION["r_name"]." "."your delivered orders";?></h2><span class="message"><span class="error"><?php echo $deliveredOrdermsgErr;?></span>
                        <hr>
                        <table class="table table-dark table-responsive-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Customer Address</th>
                                    <th scope="col">Dish Name</th>
                                    <th scope="col">Dish Image</th>
                                   
                                    
                                    <th scope="col">Dish Price &#40; Rs. &#41;</th>
                                    <th scope="col">Order Status<th>
                                </tr>
                            </thead>
                            <tbody>
               <?php include("db_connect.php");
                    $total = null;
                    if ($con_status == 1){
                        $restDeliveredOrderTableName = " ".$_SESSION["r_TName"]."_delivered_orders"." ";
                        $sql = "SELECT SUM(dish_price) AS `total_sum` FROM $restDeliveredOrderTableName";
                        $result = mysqli_query($conn,$sql);
                        $row = mysqli_fetch_array($result);
                        
                        $total=$row['total_sum'];   
                    }
                    //closing connection
                    mysqli_close($conn);
               ?>
               
                <?php include("db_connect.php");
                    
                   if($con_status == 1){
                    $restDeliveredOrderTableName = " ".$_SESSION["r_TName"]."_delivered_orders"." ";    
                    $sql = "SELECT restaurant_delivered_order_id,customer_name,customer_address,dish_name,dish_image_dir,dish_price FROM $restDeliveredOrderTableName order by restaurant_delivered_order_id asc;";
                        $result = mysqli_query($conn,$sql);
                        
                               if (mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_assoc($result)){

                                        ?>

                                        <tr>
                                            <th scope="row"><?php echo $row["restaurant_delivered_order_id"];?></th>
                                            <td><?php echo $row["customer_name"];?></td>
                                            <td><?php echo $row["customer_address"];?></td>
                                            <td><?php echo $row["dish_name"];?></td>
                                            <td><img src="<?php echo $row["dish_image_dir"];?>" width="100" height="100" ></td>
                                           
                                            
                                            <td><?php echo $row["dish_price"];?></td>
                                            <td><?php echo "send to delivery";?>
                                            </td> 
                                            </tr>
                                            
                                        
                                        <?php 
                                    }
                                }
                                else {
                                    $deliveredOrdermsgErr = "You Have not delivered any orders yet !";
                                }
                       }
                     mysqli_close($conn);  
                ?>

<tr>
                                            <th class="row"></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><?php echo "Total Earned:"." ".$total;?></td>
                                            <td></td>
                                            </tr>
                  </tbody>
                                        </table>
                                        <hr>         
                </div><!-- row end -->


                    </div><!-- container end -->
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
