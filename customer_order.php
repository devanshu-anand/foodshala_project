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
    if(isset($_POST["c_logout_submit"])){
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

        <a class="navbar-brand navbar-center" href="customer_homepage.php"><h3>Food Shala</h3></a>
        <div class="collapse navbar-collapse justify-content-left" id="hbNavbar">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link" href="customer_homepage.php"><h4>Home</h4></a>
                    
                </li>
                
                
                <li class="nav-item ">
                <a class="nav-link" href="customer_homepage.php"><h4>Welcome<?php echo " ".$_SESSION["c_name"]; ?></h4></a>
                
                </li>
                <li class="nav-item active">
                <a class="nav-link" href="customer_order.php"><h4><?php echo $_SESSION["c_name"]." "; ?>Orders</h4><span class="sr-only">(current)</span></a>
                
                </li>
                
            </ul><!-- unorederd list -->
        </div><!-- hbnavbar -->

        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#sbnavbar" aria-controls="sbnavbar" aria-expanded="False" aria-label="Toggle navigation"><i class="fas fa-user"></i></button>

            <div class="collapse navbar-collapse justify-content-end" id="sbnavbar">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="btn btn-secondary" href="customer_order.php" role="button">View Orders</a>
                </li><!-- nav-item-1 -->
                
                <li class="nav-item">
                <a class="btn btn-secondary" href="customer_homepage.php" role="button"><?php echo $_SESSION["c_name"]." "."Profile";?></a>
                </li><!-- nav-item-1 -->

                 <li class="nav-item">
                 <form method="post" action="customer_homepage.php">
                 <input class="btn btn-danger btn-block" type="submit" name="c_logout_submit" value="Logout">
                </form>
                    
                
                 </li><!-- nav-item-1 -->
            </ul>
            </div><!-- sbNavbar -->
        </nav><!-- navbar -->
    </header><!-- header -->


    <! -- CUSTOMER-ORDER_SECTION
    ================================================== --->
    <section id="customer_order">
        <article>
            <div class="container clearfix">
            <?php $tMsg = null;?>
    <div class="row">
                    <div class="col-sm-10">
                        <h2><?php echo $_SESSION["c_name"]." ";?>your orders</h2><span class="error"><?php echo $tMsg;?></span>
                        <hr>
                        <table class="table table-dark ">
                            <thead>
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Dish Name</th>
                                    <th scope="col">Dish Image</th>
                                    <th scope="col">Restaurant Name</th>
                                    <th scope="col">Dish Price</th>
                                    <th scope="col">Status &#40; Rs. &#41;</th>
                                </tr>
                            </thead>
                            <tbody>
                <?php include("db_connect.php");
                    
                    if($con_status == 1){
                        $cusOrderTable = " ".$_SESSION["c_TName"]."_orders"." ";
                        $sql = "SELECT customer_order_id,dish_name,restaurant_name,dish_price,dish_image_dir,order_status FROM $cusOrderTable order by customer_order_id asc;";
                        $result = mysqli_query($conn,$sql);
                        
                               if (mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_assoc($result)){
                                        $fDishImgDir =$row["dish_image_dir"];
                                        echo "<tr><td>".$row["customer_order_id"]."</td><td>".$row["dish_name"]."</td>";
                                        echo "<td>".'<img src="'.$fDishImgDir.'" width="150" height="150" >'."</td>";
                                        
                                        echo "<td>".$row["restaurant_name"]."</td><td>".$row["dish_price"]."</td><td>".$row["order_status"]."</td></tr>";
                                           
                                    }
                                }
                                else {
                                    $tMsg = "You Have placed no orders, Yet !!";
                                }
                                
                       }
                     mysqli_close($conn);  
                ?>

                <?php include("db_connect.php");
                    $total = null;
                    if ($con_status == 1){
                        $custOrderTableName = " ".$_SESSION["c_TName"]."_orders"." ";
                        $sql = "SELECT SUM(dish_price) AS `total_sum` FROM $custOrderTableName";
                        $result = mysqli_query($conn,$sql);
                        $row = mysqli_fetch_array($result);
                        
                        $total=$row['total_sum'];   
                    }
                    //closing connection
                    mysqli_close($conn);
               ?>


                                <tr>
                                    <th scope="row"></th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><?php echo "You spent:"." ".$total;?></td>
                                    <td></td>
                                </tr>
                          
                          
                          </tbody>  
                          
                        </table>
                    </div>
                </div>

                    </div>
                    </article>
                    </section>





