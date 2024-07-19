<?php
session_start();
$uid = $_SESSION['uid'];
include('connect.php');

include('header.php');

$productID = isset($_GET['id']) ? $_GET['id'] : null;
$color = isset($_GET['color']) ? $_GET['color'] : null;
$Sizes = isset($_GET['Sizes']) ? $_GET['Sizes'] : null;
$totalPrice = 0;
$deliveryCharge = 40;
$coins = 30;
?>
<div class="container pt-4">
    <div class="row">
        <div class="col">
            <h1 id="head" class=check>CheckOut</h1>
            <hr style="margin-top:0px">
        </div>
        <div class="row">
            <div class="col-md-8">
                <!-- <i class="fa-sharp fa-regular fa-truck"></i> -->
                <h2>Estimated Delivery On</h2>
                <div class="checkoutProducts">

                    <?php

                    $exc = mysqli_query($con, "SELECT * FROM `product` WHERE id='$productID'");
                    while ($row = mysqli_fetch_assoc($exc)) {
                        $image = $row['images'];
                        $Discription = $row['Discription'];
                        $pname = $row['pname'];
                        $price = $row['price'];
                        $coin = $row['coins'];
                    }

                    ?>

                    <div class="checkoutProductContainer">
                        <?php
                        $id = isset($_GET['id']) ? $_GET['id'] : null;
                        $sqlProduct = "SELECT * FROM product WHERE id = $id";
                        $resultProduct = mysqli_query($con, $sqlProduct);

                        if (!$resultProduct) {
                            die("Error in SQL query: " . mysqli_error($con));
                        }
                        $product = mysqli_fetch_assoc($resultProduct);

                        if ($product) {

                            $images = explode(',', $product['images']);

                            $firstImage = !empty($images) ? reset($images) : null; // Get the first image
                        


                            $imagePath = !empty($firstImage) ? 'ajax/' . htmlspecialchars($firstImage) : '';
                            ?>

                            <div class="img">
                                <?php if (!empty($imagePath)): ?>
                                    <img style="margin-top: 15px;" src="<?php echo $imagePath; ?>" alt="poster" id="singlepic">
                                <?php else: ?>
                                    <p>No image available</p>
                                <?php endif; ?>
                            </div>
                            <?php
                        }
                        ?>




                        <div class="product-description">
                            <p style=" margin-left: 10px;">
                                <?php echo $pname; ?>
                            </p>
                            <p style=" margin-left: 10px;">
                                <?php echo $price; ?>
                            </p>
                            <p style=" margin-left: 10px;">
                                <?php echo $color; ?>
                            </p>
                            <p style=" margin-left: 10px;">
                                <?php echo $Sizes; ?>
                            </p>
                            <p style=" margin-left: 10px;">
                                <?php echo $coins; ?>
                            </p>
                            <p style=" margin-left: 10px;">
                                <?php echo $Discription; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h2>Delivery Address</h2>
                <div style=" margin-top: 10px;" class="delivery-Address">

                    <?php

                    $getUserDetailsQuery = "SELECT * FROM `registration` WHERE `id` = ?";
                    $stmt = $con->prepare($getUserDetailsQuery);
                    $stmt->bind_param("s", $uid);
                    $stmt->execute();
                    $userDetailsResult = $stmt->get_result();

                    if ($userDetailsResult->num_rows > 0) {
                        $userDetails = $userDetailsResult->fetch_assoc();
                        echo "<p>" . $userDetails['firstname'] . " " . $userDetails['lastname'] . "</p>";
                        echo "<p>" . $userDetails['houseno'] . "</p>";
                        echo "<p>" . $userDetails['area'] . "</p>";
                        echo "<p>" . $userDetails['city'] . ", " . $userDetails['state'] . ", " . $userDetails['pincode'] .
                            "</p>";
                        ?>
                        <p>India</p>
                        <?php
                    }
                    ?>

                    <div>
                        <button type="change add" class="btn btn-outline-danger"
                            onclick="showAddressSection()">Edit</button>
                    </div>
                </div>
            </div>
            <script>
                function showAddressSection() {
                    // Change 'profile.php' to the actual file path of your profile page
                    window.location.href = 'profile.php#add';
                }
            </script>

        </div>
    </div>
</div>

<div class="cointener">
    <div class="row">
        <div class="col-md-8">
            <h2 style="margin-top: 20px;">Order Details</h2>
            <?php
            $subtotal = $price + $deliveryCharge;
            $finalTotal = max(0, $subtotal - $coins);
            ?>
            <p>Price: ₹
                <?php echo $price; ?>
            </p>
            <p>Delivery: ₹
                <?php echo $deliveryCharge; ?>
            </p>
            <p>Subtotal: ₹
                <?php echo $subtotal; ?>
            </p>
            <p>Coins Used:
                <?php echo $coins; ?>
            </p>
            <p>Total: ₹
                <?php echo $finalTotal; ?>
            </p>
            <!-- Add other order details as needed -->
        </div>
    </div>
    <div class="container">
        <div class=col-md-4 style="margin-top: 15px; padding: 0px;">
            <h2>Payment Method</h2>
            <p>
                <i class="fa-solid fa-address-card"></i>
                <span>Credit or Debit Card</span>
                <span><button type="submit" class="btn btn-outline-danger"></button></span>
            </p>
            <p>
                <span> <i class="fa-regular fa-credit-card"> </i></span>
                <span>ICIC Net Banking</span>
                <span><button type="submit" class="btn btn-outline-danger"></button></span>
            </p>
            <p>
                <span> <i class="fa-brands fa-google-pay"> </i></span>
                <span>Google Pay</span>
                <span><button type="submit" class="btn btn-outline-danger"></button></span>
            </p>
            <p>
                <span> <i class="fa-brands fa-paypal"> </i></span>
                <span>Pay Pal</span>
                <span><button type="submit" class="btn btn-outline-danger"></button></span>
            </p>
            <p>
                <i class="fa-regular fa-money-bill-1"></i>
                <span>Cash On Delivery</span>
                <span><button type="submit" class="btn btn-outline-danger"></button></span>
            </p>
        </div>


        <div style=" margin-top: 20px;">
            <button type="change add" class="btn btn-outline-danger center-button">Place Order</button>
        </div>
    </div>
</div>
<?php include('footer.php');
?>