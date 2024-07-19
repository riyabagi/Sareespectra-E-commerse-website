<?php
// include('header.php')
include('link.php');
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card mt-4">
                <style>
                    .card {
                        width: 400px;
                        max-width: 100%;
                        height: auto;
                    }
                </style>

                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">User Type</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="userType" value="user" checked>
                            <label class="form-check-label">User</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="userType" value="supplier">
                            <label class="form-check-label">Supplier</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="firstname" class="form-label"> First Name</label>
                        <input type="text" id="rfname" class="form-control" style="width:100%;">
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label"> Last Name</label>
                        <input type="text" id="rlname" class="form-control" style="width:100%;">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label"> User name</label>
                        <input type="text" id="rname" class="form-control" style="width:100%;">
                    </div>

                    <div class="mb-3">
                        <label for="phonenumber" class="form-label">Phone number</label>
                        <input type="tel" id="rphon" class="form-control" style="width:100%;">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" id="remail" class="form-control" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3" id="companyNameDiv" style="display: none;">
                        <label for="companyName" class="form-label">Company Name</label>
                        <input type="text" id="companyName" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="rpass" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="confirmpassword" class="form-label">Confirm password</label>
                        <input type="password" id="rconfirmpass" class="form-control" style="width:100%;">
                    </div>

                    <span style="color:red;" id="error"></span>
                    <br>

                    <div class="col" id="lvm">
                        <button type="submit" id="signup" class="btn btn-outline-danger" style="margin-top:10px">Sign up</button>
                    </div>
                    <div class="mb-3 form-check1 mt-2">
                        <a href="#">Forgot password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $("input[name='userType']").change(function() {
            toggleSupplierFields();
        });

        $("#signup").click(function() {
            let userType = $("input[name='userType']:checked").val();
            let rfname = $("#rfname").val();
            let rlname = $("#rlname").val();
            let rname = $("#rname").val();
            let rphon = $("#rphon").val();
            let remail = $("#remail").val();
            let companyName = $("#companyName").val();
            let rpass = $("#rpass").val();
            let rconfirmpass = $("#rconfirmpass").val();

            // Validation code here

            $.ajax({
                url: './ajax/registrationajax.php',
                method: "POST",
                data: {
                    userType: userType,
                    fname: rfname,
                    lname: rlname,
                    name: rname,
                    phone: rphon,
                    email: remail,
                    companyName: companyName,
                    password: rpass,
                },
                success: function(res) {
                    alert(res)
                    if (res === "Registration successful! Welcome to SareeSpectra") {
                        window.location.href = 'login.php'
                    }
                    console.log(res)
                },
                error: function(err) {
                    console.error(err);
                }
            });
        });

        function toggleSupplierFields() {
            if ($("input[name='userType']:checked").val() === "supplier") {
                $("#companyNameDiv").show();
            } else {
                $("#companyNameDiv").hide();
            }
        }

        function validatePhoneNumber(phoneNumber) {
            var phoneNumber = $("#rphon").val(); // Use the correct ID here
            var phoneNumberPattern = /^\d{10}$/;

            return (phoneNumberPattern.test(phoneNumber))
        }

        $("#rphon").on("input", function() {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        });

        function validateEmail(email) {
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailPattern.test(email);
        }
    })
</script>