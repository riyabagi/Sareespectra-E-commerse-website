<?php
include('header.php');
include('connect.php');
$uid = isset($_SESSION["uid"]) ? $_SESSION["uid"] : null;
?>

<script>
    function changeImage(fileName) {
        let img = document.querySelector("#bannerImage");
        img.setAttribute('src', fileName);
    }

</script>

<div class="container py-4">
    <div class="row">
        <h1 style="margin-bottom: 0px" ;class=head>Sareespectra</h1>
        <hr style="margin-bottom: 40px;" class="horizontal-line">
    </div>
    <?php
    $sql22 = "SELECT type FROM `registration` WHERE id = $uid";
    $result22 = mysqli_query($con, $sql22);

    if ($result22) {
        $userData2 = mysqli_fetch_assoc($result22);
        $userType = isset($userData2['type']) ? $userData2['type'] : 'user';
        mysqli_free_result($result22);
    }

    mysqli_close($con);
    ?>

    <div class="row">
        <?php
        include('connect.php');
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $sqlProduct = "SELECT * FROM product WHERE id = $id";
        $resultProduct = mysqli_query($con, $sqlProduct);

        if (!$resultProduct) {
            die("Error in SQL query: " . mysqli_error($con));
        }
        $product = mysqli_fetch_assoc($resultProduct);

        if ($product) {
            ?>

            <div class="col-md-4">
                <?php
                $imagesArray = explode(',', $product['images']);
                if (!empty($imagesArray)) {
                    echo '<img style="margin-top: 0px;" width="95%" height="470px" id="bannerImage" src="ajax/' . $imagesArray[0] . '">';
                }
                ?>
            </div>
            <div class="col-md-1">
                <?php
                $galleryImages = array_slice($imagesArray, 1, 4); // Exclude the first image for the main view
                foreach ($galleryImages as $galleryImage) {
                    ?>
                    <button onclick="changeImage('ajax/<?php echo $galleryImage; ?>')"
                        style="margin-bottom: 15px; display: block; width: 100%;">
                        <img width="100%" height="100px" src="ajax/<?php echo $galleryImage; ?>"
                            style="display: block; width: 100%;">
                    </button>
                    <?php
                }
                ?>
            </div>

            <?php
        } else {
            echo "Product not found";
        }
        ?>

        <div class="col-md-1">
        </div>
        <div class="col-md-6">
            <label class="silk">
                <?php echo $product['pname']; ?>
            </label>
            <p class="rate">Prize :₹
                <?php echo $product['price']; ?>
            </p>

             <?php if ($userType === 'supplier'): ?>
                <p class="rate">Supplier Rate: ₹
                    <?php echo $product['price'] / 2; ?>
                </p>
            <?php else: ?>
                <!-- <p class="rate"> ₹<?php echo $product['price']; ?></p> -->
            <?php endif; ?>

            <p class="details">Product Details</p>

            <div class="row">
                <div class="col-4">
                    <div class="producttype">
                        <p>Color:</p>
                        <p>Length:</p>
                        <p>Coin:</p>
                        <p>Discription:</p>
                        <p>Qty:</p>
                    </div>
                </div>

                <div class="col-8">
                    <?php
                    $id = isset($_GET['id']) ? $_GET['id'] : null;
                    $id = (int) $id;

                    $sql43 = "SELECT * FROM imagecolor WHERE id = $id";
                    $result43 = mysqli_query($con, $sql43);

                    if ($result43) {
                        echo '<div class="option2-row">';
                        $hasColors = false;

                        while ($row = mysqli_fetch_assoc($result43)) {
                            $colors = isset($row['color']) ? explode(',', $row['color']) : [];
                            $imagePaths = isset($row['image']) ? explode(',', $row['image']) : [];


                            foreach ($colors as $index => $color) {
                                $imagePath = isset($imagePaths[$index]) ? 'ajax/' . $imagePaths[$index] : '';

                                if (!empty($color)) {
                                    // Show radio button only if there's a color
                                    $hasColors = true;
                                    ?>
                                    <label class="option2">
                                        <input type="radio" name="selected_color" value="<?php echo $color; ?>"
                                            data-index="<?php echo $index; ?>" data-image="<?php echo $imagePath; ?>"
                                            onclick="changeImage1(this)" style="margin-bottom: 20px;">
                                        <?php echo $color; ?>
                                    </label>
                                    <?php
                                }
                            }
                        }
                        if (!$hasColors) {
                            echo '<p>No colors available</p>';
                        }

                        echo '</div>';
                    }
                    ?>
                    <script>
                        function changeImage1(radio) {
                            let colorIndex = radio.getAttribute('data-index');
                            let imagePath = radio.getAttribute('data-image');

                            updateBannerImage(imagePath);
                        }

                        function updateBannerImage(imagePath) {
                            let img1 = document.querySelector("#bannerImage");
                            img1.setAttribute('src', imagePath);
                        }
                    </script>
                    <p>
                        <?php
                        $sizesArray = explode(',', $product['Sizes']);

                        foreach ($sizesArray as $size): ?>
                            <label class="option2">
                                <input type="radio" name="selected_size" value="<?php echo $size; ?>">
                                <?php echo $size; ?>
                            </label>
                        <?php endforeach; ?>
                    </p>
                    <p>
                        <?php echo $product['coins']; ?>
                    </p>
                    <p>
                        <?php echo $product['Discription']; ?>
                    </p>

                    <p>
                        <input type="text" id="quantity" name="yourInputName" placeholder="Enter" style="width: 50px;"
                            value="1">
                    </p>

                </div>
            </div>
            <div id="error-message" style="color: red;"></div>

            <div class="button1">
                <button type="submit" class="btn btn-outline-danger"
                    onclick="addToCart(<?php echo $product['id']; ?>, '<?php echo $product['pname']; ?>')">Add to
                    Cart</button>
                <script>

                    function addToCart(productId, pname) {

                        var uid = "<?php echo $uid; ?>";
                        var quantity = document.getElementById('quantity').value || 1;

                        $.ajax({
                            url: 'ajax/singleajax.php',
                            type: 'POST',
                            data: {
                                pid: productId,
                                uid: uid,
                                pname: pname,
                                quantity: quantity,
                            },
                            success: function (status) {
                                console.log(status);
                                const res = JSON.parse(status);
                                console.log(res.success);
                                console.log(res.error);
                                if (res.success === true) {
                                    alert('Product "' + res.pname + '" added to cart successfully with quantity ' + res.quantity);
                                } else {
                                    alert('Failed to add product to cart. Please try again.');
                                }
                            },
                            error: function (xhr, textStatus, errorThrown) {
                                console.error('Error:', errorThrown);
                                alert('An error occurred. Please try again later.');
                            }
                        });
                    }
                </script>
                <a class="btn btn-outline-danger" type="change add" class="btn btn-outline-danger" id="buynow">Buy
                    Now</a>
            </div>
            <script>
                $('#buynow').click(function () {
                    var selectedSize = document.querySelector('input[name="selected_size"]:checked');
                    var selectedcolor = document.querySelector('input[name="selected_color"]:checked');
                    var inputValue = document.getElementById("quantity").value;

                    if (!selectedSize) {
                        document.getElementById('error-message').innerHTML = 'Please select a size.';
                    }
                    else if (inputValue === "") {
                        alert("Input field is empty. Please enter a value.");
                    }
                    else {
                        var productid = "<?php echo $id; ?>";
                        var color = $('input[name="selected_color"]:checked').val();
                        var Sizes = $('input[name="selected_size"]:checked').val();
                        var quantity = document.getElementById("quantity").value;
                        var currentImageSrc = document.getElementById("bannerImage").getAttribute("src");
                        var defaultColor = "<?php echo $product['color']; ?>";


                        window.location.href = "checkout.php?id=" + productid + '&defaultColor=' + defaultColor + '&color=' + color + '&Sizes=' + Sizes + '&quantity=' + quantity + '&image=' + encodeURIComponent(currentImageSrc);

                    }
                });
            </script>
        </div>

        <?php
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $sqlProduct = "SELECT * FROM product WHERE id = $id";
        $resultProduct = mysqli_query($con, $sqlProduct);

        if (!$resultProduct) {
            die("Error in SQL query: " . mysqli_error($con));
        }

        $product = mysqli_fetch_assoc($resultProduct);

        if (!$product) {
            echo "Product not found";
        } else {
            ?>
            <div class="container py-4">
                <!-- ... your existing code ... -->
                <h4 class="like">Similar Items You May Like </h4>
                <div class="row">
                    <?php
                    $sqlSimilarItems = "SELECT * FROM product WHERE category = {$product['category']} AND id != $id LIMIT 4";
                    $resultSimilarItems = mysqli_query($con, $sqlSimilarItems);

                    while ($row = mysqli_fetch_assoc($resultSimilarItems)) {
                        ?>
                        <div class="col-md-3 forth-container forthproductBox">
                            <img src="<?php echo 'ajax/' . $row['images']; ?>" alt="<?php echo $row['pname']; ?>"
                                class="img-responsive" style="width: 100%; height: 400px;">
                            <p class="mdow">
                                <?php echo $row['pname']; ?>
                            </p>
                            <p class="rupee">₹
                                <?php echo $row['price']; ?>
                            </p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        mysqli_close($con);
        ?>
    </div>
</div>

<?php include('footer.php');
?>