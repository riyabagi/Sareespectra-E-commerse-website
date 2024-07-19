<?php
include('connect.php');

$sqlCategories = "SELECT catagoryName, id FROM categories";
$resultCategories = mysqli_query($con, $sqlCategories);

if ($resultCategories) {
    $categories = mysqli_fetch_all($resultCategories, MYSQLI_ASSOC);
} else {
    die("Failed to fetch categories");
}
mysqli_free_result($resultCategories);
?>

<?php include('link.php');
?>

<script>
    $(document).ready(function () {
        $('#Addcategory').click(function () {
            $('#catagory').show();
            $('#product').hide();
        });

        $('#Addproduct').click(function () {
            $('#catagory').hide();
            $('#product').show();
        });

    });
</script>

<!DOCTYPE html>
<html lang="en">

<body>
    <div class="body1">
        <section id="menu">
            <div class="container-fluid">
                <img src="assets/images/logo.png" alt="Description of the image" class="logo">
                <a class="navbar-brand" href="#" style="color: #D22362;">SareeSpectra</a>
                <div class="content">
                    <li id="Addcategory"><i class="fa-solid fa-plus"></i></i><a href="#">Add categories</a></li>
                    <li id="Addproduct"><i class="fa-solid fa-plus"></i></i><a href="#">Add Product</a></li>
                    <li><i class="fa-solid fa-shop"></i><a href="#">View product</a></li>
                    <li><i class="fa-solid fa-truck"></i><a href="#">Orders</a></li>
                    <li><i class="fa-solid fa-user-plus"></i><a href="#">User</a></li>
                    <li><i class="fa-solid fa-arrow-right-from-bracket"></i><a href="#">Logout</a></li>
                    <li><i class="fa-solid fa-chart-simple"></i><a href="#">Dashboard</a></li>
                </div>
        </section>
        <div class="container" id="product" style="display: none;">
            <h2 class="adp">Add Product</h2>
            <hr>

            <div class="row" style="margin-bottom: 20px">
                <div class="col-md-4">
                    <label>Select a categories</label>
                    <label style="width:100;"> Size</label>
                    <select id="categorySelect" name="category" class="cat" placeholder="Select size"
                        data-search="false" data-silent-initial-value-set="true">
                        <option value=""> Select</option>

                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['id']; ?>">
                                <?php echo $category['catagoryName']; ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                    <script src="js/virtual-select.min.js"></script>
                    <script>

                        VirtualSelect.init({
                            ele: '#categorySelect'
                        });
                    </script>
                </div>

                <div class="col-md-4">
                    <label> Product name</label>
                    <input type="text" id="pname" class="form-control mag" style="width:100%;">
                </div>

                <div class="col-md-4">
                    <label> Product price</label>
                    <input type="text" id="pprice" class="form-control mag" style="width:100%;">
                </div>
            </div>

            <div class="row" style="margin-bottom: 20px">
                <div class="col-md-4" style="padding-top: 5px;">
                    <label>Add image</label>
                    <input type="file" name="image" id="image" class="form-control mag" style="width:100%;"
                        accept="image/jpeg, image/png" multiple>
                </div>


                <div class="col-md-4">
                    <label style="margin-bottom:5px"> Color </label>
                    <select id="multipleSelect2" name="col" class="selectcol" placeholder="Select color"
                        data-search="false">
                        <option></option>
                        <option>Yellow</option>
                        <option>Pink</option>
                        <option>Black</option>
                        <option>Orange</option>
                        <option>Green</option>
                        <option>Blue</option>
                        <option>Red</option>
                    </select>

                    <script src="js/virtual-select.min.js"></script>
                    <script>
                        VirtualSelect.init({
                            ele: '#multipleSelect2'
                        });
                    </script>
                </div>

                <div class="col-md-4">
                    <label style="width:100;"> Length</label>
                    <select id="multipleSelect1" multiple name="siz" class="selectlength" placeholder="Select size"
                        data-search="false">
                        <option>4 Yards</option>
                        <option>5 Yards</option>
                        <option>6 Yards</option>
                        <option>7 Yards</option>
                        <option>8 Yards</option>
                        <option>9 Yards</option>
                        <option>10 Yards</option>
                    </select>

                    <script src="js/virtual-select.min.js"></script>
                    <script>
                        VirtualSelect.init({
                            ele: '#multipleSelect1'
                        });
                    </script>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label style="margin-bottom:5px"> Coins </label>
                    <input type="text" id="pcoins" class="form-control mag" style="width:100%;">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label style="width:100;"> Add color varients</label><br>
                    <button type="button" id="addmorecolor" class="btn btn-outline-danger" style="margin-top: 15px"
                        onclick="morecolor()">Add more</button>

                    <div id="inputContainer"></div>

                    <script>
                        // Array to store entered data
                        var dataArray = [];
                        var addButtonClicked = false;

                        function morecolor() {
                            if (!addButtonClicked) {
                                // Your existing code for handling the button click
                                for (var i = 1; i <= 4; i++) {
                                    // Create a new row
                                    var newRow = $('<div class="row"></div>');

                                    // Create and append a select input for color
                                    var colorSelect = $(`
                    <div class="col-md-4">
                        <select id="multipleSelect2_${i}" name="color" class="form-control mag selectcolor" placeholder="Select color" data-search="false">
                            <option value="">Select Color</option>
                            <option value="Blue">Blue</option>
                            <option value="Green">Green</option>
                            <option value="Red">Red</option>
                            <option value="Yellow">Yellow</option>
                        </select>
                    </div>
                `);
                                    newRow.append(colorSelect);

                                    // Create and append a file input for images
                                    var fileInput = $(`<div class="col-md-8"><input type="file" name="image" class="form-control mag colorimage" id="colimages${i}" style="width:100%;" accept="image/jpeg, image/png" ></div>`);
                                    newRow.append(fileInput);

                                    // Append the new row to the container
                                    $('#inputContainer').append(newRow);
                                }

                                // Set the flag to true after the first click
                                addButtonClicked = true;

                                // Disable the button (optional)
                                document.getElementById('addmorecolor').disabled = true;
                            }
                        }
                    </script>


                </div>

                <label style="margin-top:25px;"> Discription</label>
                <textarea type="text" id="pdescription" class="form-control mag"
                    style="width:98%; margin-left: 10px; height:150px" placeholder="Enter your description"></textarea>
            </div>

            <span style="color:red;" id="error"></span>
            <br>
            <button type="button" id="submit" class="btn btn-outline-danger" style="margin-top: 15px">Submit</button>


            <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

            <script>
                let selectedCategory;
                let selectlength;
                let selectedColors;

                function validateForm() {
                    const catElement = document.querySelector('.cat');
                    const coloElement = document.querySelector('.selectcol');
                    const sizElement = $('.selectlength');

                    selectedCategory = catElement ? catElement.val() : '';
                    selectlength = sizElement ? sizElement.val() : '';
                    selectedColors = coloElement ? coloElement.val() : '';

                }


                $(document).ready(function () {
                    $("#submit").click(function () {
                        let pname = $("#pname").val();
                        let pprice = $("#pprice").val();

                        let color1 = $("#color1").val();
                        let color2 = $("#color2").val();
                        let color3 = $("#color3").val();
                        let color4 = $("#color4").val();

                        let coimg1 = $("#colimages1").val();
                        let coimg2 = $("#colimages2").val();
                        let coimg3 = $("#colimages3").val();
                        let coimg4 = $("#colimages4").val();

                        dataArray = []; // Reset the dataArray

                        // Loop through the rows
                        for (var i = 1; i <= 4; i++) {
                            // Get the selected color value
                            var selectedColor = $(`#multipleSelect2_${i}`).val();

                            // Get the selected image file input element
                            var imageFileInput = $(`#colimages${i}`)[0];

                            // Check if the file input element exists and has files
                            if (imageFileInput && imageFileInput.files.length > 0) {
                                // Get the selected image file
                                var selectedImageFile = imageFileInput.files[0];

                                // Create an object to store the values
                                var rowData = {
                                    color: selectedColor,
                                    image: selectedImageFile
                                };

                                // Push the object to the dataArray
                                dataArray.push(rowData);
                            }

                        }

                        // console.log(dataArray);


                        let pdescription = $("#pdescription").val();

                        let selectedCategory = $("#categorySelect").val();
                        let selectlength = $("#multipleSelect1").val();
                        let pimage = $('#image').val();
                        var input = $('#image')[0];
                        var files = input.files;
                        var inputIds = ['#image'];
                        let selectcol = $("#multipleSelect2").val();


                        var inputIds = ['#image'];
                        let pcoins = $("#pcoins").val();
                        // const variations = [{ pcolo1: pimage1, pcolo2: pimage2 }]

                        if (!selectedCategory) {
                            alert("Select a category!");
                            return false;
                        }
                        else if (pname == '') {
                            $("#error").html("Please select Product name")
                        }
                        else if (pprice == '') {
                            $("#error").html("Please select Product price")
                        }
                        else if (files.length === 0) {
                            alert("Please select at least one image!");
                            return false;
                        }
                        else if (!selectcol) {
                            alert("Select the color!");
                            return false;
                        }
                        else if (selectlength.length === 0) {
                            console.log("Select length:", selectlength);
                            alert("Select the length!!");
                            return false;
                        }
                        else if (pcoins.length === 0) {
                            alert("Select the number of coins to be assigned!");
                        }



                        else if (pdescription == '') {
                            $("#error").html("Please select Product description")
                        }

                        else {
                            var formdata = new FormData();
                            for (var i = 0; i < files.length; i++) {
                                formdata.append('files[]', files[i]);
                            }

                            formdata.append('name', pname);
                            formdata.append('price', pprice);
                            formdata.append('category', selectedCategory);
                            formdata.append('description', pdescription);
                            formdata.append('colorr', selectcol);
                            formdata.append('size', selectlength);
                            formdata.append('coin', pcoins);
                            for (var i = 0; i < dataArray.length; i++) {
                                formdata.append('color[]', dataArray[i].color);
                                formdata.append('image[]', dataArray[i].image);
                            }
                            let log = $.ajax({
                                url: './ajax/addproduct.php',
                                method: "POST",
                                data: formdata,
                                dataType: 'json',
                                contentType: false,
                                processData: false,
                                success: function (res) {
                                    // console.log(res);
                                    alert(res.message);
                                },
                                error: function (xhr, status, error) {
                                    console.log(xhr.responseText);
                                }
                            })
                        }

                    });
                });
            </script>
        </div>


        <!-- ----------------------catagories------------------------------- -->

        <div class="container" id="catagory">
            <h2 class="adp">Add category</h2>
            <hr>

            <div class="row" style="margin-bottom: 20px">
                <div class="col-md-4">
                    <label> category name</label>
                    <input type="text" id="cname" class="form-control mag" style="width:100%;">
                </div>

                <div class="col-md-4">
                    <label>Add image</label>
                    <input type="file" name="image" id="cimage" class="form-control mag" style="width:100%;"
                        accept="image/jpeg, image/png">
                </div>
            </div>

            <span style="color:red;" id="error"></span>
            <br>
            <button type="button" id="csubmit" class="btn btn-outline-danger" style="margin-top: 15px">Submit</button>


            <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

            <script>

                $(document).ready(function () {
                    $("#csubmit").click(function () {
                        let cname = $("#cname").val();
                        let pimage = $('#cimage').val();
                        var input = $('#cimage')[0];
                        var cfiles = input.files;
                        var inputIds = ['#cimage'];

                        if (cname == '') {
                            $("#error").html("Please enter category name")
                        }

                        else if (cfiles.length === 0) {
                            alert("Please select at least one image!");
                            return false;
                        }

                        else {
                            var formdata = new FormData();
                            for (var i = 0; i < cfiles.length; i++) {
                                formdata.append('files[]', cfiles[i]);
                            }
                            formdata.append('cname', cname);
                            let log = $.ajax({
                                url: './ajax/addcatagoriesajax.php',
                                method: "POST",
                                data: formdata,
                                dataType: 'json',
                                contentType: false,
                                processData: false,
                                success: function (res) {
                                    console.log(res);
                                    alert(res.message);
                                },
                                error: function (err) {
                                    console.log(err)
                                }
                            })
                        }
                    })
                })
            </script>
        </div>
    </div>
</body>

</html>