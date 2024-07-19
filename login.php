<?php
include('header.php')
    ?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <img width="220%" , height="95%" src="assets/images/logoback.webp" alt="poster" style="padding-top: 20px; ">
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4" style="margin-top:70px;">
            <div class="card  mt-4">
                <style>
                    .card {
                        margin-top: 25px;
                        width: 100%;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: auto;
                    }
                </style>

                <div class="mb-3">
                    <i class="fas fa-user-circle"
                        style="color: #d22362; font-size:40px; padding-left: 15px; padding-top: 20px; "></i>
                    <h3>Login</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="email" class="form-label">User name</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="pass">
                    </div>

                    <span style="color:red;" id="error"></span>
                    <br>

                    <div class="col" id="lvm">
                        <button type="submit" class="btn btn-outline-danger" id="login">LOGIN</button>
                    </div>

                    <div class="mb-3 form-check1 mt-2">
                        <a href="#" style="margin-left: 42px;">Forgot password</a>
                    </div>

                    <hr>

                    <!-- <div class="mb-3">
                        <label>Don't have a account</label><br>
                        <button type="submit" class="btn btn-outline-danger" id="create" style="margin-top:20px">create
                            one</button>
                        <script>
                            window.location.href = 'registration.php'
                        </script>
                    </div> -->

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#login").click(function () {
            let lemail = $("#email").val();
            let lpss = $("#pass").val();

            if (lemail == '') {
                $("#error").html("Please enter the email")
            }
            else if (lpss == '') {
                $("#error").html("Please enter the password")
            }

            else {
                $.ajax({
                    url: './ajax/loginajax.php',
                    method: "POST",
                    data: {
                        lemail: lemail,
                        lpss: lpss,
                    },
                    success: function (res) {
                        alert(res)
                        // $_SESSION['uid']=res;
                        if (res === 'success')
                            window.location.href = 'index.php'
                    },
                    error: function (err) {

                    }

                })

            }


        })
    })


</script>