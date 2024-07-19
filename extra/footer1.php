<?php include('header.php'); ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card  mt-4">
                <style>
                    .card {
                        width: 400px;
                        max-width: 100%;
                        height: auto;
                    }
                </style>

                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="rname" class="form-control" style="width:100%;" id="name">
                    </div>

                    <div class="mb-3">
                        <label for="phonenumber" class="form-label">Phone number</label>
                        <input type="tel" id="rphon" class="form-control" style="width:100%;" id="name">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" id="remail" class="form-control" id="email" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="rpass" class="form-control" id="password">
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Confirm password</label>
                        <input type="text" id="rconfirmpass" class="form-control" style="width:100%;" id="name">
                    </div>

                    <span style="color:red;" id="error"></span>
                    <br>

                    <div class="col" id="lvm">
                        <button type="submit" id="signup" class="btn btn-outline-danger">Sign up</button>
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
        $("#signup").click(function() {
            let rname = $("#rname").val();
            let rphon = $("#rphon").val();
            let remail = $("#remail").val();
            let rpass = $("#rpass").val();
            let rconfirmpass = $("#rconfirmpass").val();

            if (rname == '') {
                $("#error").html("Please enter your name");
            } else if (!validatePhoneNumber(rphon)) {
                $("#error").html("Invalid phone number! Please enter exactly 10 numeric characters.");
            } else if (remail == '') {
                $("#error").html("Please enter your email");
            } else if (rpass == '') {
                $("#error").html("Please enter the password");
            } else if (rconfirmpass == '') {
                $("#error").html("Please confirm your password");
            } else {
                validatePhoneNumber(); // Call the phone number validation function
                $.ajax({
                    url: './ajax/registrationajax.php',
                    method: "POST",
                    data: {
                        name: rname,
                        phone: rphon,
                        email: remail,
                        password: rpass,
                    },
                    success: function(res) {
                        console.log(res)
                        if (res == 'Inserted') {
                            alert("Registered Succesfully");
                        } else {
                            alert("Registration failed");
                        }
                    },
                    error: function(err) {

                    }
                });
            }
        });

        function validatePhoneNumber(phoneNumber) {
            var phoneNumber = $("#rphon").val(); // Use the correct ID here
            var phoneNumberPattern = /^\d{10}$/;

            return (phoneNumberPattern.test(phoneNumber))
        }

            $("#rphon").on("input", function() {
                $(this).val($(this).val().replace(/[^0-9]/g, ''));
            });


        
    });
</script>

<?php include('footer.php'); ?>