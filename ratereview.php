<?php include('header.php') ?>
<style>
    body {
        background-color: #ffffff !important;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h3>Ratings & Reviews</h3>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-3">
            <P style="margin:0px; font-weight: bold;">Saree Spectra Fashion Woven Silk Saree With Blouse Piece</P>
            <P style="margin:0px; font-weight: bold;"> ₹ 1500</P>
        </div>
        <div class="col-md-1">
            <img src="assets/images/z5.jpg" alt="poster" style="width:100%; height:80px;">
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-3" style="background-color: #f0f0f0;">
            <h5> What makes a good review</h5>
            <hr>

            <h6> have you used this product</h6>
            <p> Your review should be about your experience with the product.</p>
            <hr>

            <h6> Why review a product ? </h6>
            <p> Your valuable feedback will help fellow shoppers decide!</p>
            <hr>

            <h6> How to review a product?</h6>
            <p> Your review should include facts. An honest opinion is alway sappreciated. If you have an issue with the
                product or service please contact us from the <a href="#" style="text-decoration-line: none;"> help
                    center</a>.</p>
            <hr>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-8" style="background-color: #f0f0f0;">
            <h5>Rate this product</h5>
            <p><i class="fa-regular fa-star" style="color: #d23262; padding-right: 10px"></i><i
                    class="fa-regular fa-star" style="color: #d23262; padding-right: 10px"></i><i
                    class="fa-regular fa-star" style="color: #d23262; padding-right: 10px"></i><i
                    class="fa-regular fa-star" style="color: #d23262; padding-right: 10px"></i><i
                    class="fa-regular fa-star" style="color: #d23262;">
                </i>
            </p>
            <hr>

            <h5>Review this product</h5>
            <textarea type="text" style="width:100%; height:150px ; border: none;margin:0px"
                placeholder="Enter your description"></textarea>
            <hr style="margin:0px">
            <textarea type="text" style="width:100%; height:50px; margin:0px; border:none;"
                placeholder="Title your description (optional)"></textarea>

            <input class="file-input1" type="file" accept="image/*" multiple id="fileInput">

            <label class="label1" for="fileInput" style="margin-top: 10px"  ><i class="fa-solid fa-camera-retro"
                    style="margin-right: 10px;color: #d23262;" onclick="openFileInput1()"></i>Choose Image
            </label>

            <div class="col-md-12" style="text-align: right;">
                <button type="submit" class="btn btn-outline-danger" style="margin-bottom: 20px;">SUBMIT</button>
            </div>


        </div>
    </div>

</div>

<script>
    function openFileInput1() {
        document.getElementById('file-input1').click();
    }
</script>

<?php include('footer.php');
?>

</html>