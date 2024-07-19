<?php
include('header.php');
$uid = $_SESSION['uid'];
include('connect.php');



$productID = isset($_GET['id']) ? $_GET['id'] : null;
$color = isset($_GET['color']) ? $_GET['color'] : null;
$Sizes = isset($_GET['Sizes']) ? $_GET['Sizes'] : null;
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : null;
$supprice = isset($_GET['supprice']) ? $_GET['supprice'] : null;

$totalPrice = 0;
$deliveryCharge = 40;

$sql22 = "SELECT type FROM `registration` WHERE id = $uid";
$result22 = mysqli_query($con, $sql22);

if ($result22) {
    $userData2 = mysqli_fetch_assoc($result22);
    $userType = isset($userData2['type']) ? $userData2['type'] : 'user';
    mysqli_free_result($result22);
}

?>
<div class="container pt-4">
    <div class="row">
        <div class="col">
            <h1 id="head" class=check>CheckOut</h1>
            <hr style="margin-top:0px">
        </div>
        <div class="row">
            <div class="col-md-8">
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
                            $image = isset($_GET['image']) ? urldecode($_GET['image']) : null;
                            ?>

                            <div class="img">
                                <?php if (!empty($imagePath)): ?>
                                    <img style="margin-top: 15px;" src="<?php echo $image; ?>" alt="poster" id="singlepic">
                                <?php else: ?>
                                    <p>No image available</p>
                                <?php endif; ?>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="product-description">
                            <p style=" margin-left: 10px; font-weight:bold;">
                                <?php echo $pname; ?>
                            </p>
                            <p style=" margin-left: 10px;font-weight:bold; ">
                                Price:
                                <?php echo $price; ?>
                            </p>
                            <!-- <p style=" margin-left: 10px;font-weight:bold; ">
                                supplier price:
                                <?php echo $supprice; ?>
                            </p> -->
                            <?php if ($color !== "undefined"): ?>
                                <p style="margin-left: 10px; font-weight:bold;">
                                    Color:
                                    <?php echo $color; ?>
                                </p>
                            <?php endif; ?>
                            <p style=" margin-left: 10px; font-weight:bold;">
                                Size:
                                <?php echo $Sizes; ?>
                            </p>
                            <p style=" margin-left: 10px; font-weight:bold;" id="quan">
                                quantity:
                                <?php echo $quantity; ?>
                            </p>
                            <p style=" margin-left: 10px; font-weight:bold;" id="coi">
                                Coins:
                                <?php echo $coin; ?>
                            </p>
                            <p style=" margin-left: 10px; font-weight:bold;">
                                <?php echo $Discription; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h2>Delivery Address</h2>
                <div style=" margin-top: 10px;" class="deliveryAddress">

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
                    window.location.href = 'profile.php#add';
                }
            </script>

        </div>
    </div>
</div>

<div class="container pt-4">
    <div class="row">
        <div class="col-md-8">
            <?php if ($userType === 'supplier'): ?>
                <h2 style="margin-top:20px">Order details</h2>
                <?php
                $subtotal = $price / 2 + $deliveryCharge;
                $finalTotal = max(0, $subtotal);
                ?>
                <p id="price">coins:
                    <?php echo $price / 2; ?>
                </p>
                <p id="deliveryCharge">Delivery:
                    <?php echo $deliveryCharge; ?>


                <p style="margin-top: 7px" id="finalTotal">Total Coins:
                    <?php echo $finalTotal; ?>
                </p>

                <div style=" margin-top: 20px;">
                    <button type="change add" class="btn btn-outline-danger" id="placeorder">
                        Place Order</button>



                    <input type="hidden" id="walletCoins" value="<?php echo $walletCoins; ?>">

                    <input type="hidden" id="walletCoins" value="<?php echo $walletCoins; ?>">

                    <script>
                        $(document).ready(function () {
                            $('#placeorder').click(function () {
                                var walletCoins = parseInt($('#walletCoins').val()) || 0;
                                var finalTotalCoins = parseInt('<?php echo $finalTotal; ?>') || 0;

                                if (finalTotalCoins > walletCoins) {
                                    alert('Insufficient coins. Buy more coins to proceed.');

                                    window.location.href = 'wallet.php';
                                } else {
                                    alert('Order placed sucssesfully')
                                }
                            });
                        });
                    </script>


                </div>
            <?php else: ?>
                <h2 style="margin-top:20px">Order details</h2>
                <?php
                $quantity = isset($_GET['quantity']) ? (int) $_GET['quantity'] : 1; // Default quantity is 1
            
                $subtotal = $price * $quantity;
                $total = $subtotal + $deliveryCharge;

                ?>
                <p id="price">Price: ₹
                    <?php echo $price; ?>
                </p>
                <p id="quantity">quantity:
                    <?php echo $quantity; ?>
                </p>
                <p id="subtotal1">Subtotal: ₹
                    <?php echo $subtotal; ?>
                </p>
                <p id="deliveryCharge">Delivery: ₹
                    <?php echo $deliveryCharge; ?>
                </p>

                <p>
                    <button class="btn btn-outline-danger" id="usecoins">
                        Use coins</button>
                </p>
                <p id="coinsInput" style="display: none;">
                    <label for="coins">Enter the number of coins:</label>
                    <input type="number" id="coins" name="coins" style="width:100px; margin-bottom: 10px"
                        class="form-control" required>
                    <button class="btn btn-outline-danger" id="use">
                        Use </button>
                </p>
                <p id="finalTotal">Total: ₹
                    <?php echo $total; ?>
                </p>
            <?php endif; ?>
            <?php
            $coinQuery = "SELECT coin FROM `registration` WHERE id = $uid";
            $coinResult = mysqli_query($con, $coinQuery);

            if ($coinResult) {
                $coinData = mysqli_fetch_assoc($coinResult);
                $userCoins = isset($coinData['coin']) ? $coinData['coin'] : 0;
                mysqli_free_result($coinResult);
            } else {
                $userCoins = 0;
            }
            ?>
            <script>

            </script>

        </div>

        <?php if ($userType === 'supplier'): ?>

        <?php else: ?>

            <div class=col-md-4 style="margin-top: 15px; padding: 0px;">
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
                <?php endif; ?>

                <script>
                    var userCoins = <?php echo $userCoins; ?>;

                    $(document).ready(function () {

                        $("#usecoins").click(function () {
                            $("#coinsInput").toggle();
                        });

                        document.getElementById("use").addEventListener("click", function () {
                            var enteredCoins = document.getElementById("coins").value;
                            console.log("Entered Coins: ", enteredCoins);

                            if (userCoins < enteredCoins) {
                                alert('Insufficient coins. Buy more coins to proceed.');
                            }
                        });


                        // });
                        $("#placeorder").click(function () {
                            <?php

                            if (
                                $userDetails['firstname'] === "" ||
                                $userDetails['lastname'] === "" ||
                                $userDetails['houseno'] === "" ||
                                $userDetails['area'] === "" ||
                                $userDetails['city'] === "" ||
                                $userDetails['state'] === "" ||
                                $userDetails['pincode'] === ""
                            ) {
                                echo "alert('Address details are incomplete. Please update your profile.');";
                            } else {
                                ?>
                                let color = "<?php echo $color; ?>";
                                let Sizes = "<?php echo $Sizes; ?>";
                                let quantity = $("#quan").text().trim().split(':')[1].trim();
                                let coin = $("#coi").text().trim().split(':')[1].trim();
                                var price = $("#price").text().split("₹")[1].trim();
                                var deliveryCharge = $("#deliveryCharge").text().split("₹")[1].trim();
                                var subtotal = $("#subtotal1").text().split("₹")[1].trim();
                                var coinsUsedText = $("#coinsUsed").text().trim();
                                var coinsUsed = parseInt(coinsUsedText.replace(/\D/g, ''), 10);
                                var finalTotal = $("#finalTotal").text().split("₹")[1].trim();
                                let paymentMethodText = $('input[name="paymentMethod"]:checked +label').text().trim();
                                var enteredCoins = document.getElementById("coins").value;

                                var currentDate = new Date();
                                var day = currentDate.getDate();
                                var month = currentDate.getMonth() + 1;
                                var year = currentDate.getFullYear();
                                var hours = currentDate.getHours();
                                var minutes = currentDate.getMinutes();
                                var formattedDateTime = `${day}/${month}/${year}\t${hours}:${minutes}`;

                                let orderDetails = {
                                    userid: "<?php echo isset($_SESSION['uid']) ? $_SESSION['uid'] : ''; ?>",
                                    productId: "<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>",
                                    color: color,
                                    Sizes: Sizes,
                                    quantity: quantity,
                                    coin: coin,
                                    paymentMethod: paymentMethodText,
                                    price: price,
                                    deliveryCharge: deliveryCharge,
                                    subtotal: subtotal,
                                    // coinsUsed: coinsUsed,
                                    finalTotal: finalTotal,
                                    date: formattedDateTime,
                                    enteredCoins: enteredCoins,
                                };

                                if ($('input[name="paymentMethod"]:checked').length === 0) {
                                    alert("Please select a payment method.");
                                }
                                if (userCoins < enteredCoins) {
                                    alert('Insufficient coins. Buy more coins to proceed.');
                                    window.location.href = 'wallet.php';

                                } else {
                                    $.ajax({
                                        url: './ajax/orderajax.php',
                                        method: "POST",
                                        data: orderDetails,
                                        dataType: 'json',
                                        success: function (res) {
                                            console.log(res)
                                            if (res.success) {
                                                alert(res.message);
                                            } else {
                                                alert(res.message);  // Display the failure message
                                            }
                                        },
                                        error: function (err) {
                                            console.log(err);
                                            alert("Error placing order");
                                        }
                                    });
                                }
                                <?php
                            }
                            ?>
                        });
                    });
                </script>

            </div>
        </div>
    </div>
</div>

<?php include('footer.php');
?>