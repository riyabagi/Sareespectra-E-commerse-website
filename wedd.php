<?php include('header.php') ?>

<?php
// echo $_GET['id'];



?>
<div class="container col-md-12 pt-4">
    <h2 id="head">Shop</h2>
</div>

<hr class="horizontal-line">
<div class="row dow pt-4">
    <div class="col-md-2 offset-md-0" id="filter-column">

        <div class="filter-column">
            <h3>Filter Options</h3>

            <h4>Price Range</h4>
            <input type="range" id="price-range" min="0" max="5000" step="100">
            <p><span id="min-price">0</span> - <span id="max-price">5000</span></p>


            <h4>Types of Saree</h4>
            <label for="saree-type">Select a type:</label>
            <select id="saree-type">
                <option value="all">All</option>
                <option value="kanchipuram">Kanchipuram</option>
                <option value="paithani">Paithani</option>
                <option value="kanchipuram">Georgette Saree</option>
                <option value="paithani">Banarasi Saree</option>
                <option value="kanchipuram">Bandhani Saree</option>
                <option value="paithani">Chanderi Saree</option>
            </select>


            <h4>Brands</h4>
            <label for="brand">Select a brand:</label>
            <select id="brand">
                <option value="all">All</option>
                <option value="brand1">Manish Malhotra</option>
                <option value="brand2">Ritu Kumar</option>
                <option value="brand3">Raw Mango</option>
                <option value="brand4">Kanjivaram Sarees</option>

            </select>

            <label for="color">Color:</label>
            <select id="color">
                <option value="all">All</option>
                <option value="grey">Grey</option>
                <option value="orange">Orange</option>
                <option value="orange">pink</option>
                <option value="orange">yellow</option>
                <option value="orange">green</option>
                <option value="orange">blue</option>
                <option value="orange">brown</option>
                <option value="orange">red</option>

            </select>
            <button id="apply-filter">Apply Filter</button>
        </div>
    </div>

    <?php
    include('connect.php');
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    $sqlProduct = "SELECT * FROM product WHERE category = $id";
    $resultProduct = mysqli_query($con, $sqlProduct);

    if (!$resultProduct) {
        die("Error in SQL query: " . mysqli_error($con));
    }


    ?>

    <div class="col-10">
        <div class="row dow">
            <?php
            while ($row = mysqli_fetch_assoc($resultProduct)) {
                ?>

                <a href="./single.php?id=<?php echo $row['id']; ?>" class="col-md-3" id="image"
                    style="text-decoration:none;color:black;">
                    <div class="image-container">
                        <?php
                        $imagePaths = explode(',', $row['images']);
                        if (isset($imagePaths[0])) {
                            $firstImagePath = 'ajax/' . trim($imagePaths[0]);
                            ?>
                            <img src="<?php echo $firstImagePath; ?>" alt="<?php echo $row['pname']; ?>" class="img-responsive"
                                style="width: 100%; height: 400px;">
                            <?php
                        }
                        ?>

                    </div>
                    <p class="mdow">
                        <?php echo $row['pname']; ?>
                    </p>
                    <p class="rupee"> Retail Rate:₹
                        <?php echo $row['price']; ?>
                    </p>
                    <?php
                    $query = "SELECT * FROM `registration` WHERE `id` = $uid";
                    $result = mysqli_query($con, $query);

                    if ($result) {
                        $userData = mysqli_fetch_assoc($result);
                    } else {

                        echo "Error: " . mysqli_error($con);
                    } ?>
                    <?php if ($userData['type'] === 'supplier'): ?>
                        <p class="rupee">Supplier Rate: ₹
                            <?php echo $row['price'] / 2; ?>
                        </p>
                    <?php else: ?>
                        <!-- <p class="rupee"> ₹ <?php echo $row['price']; ?></p> -->
                    <?php endif; ?>



                </a>
            <?php }
            ; ?>
        </div>
    </div>
</div>
<?php include('footer.php') ?>