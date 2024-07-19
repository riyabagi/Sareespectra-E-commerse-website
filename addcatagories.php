<?php include('link.php');
?>
<!DOCTYPE html>
<html lang="en">

<body>
    <div class="body1">
        <section id="menu">
            <div class="container-fluid">
                <img src="assets/images/logo.png" alt="Description of the image" class="logo">
                <a class="navbar-brand" href="#" style="color: #D22362;">SareeSpectra</a>
                <div class="content">
                    <li><i class="fa-solid fa-plus"></i></i><a href="#">Add categories</a></li>
                    <li><i class="fa-solid fa-plus"></i></i><a href="#">Add Product</a></li>
                    <li><i class="fa-solid fa-shop"></i><a href="#">View product</a></li>
                    <li><i class="fa-solid fa-truck"></i><a href="#">Orders</a></li>
                    <li><i class="fa-solid fa-user-plus"></i><a href="#">User</a></li>
                    <li><i class="fa-solid fa-arrow-right-from-bracket"></i><a href="#">Logout</a></li>
                    <li><i class="fa-solid fa-chart-simple"></i><a href="#">Dashboard</a></li>
                </div>
        </section>
        <div class="container">
            <h2 class="adp">Add category</h2>
            <hr>

            <div class="row" style="margin-bottom: 20px">
                <div class="col-md-4">
                    <label> category name</label>
                    <input type="text" id="cname" class="form-control mag" style="width:100%;">
                </div>

                <div class="col-md-4">
                    <label>Add image</label>
                    <input type="file" name="image" id="image" class="form-control mag" style="width:100%;"
                        accept="image/jpeg, image/png">
                </div>
            </div>

            <span style="color:red;" id="error"></span>
            <br>
            <button type="button" id="submit" class="btn btn-outline-danger" style="margin-top: 15px">Submit</button>
        </div>
    </div>

    <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>

        $(document).ready(function () {
            $("#submit").click(function () {
                let cname = $("#cname").val();
                let pimage = $('#image').val();
                var input = $('#image')[0];
                var files = input.files;
                var inputIds = ['#image'];

                if (cname == '') {
                    $("#error").html("Please enter category name")
                }

                else if (files.length === 0) {
                    alert("Please select at least one image!");
                    return false;
                }

                else {
                    var formdata = new FormData();
                    for (var i = 0; i < files.length; i++) {
                        formdata.append('files[]', files[i]);
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
                    // console.log(log);
                }
            })
        })
    </script>

</body>

</html>