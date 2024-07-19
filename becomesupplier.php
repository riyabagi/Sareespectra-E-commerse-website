<?php include('header.php') ?>
<div class="container">
    <div class="becomesellerBanner_Container pt-4">
        <img src="https://images.meesho.com/images/pow/downloadBannerDesktop.webp" class="becomesellerBanner" />
        <div class="becomeSeller_Content">
            <div class="becomeSeller_content_content">
                <h2 style="color: #D22362;">Become a Seller and</h2>

                <h1>Start your Online Business
                    with Zero Investment</h1>

            </div>
        </div>
    </div>


    <!-- <div class="container"> -->
    <div class="row">
        <img src="https://images.meesho.com/images/pow/supplyBannerDesktop.webp" style="width: 100%; height: 700px;">
    </div>

    <div class="saree-supplier_benefit_container">
        <h1>Register as a Supplier</h1>
        <p>Sell your products to crores of customers at 0% commission</p>

        <?php
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Sanitize and store form data
            $companyName = htmlspecialchars($_POST["companyName"]);
            $contactPerson = htmlspecialchars($_POST["contactPerson"]);
            $email = htmlspecialchars($_POST["email"]);
            $phone = htmlspecialchars($_POST["phone"]);
            $address = htmlspecialchars($_POST["address"]);
            $sareeTypes = htmlspecialchars($_POST["sareeTypes"]);

            // Save data to a text file (you should use a database in a real scenario)
            $data = "Company Name: $companyName\nContact Person: $contactPerson\nEmail: $email\nPhone: $phone\nAddress: $address\nSaree Types: $sareeTypes\n\n";

            // Append to the file or modify to insert into a database
            file_put_contents('suppliers.txt', $data, FILE_APPEND);

            // Display a success message and link to the main page
            echo "<h2>Thank you for becoming a supplier!</h2>";
            echo "<p><a href='main_page.php'>Go to Main Page</a></p>";
        } else {
            // Display the supplier registration form
            ?>
            <h1>Supplier Registration</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <!-- Your form fields go here -->
                <label for="companyName">Company Name:</label>
                <input type="text" name="companyName" required><br>
                <label for="contactPerson">Contact Person:</label>
                <input type="text" name="contactPerson" required><br>

                <label for="email">Email:</label>
                <input type="email" name="email" required><br>

                <label for="phone">Phone:</label>
                <input type="text" name="phone" required><br>

                <label for="address">Address:</label>
                <textarea name="address" rows="4" required></textarea><br>

                <label for="sareeTypes">Saree Types (comma-separated):</label>
                <input type="text" name="sareeTypes" required><br>
                <button type="button" id="submit" class="btn btn-outline-danger" style="margin-top: 15px">Submit</button>
                <a href="#" class="btn btn-outline-danger">Sign up now</a>
                <?php
        }
        ?>

    </div>
</div>

</body>
<?php include('footer.php');