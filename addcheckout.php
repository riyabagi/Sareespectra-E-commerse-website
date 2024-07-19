<?php
include('header.php');
// session_start();
$uid = $_SESSION['uid'];
include('connect.php');


?>

<div class="container pt-4">
    <div class="row">
        <div class="col">
            <h1 id="head" class="check">CheckOut</h1>
            <hr style="margin-top: 0px">
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h2>Estimated Delivery On</h2>
            <div class="checkoutProducts">

                <?php
                // Display product details for the products in the user's cart
                $query = "SELECT `product`.*, `addtocart`.`quantity` 
                          FROM `product` 
                          JOIN `addtocart` ON `product`.`id` = `addtocart`.`productid` 
                          WHERE `addtocart`.`userid` = ?";
                $stmt = $con->prepare($query);
                $stmt->bind_param("s", $uid);
                $stmt->execute();
                $result = $stmt->get_result();
                $totalPrice = 0;
                $deliveryCharge = 40;
                $totalCoins = 0;
                while ($row = $result->fetch_assoc()) {
                    // Display product details for each product in the cart
                    $image = $row['images'];
                    $Discription = $row['Discription'];
                    $pname = $row['pname'];
                    $price = $row['price'];
                    $coin = $row['coins'];
                    $color = $row['colors'];
                    $Sizes = $row['Sizes'];
                    $quantity = $row['quantity'];


                    $totalPrice += ($price * $quantity);
                    $totalCoins += ($coin * $quantity);
                    displayProductDetails($con, $image, $pname, $price, $color, $Sizes, $coin, $Discription, $quantity);
                }

                $stmt->close();

                function displayProductDetails($con, $image, $pname, $price, $color, $Sizes, $coin, $Discription, $quantity)
                {
                    ?>
                    <!-- <div class="checkoutProductContainer"> -->
                    <div class="row pt-3">
                        <div class="col-md-3">
                            <?php if (!empty($image)): ?>
                                <img style="margin-top: 15px; width:100%; height:250px"
                                    src="ajax/<?php echo htmlspecialchars($image); ?>" alt="Product Image" id="singlepic">
                            <?php else: ?>
                                <p>No image available</p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-4" style="margin-top: 15px;">
                            <p style="margin-left: 10px; font-weight: bold; margin-bottom: 7px;">
                                <?php echo $pname; ?>
                            </p>
                            <p style="margin-left: 10px; font-weight: bold; margin-bottom: 7px;">Price:
                                <span style="font-weight: normal;">
                                    <?php echo $price; ?>
                                </span>
                            </p>
                            <p style="margin-left: 10px; margin-bottom: 7px;">Color:
                                <span style="font-weight: lighter;">
                                    <?php echo $color; ?>
                                </span>
                            </p>
                            <p style="margin-left: 10px; margin-bottom: 7px;">Size:
                                <span style="font-weight: lighter;">
                                    <?php echo $Sizes; ?>
                                </span>
                            </p>
                            <p style="margin-left: 10px; margin-bottom: 7px;">Coins:
                                <span style="font-weight: lighter;">
                                    <?php echo $coin; ?>
                                </span>
                            </p>
                            <p style="margin-left: 10px; margin-bottom: 7px;">Quantity:
                                <span style="font-weight: lighter;">
                                    <?php echo $quantity; ?>
                                </span>
                            </p>
                            <p style="margin-left: 10px; margin-bottom: 7px;">Description:
                                <span style="font-weight: lighter;">
                                    <?php echo $Discription; ?>
                                </span>

                        </div>


                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <div class="col-md-4">
            <h2>Delivery Address</h2>
            <div style="margin-top: 10px;" class="delivery-Address">
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
<div class="container pt-4">
    <div class="row">
        <div class="col-md-8">
            <h2 style="margin-top:50px">Order Details</h2>
            <?php
            // Calculate delivery charge
            $deliveryCharge = 40;

            // Calculate subtotal after subtracting coins
            $subtotal = max(0, $totalPrice - $totalCoins);

            // Display coins, delivery charge, and subtotal
            ?>
            <div style="margin-top:30px" class="order-summary">
                <p>Total Price: ₹
                    <?php echo $totalPrice; ?>
                </p>
                <p>Coins: ₹
                    <?php echo $totalCoins; ?>
                </p>
                <p>Delivery Charge: ₹
                    <?php echo $deliveryCharge; ?>
                </p>
                <hr style="width:150px; margin-top:20px">
                <p style="margin-top:20px;">Subtotal: ₹
                    <?php echo $subtotal; ?>
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col" style="margin-top: 15px; padding: 0px;">
                <h2>Payment Method</h2>
                <p>
                    <input type="radio" name="paymentMethod" id="creditCard" value="creditCard">
                    <label for="creditCard">
                        <i class="fa-solid fa-address-card"></i>
                        <span>Credit or Debit Card</span>
                    </label>
                </p>
                <p>
                    <input type="radio" name="paymentMethod" id="icicNetBanking" value="icicNetBanking">
                    <label for="icicNetBanking">
                        <span><i class="fa-regular fa-credit-card"></i></span>
                        <span>ICIC Net Banking</span>
                    </label>
                </p>
                <p>
                    <input type="radio" name="paymentMethod" id="googlePay" value="googlePay">
                    <label for="googlePay">
                        <span><i class="fa-brands fa-google-pay"></i></span>
                        <span>Google Pay</span>
                    </label>
                </p>
                <p>
                    <input type="radio" name="paymentMethod" id="payPal" value="payPal">
                    <label for="payPal">
                        <span><i class="fa-brands fa-paypal"></i></span>
                        <span>Pay Pal</span>
                    </label>
                </p>
                <p>
                    <input type="radio" name="paymentMethod" id="cashOnDelivery" value="cashOnDelivery">
                    <label for="cashOnDelivery">
                        <i class="fa-regular fa-money-bill-1"></i>
                        <span>Cash On Delivery</span>
                    </label>
                </p>

                <div style=" margin-top: 20px;">
                    <button type="change add" class="btn btn-outline-danger" id="placeorder" style="margin-top: 20px;">
                        Place Order</button>
                </div>

            </div>
        </div>
        <!-- Rest of the code for Order Details and Payment Method -->

        <?php include('footer.php'); ?>


        <?php include('footer.php'); ?>