<?php 
include('link.php');
session_start();
$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;
?>
<!DOCTYPE html>
<html lang="en">

<body>
    <div class="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-lightt">
            <div class="container-fluid">
                <img src="assets/images/logo.png" alt="Description of the image" class="logo">

                <a class="navbar-brand" href="index.php" style="color: #D22362;">SareeSpectra</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="search d-flex" style="">
                    <input type="text" placeholder="Search product">
                    <button>Search</button>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <form id="search" class="d-flex">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0" style="">

                            <li class="becomesupplier" style="padding:0px">
                                <p>Become Supplier</p>
                            </li>

                            <li>
                                <div class="vertical-line0"></div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="wallet.php" style="color: #D22362;">
                                    <i class="fa-solid fa-wallet"></i>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="addtocart.php" style="color: #D22362;">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="wishlist.php" style="color: #D22362;">
                                    <i class="fa-solid fa-heart" style="color: #d22362;"></i>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="profile.php" style="color: #D22362;">
                                    <i class="fa-solid fa-user" style="color: #d22362;"></i>
                                </a>
                            </li>

                        </ul>
                    </form>
                </div>



            </div>

        </nav>
    </div>

    <hr style="margin-top: 0px">