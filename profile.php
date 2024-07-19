<?php
include('header.php');

include('connect.php');
$uid = $_SESSION['uid'];
$query = "SELECT * FROM `registration` WHERE `id` = $uid";
$result = mysqli_query($con, $query);

if ($result) {
    $userData = mysqli_fetch_assoc($result);
} else {

    echo "Error: " . mysqli_error($con);
}


?>


<!-----------------------------------------javascript code---------------------------------->
<script>
    $(document).ready(function () {
        $('#detail').click(function () {
            $('#myDetails').show();
            $('#myAddress').hide();
            $('#myorders').hide();
        });

        $('#add').click(function () {
            $('#myDetails').hide();
            $('#myAddress').show();
            $('#myorders').hide();
        });

        $('#order').click(function () {
            $('#myDetails').hide();
            $('#myAddress').hide();
            $('#myorders').show();
        });

    });
</script>

<!----------------------------------------- profile my details ---------------------------------->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<div class="profile">
    <div class="container">
        <div class="row">
            <div class="col-12 py-3" id="mydetailstoprow">
                <h1>MY ACCOUNT</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3" id="mydetailsrow2">
                <ul class="ul-lits" style="margin-top: 10px">
                    <li id="detail">
                        My Details
                    </li>
                    <li id="add">
                        My Address
                    </li>
                    <li id="order">
                        My Orders
                    </li>
                </ul>
            </div>

            <div class="col-md-9" id="myDetails">
                <div class="rightsection bg-white p-3">
                    <h3>My Details</h3>
                    <p> Personal Information</p>
                    <hr>
                    <div class="row">
                        <div class="col-5">
                            <label>First name</label>
                            <input type="text" class="form-control" id="dfname"
                                value="<?php echo $userData['firstname']; ?>">
                        </div>

                        <div class="col-5">
                            <label>Last name</label>
                            <input type="text" class="form-control" id="dlname"
                                value="<?php echo $userData['lastname']; ?>">
                        </div>
                    </div>

                    <div class="col-5" id="profileformargin">
                        <label>Birth date</label>
                        <input type="text" class="form-control" id="dbirth"
                            value="<?php echo $userData['birthdate']; ?>">
                    </div>

                    <div class="col-5" id="profileformargin">
                        <label>Phone number</label>
                        <input type="tel" class="form-control" id="dnumber" value="<?php echo $userData['mobile']; ?>">
                    </div>

                    <?php if ($userData['type'] === 'supplier'): ?>
                        <h3 id="profileformargin2">Company Information</h3>
                        <hr>
                        <div class="col-5" id="profileformargin">
                            <label>Company Name</label>
                            <input type="text" class="form-control" id="dcompany"
                                value="<?php echo $userData['companyname']; ?>">
                        </div>

                        <div class="col-5" id="profileformargin">
                            <label>Company Address</label>
                            <input type="text" class="form-control" id="dcompanyaddress"
                                value="<?php echo $userData['companyadress']; ?>">
                        </div>
                    <?php endif; ?>

                    <h3 id="profileformargin2">E-mail Address</h3>
                    <hr>
                    <div class="col-5" id="profileformargin">
                        <label>E-mail</label>
                        <input type="email" class="form-control" id="demail" aria-describedby="emailHelp"
                            value="<?php echo $userData['email']; ?>">
                    </div>

                    <div class="col" id="profileformargin2">
                        <button type="submit" class="btn btn-outline-danger" id="save">SAVE</button>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function () {
                    $("#save").click(function () {
                        let dfname = $("#dfname").val();
                        let dlname = $("#dlname").val();
                        let dbirth = $("#dbirth").val();
                        let dnumber = $("#dnumber").val();
                        let demail = $("#demail").val();
                        let dcompany = $("#dcompany").val(); // Added for supplier
                        let dcompanyaddress = $("#dcompanyaddress").val(); // Added for supplier

                        $.ajax({
                            url: './ajax/profiledetailsajax.php',
                            method: "POST",
                            data: {
                                dfname: dfname,
                                dlname: dlname,
                                dbirth: dbirth,
                                dnumber: dnumber,
                                demail: demail,
                                dcompany: dcompany, // Added for supplier
                                dcompanyaddress: dcompanyaddress // Added for supplier
                            },
                            success: function (res) {
                                alert(res);
                            },
                            error: function (err) {
                                alert(err);
                            }
                        });
                    });
                });
            </script>

            <div class="col-md-9" id="myAddress" style="display:none;">
                <div class="rightsection bg-white p-3">
                    <div class="row">
                        <div class="col-md-4">
                            <h3>My Address </h3>
                            <p> Location</p>
                        </div>
                        <div class="col-md-7"></div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-outline-danger" style="margin-top: 10px;">EDIT</button>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4">
                            <label>State</label>
                            <input id="state" type="text" class="form-control"
                                value="<?php echo $userData['state']; ?>">
                        </div>

                        <div class="col-4">
                            <label>City</label>
                            <input id="city" type="text" class="form-control" value="<?php echo $userData['city']; ?>">
                        </div>

                        <div class="col-4">
                            <label>Pin code</label>
                            <input id="pin" type="text" class="form-control"
                                value="<?php echo $userData['pincode']; ?>">

                        </div>
                    </div>
                    <div class="col-12" id="profileformargin">
                        <label>Road name, area, colony</label>
                        <input id="area" type="text" class="form-control" value="<?php echo $userData['area']; ?>">
                    </div>

                    <div class="col-12" id="profileformargin">
                        <label>House number/building name</label>
                        <input id="houseno" type="text" class="form-control"
                            value="<?php echo $userData['houseno']; ?>">
                    </div>

                    <div class="col" id="profileformargin2">
                        <button type="submit" id="save1" class="btn btn-outline-danger">SAVE</button>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function () {
                    $("#save1").click(function () {
                        let state = $("#state").val();
                        let city = $("#city").val();
                        let pin = $("#pin").val();
                        let area = $("#area").val();
                        let houseno = $("#houseno").val();

                        $.ajax({
                            url: './ajax/profileaddressajax.php',
                            method: "POST",
                            data: {
                                state: state,
                                city: city,
                                pin: pin,
                                area: area,
                                houseno: houseno,
                            },
                            success: function (res) {
                                alert(res)
                            },
                            error: function (err) {
                                alert(err)
                            }
                        })
                    })
                })
            </script>
            <!-- ------------------------------------------------------------- -->


            <div class="col-md-9" id="myorders" style="display:none;">
                <div class="rightsection bg-white p-3">
                    <h2 id="head">My Order</h2>


                    <?php
                    $sqlOrders = "SELECT orders.*, product.pname, product.images FROM orders
                 JOIN product ON orders.productid = product.id
                 WHERE orders.uid = $uid";


                    $resultOrders = mysqli_query($con, $sqlOrders);

                    if ($resultOrders && mysqli_num_rows($resultOrders) > 0) {
                        while ($order = mysqli_fetch_assoc($resultOrders)) {
                            // Display order information for each order
                            ?>
                            <div class="row" style="padding: 0 10px 20px 10px; background-color: rgba(169, 169, 169, 0.05);">
                                <div class="col-md-3 pt-4">
                                    <?php
                                    // Assuming $order['images'] is a comma-separated string of image URLs
                                    $imageArray = explode(',', $order['images']);
                                    $firstImage = isset($imageArray[0]) ? trim($imageArray[0]) : null;
                                    ?>
                                    <img src="ajax/<?php echo htmlspecialchars($firstImage); ?>" alt="Product Image"
                                        id="singlepic" width="100%" height="265px">

                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-5 pt-4 product-description" id="text">
                                    <h6>
                                        <?php echo $order['pname']; ?>
                                    </h6>
                                    <h6>₹
                                        <?php echo $order['price']; ?>
                                    </h6>
                                    <p style="margin-bottom: 5px;">Color:
                                        <?php echo $order['color']; ?>
                                    </p>
                                    <p style="margin-bottom: 5px;">Qty:
                                        <?php echo $order['Quantity']; ?>
                                    </p>
                                    <p style="margin-bottom: 5px;">Deliverycharge:
                                        <?php echo $order['deliverycharge']; ?>
                                    </p>
                                    <p style="margin-bottom: 5px;">Size:
                                        <?php echo $order['size']; ?>
                                    </p>
                                    <p style="margin-bottom: 5px;">Coins Gained:
                                        <?php echo $order['coinsgained']; ?>
                                    </p>
                                    <p style="margin-bottom: 5px;">Total:
                                        <?php echo $order['total']; ?>
                                    </p>
                                    <p style="margin-bottom: 5px;">Payment method:
                                        <?php echo $order['pamentmeathod']; ?>
                                    </p>
                                    <p style="margin-bottom: 5px;">Delivered on:
                                        <?php echo $order['date']; ?>
                                    </p>
                                </div>

                                <div class="col-md-1"></div>
                                <div class="col-md-2">
                                    <button type="submit" onclick="redirectTosingle('<?php echo $order['productid']; ?>')"
                                        class="btn btn-outline-danger" style="margin-top: 60px;">Buy it again</button>
                                    <button type="submit" onclick="redirectToratereview('<?php echo $order['productid']; ?>')"
                                        class="btn btn-outline-danger" style="margin-top: 30px;">Rate & review</button>
                                </div>

                                <script>
                                    function redirectTosingle(productId) {
                                        // Redirect to single.php with the product ID
                                        window.location.href = 'single.php?id=' + productId;
                                    }

                                    function redirectToratereview(productId) {
                                        // Redirect to ratereview.php with the product ID
                                        window.location.href = 'ratereview.php?id=' + productId;
                                    }
                                </script>


                            </div>

                            <?php
                        }
                    } else {
                        echo "<p>No orders found</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php');
?>

</html>