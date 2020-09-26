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
                                                                                                                
    $dish_Desc = $dish_Img = $dish_Name = $dish_Type = $dish_Price = null;
    
    $tMsg= $sqlErr = $msgErr = null;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
        if (isset($_POST["addItem"]))
        {
            if(!empty($_POST["dishImg"])){
                $dish_Img = test_input($_POST["dishImg"]);
            }
            if(!empty($_POST["dishName"])){
                $dish_Name = test_input($_POST["dishName"]);
            }
            if(!empty($_POST["dishType"])){
                $dish_Type = test_input($_POST["dishType"]);
            }
            if(!empty($_POST["dishDesc"])){
                $dish_Desc = test_input($_POST["dishDesc"]);
            }
            if(!empty($_POST["dishPrice"])){
                $dish_Price = test_input($_POST["dishPrice"]);
            }

            if ($con_status == 1 && isset($dish_Img) && isset($dish_Name) && isset($dish_Type) && isset($dish_Desc) && isset($dish_Price)){ 
                        $restMenuTableName = " ".$_SESSION["r_TName"]."_restaurant_menu"." ";
                        $restId = $_SESSION["r_id"]; 
                $sql= "INSERT INTO $restMenuTableName (dish_name, dish_type, dish_description, dish_price, dish_image_dir,restaurant_id) VALUES ('$dish_Name','$dish_Type','$dish_Desc','$dish_Price','$dish_Img','$restId')";
                
                    if(mysqli_query($conn, $sql)){
                            $tMsg = "file inserted in table";
                            header("location:rest_profile.php");
                            $dishName = $dishDesc = $dishPref = $dishPrice = null;
                            $imgDestination =  null;
                            $dish_Desc = $dish_Img = $dish_Name = $dish_Type = $dish_Price = null;
                            exit();
                        }
                        else {
                            $sqlErr =  "Error: " . $sql . "<br>" . mysqli_error($conn);
                            $msgErr= "Could not add the item in menu";
                            
                        }
                    }
                    else {
                        $msgErr = "your have not entered the details in add item in menu section";
                        header("location:rest_profile.php");
                            
                            exit();
                    }
        
        
        
        }
    }
    // closing connection
    mysqli_close($conn); 
    

    ?> 

<?php include("db_connect.php");
                        $delErr = $delID = $delMsg = null;
                            
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            if(isset($_POST["delCard"])) 
                            {
                                
                            
                            
                            
                                $delID = test_input($_POST["dishID"]);
                                //echo $delID;
                            
                        
                            if ($con_status == 1 && !empty($delID)){
                                $restMenuTableName = " ".$_SESSION["r_TName"]."_restaurant_menu"." ";
                                $sql = "DELETE FROM $restMenuTableName WHERE dish_id= $delID;";
                                
                                if(mysqli_query($conn,$sql)){
                                    $delMsg = "card has been deleted";
                                    header("location:rest_profile.php");
                                    exit(); 
            
                                }
                                else {
                                    $delErr = "Error: " . $sql . "<br>" . mysqli_error($conn);
                                }
                            }
                        }
                    }

                                    

  

                    mysqli_close($conn);

                    ?>
                
       


    <! -- HEADER
    ================================================== --->
    <header class="site-header" role="banner">
        <! -- NAVBAR
        ================================================== --->

        <nav class="navbar navbar-expand-lg navbar-fixed-top navbar-dark bg-dark">
            <button class="navbar-toggler navbar-toggler-left" type="button" data-toggle="collapse" data-target="#hbNavbar" aria-controls="hbNavbar" aria-expanded="False" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

            <a class="navbar-brand navbar-center" href="rest_homepage.php">
                <h3>Food Shala</h3>
            </a>
            <div class="collapse navbar-collapse justify-content-left" id="hbNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item ">
                        <a class="nav-link" href="rest_homepage.php">
                            <h4>Home</h4>
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="rest_profile.php">
                            <h4><?php echo $_SESSION["r_name"]." "."Profile";?></h4><span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rest_view_order.php">
                            <h4>View Orders</h4>
                        </a>
                    </li>
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
                <li class="nav-item">
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


    
    
        

    
        

        
                        
                

      

      


    <! -- ADD_ITEMS_SECTION
    ================================================== --->
    <?php 
            $uImgError = null; $imgDestination = $imgName = null;
            $dish_nameErr = $dish_descErr = $dish_prefErr = $dish_priceErr = null;
            $dishName = $dishDesc = $dishPref = $dishPrice = null;
            $msg = $q_err = $add_err = $fileSet = $cardStatus = null;
                       
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
                if (isset($_POST["preview_card"]))
                {
                    //image section
                   
                    $img = $_FILES['img_to_upload'];
                    //print_r($img);
                    $imgName = $_FILES['img_to_upload']['name'];
                    $imgTempName = $_FILES['img_to_upload']['tmp_name'];
                    $imgSize = $_FILES['img_to_upload']['size'];
                    $imgError = $_FILES['img_to_upload']['error'];
                    $imgType = $_FILES['img_to_upload']['type'];
                    
                    
       
                   $imgExt = explode('.',$imgName);
                   $imgActualExt = strtolower(end($imgExt));
                   $allowed = array ('jpg','jpeg','png','gif');
                   
                   if (in_array($imgActualExt,$allowed)){
                       if($imgError === 0){
                           if($imgSize < 10000000){
                               $imgNameNew = uniqid('',true).".".$imgActualExt;
                               $imgDestination = 'img_uploads/'.$imgNameNew;
                               if (move_uploaded_file($imgTempName,$imgDestination) && $uImgError === null){
                                $msg = "file is uploaded";
                               
                               }
                               else{
                                   $uImgError = "File cannot be moved";
                                   
                               }
                               
                               //echo $imgDestination;
                           } else{
                               $uImgError = "Your image size is too big!";
                               }    
                       } else{
                           $uImgError = "There was an error for uploading your file!";
                           }
       
                   }
                   else {
                       $uImgError =  "you can not upload files of this type";
                       }
                     
                              

                        //form section

                       if (empty($_POST["dish_name"])) {
                        $dish_nameErr = "Dish name is required";
                      } else {
                        $dishName = test_input($_POST["dish_name"]);
                        
                        
                        
                      }
    
                      if (empty($_POST["dish_desc"])) {
                        $dish_descErr = "Dish description is required";
                      } else {
                        $dishDesc = test_input($_POST["dish_desc"]);
                        
                        
                      }
    
                      if (empty($_POST["dish_pref"])) {
                        $dish_prefErr = "Please choose atleast one preferenece";
                       
                         } else
                         {
                            $dishPref = $_POST["dish_pref"];
                          }
    
                        if (empty($_POST["dish_price"])) {
                                $dish_priceErr = "Dish price is required";
                              } else {
                                $dishPrice = test_input($_POST["dish_price"]);
                                
                                
                                }
                
                            }//end of preview card
                        }//end of form post

                    
            
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                return $data;
              }   
            
    ?>
    
    
    
    
    <section id="add_items">
        <article>
            <div class="container clearfix">
                <div class="row">
                    <div class="col-sm-4">
                        <h2><?php echo $_SESSION["r_name"]." "."Profile";?></h2>
                        <h3>Add items to Your Menu </h3>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <form action="rest_profile.php" method="post" enctype="multipart/form-data">
                                
                            <p class="lead">Dish Name:<span class="error">&#42; <?php echo $dish_nameErr; ?></span></p><input type="text" name="dish_name" placeholder="Enter your dish name here" required>
                            
                            <p class="lead">Description:<span class="error">&#42; <?php echo $dish_descErr; ?></span></p> <textarea name="dish_desc" rows="5" cols="8" placeholder="Enter dish description here" required></textarea>
                            <div class="row">
                            <div class="col-sm-6">
                            <p class="lead">Dish Type:<span class="error">&#42; <?php echo $dish_prefErr; ?></span></p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="dish_pref" id="veg_radio" value="Veg" unchecked required>
                                <label class="form-check-label" for="veg_radio"><p class="lead">Vegetarian</p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="dish_pref" id="nonveg_radio" value="Non-Veg" unchecked required>
                                <label class="form-check-label" for="nonveg_radio"><p class="lead">Non-Vegetarian</p>
                                </label>
                            </div>
                            </div>
                            <div class="col-sm-4">

                            <p class="lead">Dish Price:<span class="error">&#42;<?php echo $dish_priceErr; ?></span></p><input type="float" name="dish_price" placeholder="Enter dish price here"required>
                            </div>
                            </div>
                            <!-- image section -->
                            <div class="row boundary">
                                <div class="col-sm-12">
                                     <div class="row ">
                                        
                                        <p class="lead">Select an image of food item to upload:</p><span class="error">&#42;</span>
                                         
                                        
                                        
                                        <div class="col-sm-4">
                                        
                                        </div>
                                    </div>
                                        <div class="row">
                                                <div class="col-sm-6">
                                                <p class="lead">Upload the image here:</p><br><?php echo $imgName; ?><br>
                                                <span class="error"><?php echo $uImgError; ?></span>
                                                </div>
                                                <div class="col-sm-4">
                                                <input type="file" name="img_to_upload" required > <br>
                                                <span class="message"><?php echo $msg; ?></span>
                                                </div>
                                        </div>
                            
                                </div>
                            </div>
                            
                            <hr>
                            <form action="rest.profile.php" method="post">
                            <button class="btn btn-success" type="submit" name="preview_card">Preview Card</button>
                            
                        </form>
                        
                    </div><!-- end of form -->
                        
                    <div class="col-sm-4">
                        <div class="card boundary" style="width: 20rem;">
                            <img src="<?php echo $imgDestination;?>" class="card-img-top" alt="Dish Image" >
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Restaurant Name:<?php echo $_SESSION["r_name"]; ?></li>
                                    <li class="list-group-item"> Dish Name: <?php echo $dishName;?></li>
                                    <li class="list-group-item"> Dish Type: <?php echo $dishPref;?></li>
                                    <li class="list-group-item"> Dish Description:<?php echo $dishDesc;?></li>
                                    <li class="list-group-item"> Dish price:<?php echo $dishPrice;?></li>
                                    <li class="list-group-item">
                                    <button class="btn btn-success" type="submit" name="orderBtn" data-toggle="modal" data-target="#order_modal" value="orderBtn" disabled>Order</button>
                                    </li></ul>
                                    </div>
                                    <hr>
                                    
                        

            
                
                
                
                    
                    
                        
                        

                    
                    
                   
                       
                    

                    
   
               
                   
             

           
                                    
                                    
                                    <div class="col-sm-4 offset-sm-3">
                                <form action="rest_profile.php" method="post">
                                                        <input type="hidden" name="dishImg" value="<?php echo $imgDestination;?>">
                                                        <input type="hidden" name="dishName" value="<?php echo $dishName;?>">
                                                        <input type="hidden" name="dishType" value="<?php echo $dishPref;?>">
                                                        <input type="hidden" name="dishDesc" value="<?php echo $dishDesc;?>">
                                                        <input type="hidden" name="dishPrice" value="<?php echo $dishPrice;?>">
                                                        
                                                        
                                                    <button class="btn btn-success" type="submit" name="addItem" value="addItem" onclick="return mess();">Add to Menu</button>
                                                        </form>
                                                        <script type="text/javascipt">
                                                            function mess(){
                                                                alert ("Hurray !! you have added a new dish in your online restaurant ! ");
                                                                return true;
                                                            }
                                                        </script>
                                </div><!-- end of coloumn -->                            
                            </div><!-- end of coloumn -->
                                


                </div><!-- end of row -->
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Added Items to Menu</h2><span class="message"><?php echo $tMsg;?></span><span class="error"><?php echo $msgErr;?></span><span class="error"><?php echo $sqlErr;?></span>
                        <hr>
                        <table class="table table-dark table-responsive-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Dish ID</th>
                                    <th scope="col">Dish Name</th>
                                    <th scope="col">Dish Image</th>
                                    <th scope="col">Dish Type</th>
                                    <th scope="col">Dish Description</th>
                                    <th scope="col">Dish Price &#40; Rs. &#41;</th>
                                </tr>
                            </thead>
                            <tbody>
                <?php include("db_connect.php");
                    
                   if($con_status == 1){
                    $restMenuTableName = " ".$_SESSION["r_TName"]."_restaurant_menu"." ";    
                    $sql = "SELECT dish_id,dish_name,dish_image_dir,dish_type,dish_description,dish_price FROM $restMenuTableName order by dish_id asc;";
                        $result = mysqli_query($conn,$sql);
                        
                               if (mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_assoc($result)){

                                        ?>

                                        <tr>
                                            <th scope="row"><?php echo $row["dish_id"];?></th>
                                            <td><?php echo $row["dish_name"];?></td>
                                            <td><img src="<?php echo $row["dish_image_dir"];?>" width="100" height="100" ></td>
                                            <td><?php echo $row["dish_type"];?></td>
                                            <td><?php echo $row["dish_description"];?></td>
                                            <td><?php echo $row["dish_price"];?></td>
                                            <td><form action="rest_profile.php" method="post">
                                                <input type="hidden" name="dishID" value="<?php echo $row["dish_id"];?>">
                                                <button class="btn btn-danger btn-block" name ="delCard"type="submit">Delete card</button>
                                                </form>
                                            </td> 
                                            </tr>

                                        <?php 
                                    }
                                }
                                else {
                                    $tMsg = "You Have no items in your menu";
                                }
                       }
                     mysqli_close($conn);  
                ?>
                          
                    <?php include("db_connect.php");
                        
                        

                    ?>
                        
                        
                        
                        </tbody>  
                            
                           
                               
                                
                            
                        </table>
                    </div>
                </div>
                
                        
                       
                        
                        
                    </div>
                </div>




               

                     
                    
            </div><!-- container -->
        </article>

    </section>