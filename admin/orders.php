
    <?php
session_start();
include("../db.php");

error_reporting(0);
if(isset($_GET['action']) && $_GET['action']!="" && $_GET['action']=='delete')
{
$order_id=$_GET['order_id'];

/*this is delet query*/
mysqli_query($con,"delete from order_detail where order_id='$order_id'")or die("delete query is incorrect...");
mysqli_query($con,"delete from orders_info where order_id='$order_id'")or die("delete query is incorrect...");
} 

///pagination
$page=$_GET['page'];

if($page=="" || $page=="1")
{
$page1=0;	
}
else
{
$page1=($page*10)-10;	
}

include "sidenav.php";
include "topheader.php";
?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <!-- your content here -->
          <div class="col-md-14">
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Orders  / Page <?php echo $page;?> </h4>
              </div>
              <div class="card-body">
                <div class="table-responsive ps">
                  <table class="table table-hover tablesorter " id="">
                    <thead class=" text-primary">
                      <tr><th>order_id</th><th>product_title</th><th>f_name</th><th>email</th><th>Address</th><th>city</th><th>product_price</th><th>qty</th>
                    </tr></thead>
                    <tbody>
                      <?php   
                        $result=mysqli_query($con,"SELECT orders_info.order_id,product_title, f_name, email, address, city, product_price, qty FROM 
                        order_detail,orders_info,products WHERE orders_info.order_id=order_detail.order_id and 
                        order_detail.product_id=products.product_id Limit $page1,10")or die ("query 1 incorrect.....");

                        while(list($order_id,$product_title,$f_name,$email,$address,$city,$product_price,$qty)=mysqli_fetch_array($result))
                        {	
                        echo "<tr><td>$order_id</td><td>$product_title</td><td>$f_name</td><td>$email</td><td>$address</td><td>$city</td><td>$product_price</td><td>$qty</td>

                        <td>
                        <a class=' btn btn-danger' href='orders.php?order_id=$order_id&action=delete'>Delete</a>
                        </td></tr>";
                        }
                        ?>
                    </tbody>
                  </table>
                  
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      <?php
include "footer.php";
?>