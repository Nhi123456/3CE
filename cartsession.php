<?php
    session_start();
    include "db.php";

    if(isset($_POST["addToCart"])){

        $p_id = $_POST["proId"];
        $sql = "SELECT * FROM products WHERE product_id = '$p_id'";
		$run_query = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($run_query);
        $product_price = $row["product_price"];
        $product_title = $row["product_title"];
        $product_image = $row["product_image"];

		if(isset($_SESSION["uid"])){

            $user_id = $_SESSION["uid"];
        }

            if(isset($_SESSION["cart"][$p_id])){
                echo "
                    <div class='alert alert-warnin
                    '>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <b>Product is already added into the cart Continue Shopping..!</b>
                    </div>
                ";
            }else {
                    
                    $_SESSION["price"][$p_id] = $product_price;
                    $_SESSION["product_title"][$p_id] = $product_title;
                    $_SESSION["product_image"][$p_id] = $product_image;
                    $_SESSION["cart"][$p_id] = $p_id;
                    $_SESSION["qty"][$p_id] = 1;

                    if(mysqli_query($con,$sql)){
                        echo "
                            <div class='alert alert-success'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                <b>Product is Added..!</b>
                            </div>
                        ";
                    }
                }
        // }
        // else{

		// 	if (isset($_SESSION["cart"][$p_id])) {
		// 		echo "
		// 			<div class='alert alert-warning'>
		// 					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		// 					<b>Product is already added into the cart Continue Shopping..!</b>
		// 			</div>";
		// 			exit();
		// 	}

        //     $_SESSION["price"][$p_id] = $price;
        //     $_SESSION["cart"][$p_id] = $p_id;
        //     $_SESSION["qty"][$p_id] = 1;
		// 	if (mysqli_query($con,$sql)) {
		// 		echo "
		// 			<div class='alert alert-success'>
		// 				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		// 				<b>Your product is Added Successfully..!</b>
		// 			</div>
		// 		";
		// 		exit();
		// 	}
			
		// }
				
    }

    //Count cart item
    if (isset($_POST["count_item"])) {
        //When user is logged in then we will count number of item in cart by using user session id
        $count = is_array($_SESSION["cart"]) ? count($_SESSION["cart"]) : 0;
        
        echo $count;
        exit();
    }
    //Count cart item

    //Remove Item From cart
    if (isset($_POST["removeItemFromCart"])) {
        unset($_SESSION["qty"]);
        unset($_SESSION["price"]);
        unset($_SESSION["title"]);
        unset($_SESSION["cart"]);
        unset($_SESSION["image"]);
      
    }

    //Get Cart Item From Database to Dropdown menu
    if (isset($_POST["Common"])) {

        // if (isset($_SESSION["uid"])) {
        //     //When user is logged in this query will execute
        //     $sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.user_id='$_SESSION[uid]'";
        // }else{
        //     //When user is not logged in this query will execute
        //     $sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.ip_add='$ip_add' AND b.user_id < 0";
        // }
        // $query = mysqli_query($con,$sql);

        if (isset($_POST["getCartItem"])) {
            //display cart item in dropdown menu
            if (mysqli_num_rows($query) > 0) {
                $n=0;
                $total_price=0;
                while ($row=mysqli_fetch_array($query)) {
                    
                    $n++;
                    $product_id = $row["product_id"];
                    $product_title = $row["product_title"];
                    $product_price = $row["product_price"];
                    $product_image = $row["product_image"];
                    $cart_item_id = $row["id"];
                    $qty = $row["qty"];
                    $total_price=$total_price+$product_price;
                    echo '
                        
                        
                        <div class="product-widget">
                                                    <div class="product-img">
                                                        <img src="product_images/'.$product_image.'" alt="">
                                                    </div>
                                                    <div class="product-body">
                                                        <h3 class="product-name"><a href="#">'.$product_title.'</a></h3>
                                                        <h4 class="product-price"><span class="qty">'.$n.'</span>$'.$product_price.'</h4>
                                                    </div>
                                                    
                                                </div>'
                        
                        
                        ;
                    
                }
                
                echo '<div class="cart-summary">
                        <small class="qty">'.$n.' Item(s) selected</small>
                        <h5>$'.$total_price.'</h5>
                    </div>'
                ?>
                    
                    
                <?php
                
                exit();
            }
        }
        
               
        if (isset($_POST["checkOutDetails"])) {
            $count = is_array($_SESSION["cart"]) ? count($_SESSION["cart"]) : 0;
            

            if ($count > 0) {
                //display user cart item with "Ready to checkout" button if user is not login
                echo '<div class="main ">
                <div class="table-responsive">
                <form method="post" action="login_form.php">
                
                    <table id="cart" class="table table-hover table-condensed" id="">
                        <thead>
                            <tr>
                                <th style="width:50%">Product</th>
                                <th style="width:10%">Price</th>
                                <th style="width:8%">Quantity</th>
                                <th style="width:7%" class="text-center">Subtotal</th>
                                <th style="width:10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                        ';
                    $n=0;

                    foreach($_SESSION["cart"] as $p_id){
                        $product_id = $_SESSION["cart"][$p_id];
                        $product_title = $_SESSION["product_title"][$p_id];
                        $product_price = $_SESSION["price"][$p_id];
                        $product_image = $_SESSION["product_image"][$p_id];
                        // $cart_item_id = $row["id"];
                        $qty = $_SESSION["qty"][$p_id];
                        // $total_price=$total_price+$product_price;

                        echo 
                            '
                                
                            <tr>
                                <td data-th="Product" >
                                    <div class="row">
                                    
                                        <div class="col-sm-4 "><img src="product_images/'.$product_image.'" style="height: 70px;width:75px;"/>
                                        <h4 class="nomargin product-name header-cart-item-name"><a href="product.php?p='.$product_id.'">'.$product_title.'</a></h4>
                                        </div>
                                        <div class="col-sm-6">
                                            <div style="max-width=50px;">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                </td>
                                <input type="hidden" name="product_id[]" value="'.$product_id.'"/>
                             
                                <td data-th="Price"><input type="text" class="form-control price" value="'.$product_price.'" readonly="readonly"></td>
                                <td data-th="Quantity">
                                    <input type="text" class="form-control qty" value="'.$qty.'" >
                                </td>
                                <td data-th="Subtotal" class="text-center"><input type="text" class="form-control total" value="'.$product_price.'" readonly="readonly"></td>
                                <td class="actions" data-th="">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-info btn-sm update" update_id="'.$product_id.'"><i class="fa fa-refresh"></i></a>
                                    
                                    <a href="#" class="btn btn-danger btn-sm remove" remove_id="'.$product_id.'"><i class="fa fa-trash-o"></i></a>		
                                </div>							
                                </td>
                            </tr>
                        
                                
                                ';
                    }

                    // while ($row=mysqli_fetch_array($query)) {
                    //     $n++;
                    //     $product_id = $row["product_id"];
                    //     $product_title = $row["product_title"];
                    //     $product_price = $row["product_price"];
                    //     $product_image = $row["product_image"];
                    //     $cart_item_id = $row["id"];
                    //     $qty = $row["qty"];

                    //     echo 
                    //         '
                                
                    //         <tr>
                    //             <td data-th="Product" >
                    //                 <div class="row">
                                    
                    //                     <div class="col-sm-4 "><img src="product_images/'.$product_image.'" style="height: 70px;width:75px;"/>
                    //                     <h4 class="nomargin product-name header-cart-item-name"><a href="product.php?p='.$product_id.'">'.$product_title.'</a></h4>
                    //                     </div>
                    //                     <div class="col-sm-6">
                    //                         <div style="max-width=50px;">
                    //                         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
                    //                         </div>
                    //                     </div>
                                        
                                        
                    //                 </div>
                    //             </td>
                    //             <input type="hidden" name="product_id[]" value="'.$product_id.'"/>
                    //             <input type="hidden" name="" value="'.$cart_item_id.'"/>
                    //             <td data-th="Price"><input type="text" class="form-control price" value="'.$product_price.'" readonly="readonly"></td>
                    //             <td data-th="Quantity">
                    //                 <input type="text" class="form-control qty" value="'.$qty.'" >
                    //             </td>
                    //             <td data-th="Subtotal" class="text-center"><input type="text" class="form-control total" value="'.$product_price.'" readonly="readonly"></td>
                    //             <td class="actions" data-th="">
                    //             <div class="btn-group">
                    //                 <a href="#" class="btn btn-info btn-sm update" update_id="'.$product_id.'"><i class="fa fa-refresh"></i></a>
                                    
                    //                 <a href="#" class="btn btn-danger btn-sm remove" remove_id="'.$product_id.'"><i class="fa fa-trash-o"></i></a>		
                    //             </div>							
                    //             </td>
                    //         </tr>
                        
                                
                    //             ';
                    // }
                    
                    echo '</tbody>
                    <tfoot>
                        
                        <tr>
                            <td><a href="store.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                            <td colspan="2" class="hidden-xs"></td>
                            <td class="hidden-xs text-center"><b class="net_total" ></b></td>
                            <div id="issessionset"></div>
                            <td>                                
                                ';
                    if (!isset($_SESSION["uid"])) {
                        echo '
                        
                                <a href="" data-toggle="modal" data-target="#Modal_register" class="btn btn-success">Ready to Checkout</a></td>
                                    </tr>
                                </tfoot>
                    
                                </table></div></div>';
                    }else if(isset($_SESSION["uid"])){
                        //Paypal checkout form
                        echo '
                        </form>
                        
                            <form action="checkout.php" method="post">
                                <input type="hidden" name="cmd" value="_cart">
                                <input type="hidden" name="business" value="shoppingcart@puneeth.com">
                                <input type="hidden" name="upload" value="1">';
                                
                                $x=0;
                                $sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.user_id='$_SESSION[uid]'";
                                $query = mysqli_query($con,$sql);
                                while($row=mysqli_fetch_array($query)){
                                    $x++;
                                    echo  	

                                        '<input type="hidden" name="total_count" value="'.$x.'">
                                        <input type="hidden" name="item_name_'.$x.'" value="'.$row["product_title"].'">
                                        <input type="hidden" name="item_number_'.$x.'" value="'.$x.'">
                                        <input type="hidden" name="amount_'.$x.'" value="'.$row["product_price"].'">
                                        <input type="hidden" name="quantity_'.$x.'" value="'.$row["qty"].'">';
                                    }
                                
                                echo   
                                    '<input type="hidden" name="return" value="http://localhost/myfiles/public_html/payment_success.php"/>
                                        <input type="hidden" name="notify_url" value="http://localhost/myfiles/public_html/payment_success.php">
                                        <input type="hidden" name="cancel_return" value="http://localhost/myfiles/public_html/cancel.php"/>
                                        <input type="hidden" name="currency_code" value="USD"/>
                                        <input type="hidden" name="custom" value="'.$_SESSION["uid"].'"/>
                                        <input type="submit" id="submit" name="login_user_with_product" name="submit" class="btn btn-success" value="Ready to Checkout">
                                        </form></td>
                                        
                                        </tr>
                                        
                                        </tfoot>
                                        
                                </table></div></div>    
                                    ';
                    }
            }
        }
        
    }
    ?>