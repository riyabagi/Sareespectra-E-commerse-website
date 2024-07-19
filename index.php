<?php 
include('connect.php');

$sqlCategories = "SELECT id, catagoryName, cimage FROM categories LIMIT 4";
$resultCategories = mysqli_query($con, $sqlCategories);

?>

<?php include('header.php')
    ?>

<!-- first slider -->

<div class="container pt-4">
    <div class="row">
        <div class="col">
            <div class="slider">
                <img src="assets/images/slider.jpeg" style="width:100%; margin-top:20px; margin-bottom: 64px;"
                    alt="poster">
            </div>
        </div>
    </div>
</div>

<h1 id="first_heading">Our Top Collection Awaits You</h1>

<div class="container pt-4" id="pslider">
    <div class="row">
        <div class="products">
            <?php
            while ($row = mysqli_fetch_assoc($resultCategories)) {
                ?>
                <a href="./wedd.php?id=<?php echo $row['id']; ?>" class="sub-product">
                    <div class="image-container productBox">
                        <img src="ajax/<?php echo $row['cimage']; ?>" alt="<?php echo $row['catagoryName']; ?>">
                        <div class="rectangle-overlay">
                            <p class="overlay-text">
                                <?php echo $row['catagoryName']; ?>
                            </p>
                        </div>
                    </div>
                </a>
            <?php }
            ; ?>
        </div>
    </div>
</div>

<!-- second slider -->

<h1 id="first_heading" style="margin-top:80px; margin-bottom: 64px;">Categories </h1>

<!-- row 1 -->
<?php
include('connect.php');

$sqlCategories1 = "SELECT id, catagoryName, cimage FROM categories LIMIT 4 OFFSET 5";
$resultCategories1 = mysqli_query($con, $sqlCategories1);

?>
<div class="container pt-4" id="secondpslider">
    <div class="coloum">
        <div class="row">
            <?php
            while ($row = mysqli_fetch_assoc($resultCategories1)) {
                ?>
                <a href="./wedd.php?id=<?php echo $row['id']; ?>" class="col-md-6 second-container secondproductBox">
                    <img src="ajax/<?php echo $row['cimage']; ?>" alt="<?php echo $row['catagoryName']; ?>">
                    <div class="rectangle-overlay">
                        <p class="overlay-text">
                            <?php echo $row['catagoryName']; ?>
                        </p>
                    </div>
                </a>
            <?php }
            ; ?>
        </div>
    </div>
    <div class="square-overlay">
        <p class="overlay-text">With Special Discount</p>
    </div>
</div>

<!-- Third slider -->

<h1 id="first_heading1" style="margin-bottom: 64px;">Fresh Arrival</h1>

<?php
include('connect.php');

$sqlCategories2 = "SELECT id, pname, price, Discription, images, Sizes, category, coins FROM product LIMIT 4";
$resultCategories2 = mysqli_query($con, $sqlCategories2);

if (!$resultCategories2) {
    die("Error in SQL query: " . mysqli_error($con));
}
?>

<div class="container pt-4" id="thirdpslider">
    <div class="row">
        <?php
        while ($row = mysqli_fetch_assoc($resultCategories2)) {
            ?>
            <a href="./single.php?id=<?php echo $row['id']; ?>" class="col-md-3 third-container thirdproductBox">
                <img src="ajax/<?php echo $row['images']; ?>" alt="<?php echo $row['pname']; ?>">
               
                <p class="name" style="text-decoration: none">
                    <?php echo $row['pname']; ?>
                </p>
                <p class="rupee1">₹
                    <?php echo $row['price']; ?>
                </p>
            </a>
        <?php }
        mysqli_free_result($resultCategories2); // Free up the result set
        ?>
    </div>
</div>

<!-- Forth slider -->

<h1 id="first_heading" style="margin-top:40px; margin-bottom: 50px;">Large-Scale Contracts</h1>

<?php
include('connect.php');
$sqlCategories3 = "SELECT id, catagoryName, cimage FROM categories LIMIT 4 OFFSET 9";
$resultCategories3 = mysqli_query($con, $sqlCategories3);

?>

<div class="container pt-4" id="forthpslider">
    <div class="row">
        <?php
        while ($row = mysqli_fetch_assoc($resultCategories3)) {
            ?>
            <a href="./wedd.php?id=<?php echo $row['id']; ?>" class="col-md-3 forth-container forthproductBox">
                <img src="ajax/<?php echo $row['cimage']; ?>"
                    alt="<?php echo isset($row['catagoryName']) ? $row['catagoryName'] : ''; ?>">
                <div class="rectangle2-overlay">
                    <p class="overlay-text">SEE MORE</p>
                </div>
            </a>
        <?php }
        mysqli_free_result($resultCategories3); // Free up the result set
        ?>
    </div>
</div>
</body>
<?php include('footer.php');
?>

</html>