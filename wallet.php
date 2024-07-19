<?php
include('header.php');
include('connect.php');
$uid = $_SESSION['uid']; ?>


<div class="container">
    <h3>Wallet</h3>
</div>
<hr>

<?php
$sql62 = "SELECT * FROM registration WHERE id = '$uid'";
$result62 = $con->query($sql62);
if ($result62) {
    $row62 = $result62->fetch_assoc();

    if ($row62) {
        $userCoins = $row62['coin'];



        $sql = "SELECT SUM(coinsgained) AS total_sum FROM orders WHERE uid = '$uid'";
        $result = $con->query($sql);
        if ($result) {
            // Fetch the result
            $row = $result->fetch_assoc();

            // Print the total sum
            if ($row && isset($row['total_sum'])) {

                ?>

                <div class="container mt-4">
                    <div class="row" id="boxshadow0">
                        <div class="col cenet">
                            <p style="font-weight:bold">SmartCoins</p>
                            <div class="icon">
                                <span style="padding-left: 20px; font-weight:bold; ">
                                    <?php echo $userCoins; ?>
                                </span>
                                <span><i class="fas fa-sack-dollar" style="color: #F8BD0080; margin-left:10px"></i></span>
                            </div>
                            <p style="margin-top:10px">smartcoins to get discount before they expire!</p>
                            <button type="button" class="btn btn-outline-danger" id="placeorder">Buy more coins</button>
                            <div id="paymentForm" style="display: none;">
                                <form action="process_payment.php" method="post">
                                    <label for="amount">Amount:</label>
                                    <input type="text" id="amount" name="amount" class="form-control" required>

                                    <p>Select Payment Method:</p>
                                    <p>
                                        <input type="radio" name="paymentMethod1" value="paypal">
                                        <i class="fab fa-paypal"></i> PayPal
                                    </p>

                                    <p>
                                        <input type="radio" name="paymentMethod1" value="credit_card">
                                        <i class="far fa-credit-card"></i> Credit Card/Debit Card
                                    </p>

                                    <p>
                                        <input type="radio" name="paymentMethod1" value="bank_transfer">
                                        <i class="fas fa-university"></i> Bank Transfer
                                    </p>

                                    <button type="submit" class="btn btn-outline-danger" id="buymore">Buy more coins</button>

                                    <script>
                                        $(document).ready(function () {
                                            $("#buymore").click(function () {

                                                event.preventDefault();

                                                let pay = $('input[name="paymentMethod1"]:checked').val();
                                                let amount = $("#amount").val();

                                                // Check if a payment method is selected
                                                if (!pay) {
                                                    alert("Please select a payment method.");
                                                    return;
                                                }


                                                let dataToSend = {
                                                    userid: "<?php echo isset($_SESSION['uid']) ? $_SESSION['uid'] : ''; ?>",
                                                    paymentmeathod: pay,
                                                    amount: amount
                                                };

                                                $.ajax({
                                                    url: './ajax/walletajax.php',
                                                    method: 'POST',
                                                    data: dataToSend,
                                                    success: function (res) {
                                                        console.log(res)
                                                        if (res.success) {
                                                            alert('Transaction successful');
                                                        } else {
                                                            alert('Transaction successful');
                                                        }
                                                    },

                                                })

                                            })
                                        })
                                    </script>

                                </form>
                            </div>
                            <script>
                                // Event listener for the "Buy more coins" button
                                document.getElementById('placeorder').addEventListener('click', function () {
                                    // Show the payment form
                                    document.getElementById('paymentForm').style.display = 'block';
                                });
                            </script>
                        </div>
                    </div>

                    <!-- --------------------------------------------------------------------- -->

                    <h3 style="margin-top:10px; margin-bottom: 10px;">Coins Earned</h3>

                    <?php
                    $sqlpid = "SELECT * FROM orders WHERE uid = $uid AND coinsgained IS NOT NULL ORDER BY id DESC LIMIT 4";
                    $result1 = $con->query($sqlpid);

                    while ($row1 = $result1->fetch_assoc()) {
                        $productID = $row1['productid'];
                        $data = $row1['date'];
                        $coinearn = $row1['coinsgained'];


                        $sqlpname = "SELECT pname FROM product WHERE id = $productID";
                        $result2 = $con->query($sqlpname);
                        $row2 = $result2->fetch_assoc();
                        ?>


                        <div class="row" id="boxshadow1">
                            <div class="col-md-6 " style="padding:10px;">
                                <p style="margin-bottom:0px;">
                                    <?php echo $row2['pname'];
                                    ?>
                                </p>
                                <p style="margin-bottom:0px;">
                                    <?php echo $data; ?>
                                </p>
                            </div>
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-2">
                                <div class="icon pointscol1" style="margin-top:15px; margin-left:0px">
                                    <span><i class="fas fa-sack-dollar" style="color: #F8BD0080;"></i></span>
                                    <span>
                                        <?php echo $coinearn; ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <?php
                    } ?>

                    <!-- ------------------------------------------- --------------------------------------------- -->

                    <h3 style="margin-top:10px; margin-bottom: 10px;">Coins Used</h3>

                    <?php
                    $sqlpid3 = "SELECT * FROM orders WHERE uid = $uid AND coinsused IS NOT NULL ORDER BY id DESC LIMIT 4";
                    $result3 = $con->query($sqlpid3);

                    while ($row3 = $result3->fetch_assoc()) {
                        $productID = $row3['productid'];
                        $data = $row3['date'];
                        $coinsused = $row3['coinsused'];

                        $sqlpname3 = "SELECT pname FROM product WHERE id = $productID";
                        $result4 = $con->query($sqlpname3);
                        $row4 = $result4->fetch_assoc();
                        ?>

                        <div class="row" id="boxshadow1">
                            <div class="col-md-6 " style="padding:10px;">
                                <p style="margin-bottom:0px;">
                                    <?php echo $row4['pname']; ?>
                                </p>
                                <p style="margin-bottom:0px;">
                                    <?php echo $data; ?>
                                </p>
                            </div>
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-2">
                                <div class="icon pointscol1" style="margin-top:15px; margin-left:0px">
                                    <span><i class="fas fa-sack-dollar" style="color: #F8BD0080;"></i></span>
                                    <span>
                                        <?php echo $coinsused ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
            } else {
                echo "No results found for the given UID.";
            }
        } else {
            echo "Error executing the query: " . $con->error;
        }

        // echo "User coins: " . $userCoins;
    } else {
        echo "No results found for the given UID.";
    }
} else {
    echo "Error executing the query: " . $con->error;
}
?>


    <h3 style="margin-top:10px; margin-bottom: 10px;">Coins earned by buying with money</h3>

    <?php
    $sqlpid1 = "SELECT * FROM buycoins WHERE uid = $uid AND coins IS NOT NULL ORDER BY id DESC LIMIT 4";
    $result11 = $con->query($sqlpid1);

    while ($row11 = $result11->fetch_assoc()) {
        $coinearn = $row11['coins'];
        ?>


        <div class="row" id="boxshadow1">
            <div class="col-md-6 " style="padding:10px;">
                <p style="margin-bottom:0px;">
                    <?php echo "Coins earned by money";
                    ?>
                </p>

            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-2">
                <div class="icon pointscol1" style="margin-top:15px; margin-left:0px">
                    <span><i class="fas fa-sack-dollar" style="color: #F8BD0080;"></i></span>
                    <span>
                        <?php echo $coinearn; ?>
                    </span>
                </div>
            </div>
        </div>

        <?php
    }

    $con->close();
    include('footer.php');
    ?>

    </html>