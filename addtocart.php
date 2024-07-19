<?php
// session_start();
include ('connect.php');
// $uid = isset($_SESSION["uid"]) ? $_SESSION["uid"] : null;
include ('header.php') ?>

<div class="container pt-4">
    <h2 id="head">Shopping Cart</h2>
</div>
<hr class="horizontal-line" style="margin-top:10px">


<?php
include ('connect.php');

$query = "SELECT `product`.*, `addtocart`.`quantity` FROM `product`,`addtocart` WHERE `product`.`id`=`addtocart`.`productid` AND `addtocart`.`userid`='$uid'";
$resultProduct = mysqli_query($con, $query);

if (!$resultProduct) {
    die("Error in SQL query: " . mysqli_error($con));
}

if (mysqli_num_rows($resultProduct) > 0) {
    while ($sqlProduct = mysqli_fetch_assoc($resultProduct)) {
        ?>

        <div class="container">
            <div class="row">
                <div class="col-md-4">

                    <img style="margin-bottom:40px;" width="50%" hight="200px" src="ajax/<?php echo $sqlProduct['images']; ?>">
                </div>
                <div class="col-md-6" id="text">

                    <h5>
                        <?php echo $sqlProduct['pname']; ?>
                    </h5>
                    <h5>
                        Price:
                        <?php echo $sqlProduct['price']; ?>
                    </h5>
                    <h6 style="margin-top:10px">Product details</h6>
                    <p style="margin-bottom: 1px;">
                        color:
                        <?php echo $sqlProduct['color']; ?>
                    </p>
                    <p style="margin-bottom: 1px;">
                        size:
                        <?php echo $sqlProduct['Sizes']; ?>
                    </p>
                    <p style="margin-bottom:1px;"> Coin:
                        <?php echo $sqlProduct['coins']; ?>
                    </p>
                    <p style="margin-bottom:1px;">
                        Discription:
                        <?php echo $sqlProduct['Discription']; ?>
                    </p>
                    <p>
                        Quantity:
                        <?php echo $sqlProduct['quantity']; ?>

                    </p>

                    <form action="">
                        <button type="submit" class="btn btn-outline-danger" style="margin-top=2px; "
                            onclick="removeInfo('<?php echo $sqlProduct['id']; ?>')">Remove</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <!-- Place Order button outside the loop, after all the products -->
    <div class="container">
        <div class="col-md-4">


            <!-- Example of Place Order button -->
            <a href="addcheckout.php?source=placeorder">
                <button style="margin-left: 437px; margin-bottom: 20px;" type="change add" class="btn btn-outline-danger"
                    onclick="redirectToaddcheckout()">PlaceOrder</button>
            </a>


        </div>
    </div>
    </div>
    <?php
} else {
    ?>
    <div class="container empty-cart-container">
        <div class="empty-cart-box">
            <p class="empty-cart-message">Your cart is empty. Please add products to your cart.</p>
        </div>
    </div>
    <style>
        .empty-cart-message {
            text-align: center;
            padding: 20px;
            border: 1px solid red;
            /* Change border color */
            margin: 50px auto;
            /* Adjust margin to center vertically */
            width: 50%;
            /* Adjust width as needed */
            color: red;
            /* Change text color */
        }
    </style>

    <?php
}
mysqli_close($con);
?>
<h1 id="first_heading" style="margin-top: 50px">Customers Also Bought</h1>
<div class="container">
    <div class="row">
        <div class="col-md-3 image">
            <div class="image-container">
                <img src="assets/images/c1.jpeg" alt="img" class="img-responsive">
                <div class="like-icon">
                    <i class="fas fa-heart"></i>
                </div>
            </div>
            <p class="mdow">White chanderi simple black border</p>
            <h6 class="rupee">₹900</h6>
        </div>
        <div class="col-md-3 image">
            <div class="image-container">
                <img src="assets/images/c2.jpeg" alt="img" class="img-responsive">
                <div class="like-icon">
                    <i class="fas fa-heart"></i>
                </div>
            </div>
            <p class="mdow">Pink hand batik large border saree</p>
            <h6 class="rupee">₹800</h6>
        </div>
        <div class="col-md-3 image">
            <div class="image-container">
                <img src="assets/images/c3.jpeg" alt="img" class="img-responsive">
                <div class="like-icon">
                    <i class="fas fa-heart"></i>
                </div>
            </div>
            <p class="mdow">Embroidered saree with green color saree</p>
            <h6 class="rupee">₹1000</h6>
        </div>
        <div class="col-md-3 image">
            <div class="image-container">
                <img src="assets/images/c4.jpeg" alt="img" class="img-responsive">
                <div class="like-icon">
                    <i class="fas fa-heart"></i>
                </div>
            </div>
            <p class="mdow">Georgette saree with golden border</p>
            <h6 class="rupee">₹890</h6>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    function removeInfo(productId) {
        var confirmation = confirm('Are you sure you want to remove this item from your cart?');
        if (confirmation) {
            // Send an AJAX request to remove the product from the database
            $.ajax({
                url: 'ajax/addtocartajax.php',
                type: 'POST',
                data: { productId: productId },
                success: function (response) {
                    var elementToRemove = $('#info_' + productId);
                    // Check if the element exists before attempting to remove it
                    if (elementToRemove.length) {
                        // Remove the element from the DOM
                        elementToRemove.remove();
                        // Display a success message dynamically
                        var successMessage = $('<p>').text('Product removed successfully.');
                        successMessage.css('color', 'green');
                        $('body').append(successMessage);
                    }
                    // Check if all products are removed, display a message and hide the Place Order button
                    if ($('.container .row').length === 0) {
                        $('.empty-cart-message').text('Your cart is empty. All products removed.');
                        $('.btn-outline-danger').hide();
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error('Error:', errorThrown);
                    alert('An error occurred. Please try again later.');
                }
            });
        }
    }
</script>

<script>
    function redirectToaddcheckout() {
        // Assuming the checkout page is 'checkout.php'
        window.location.href = 'addcheckout.php?source=cart';
    }
</script>





<?php include ('footer.php'); ?>