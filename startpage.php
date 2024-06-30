<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dairy Serve Management System</title>
    <link rel="icon" href="/dairy-serve-management-system/images/new.png" type="image/icon type">
    <script src="https://kit.fontawesome.com/d5e4bd332c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="webfonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-5.3.3/bootstrap.min.css">
    <link href="slide.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="scroll.css">
    <link rel="stylesheet" href="input.css">
   
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .banner-area {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.4)), url('images/mainimg.jpeg');
            height: 650px;
            background-repeat: no-repeat;
            background-size: cover;
            text-align: center;
            transition: all 0.5s ease-in-out;
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        li {
            justify-content: center;
            color: black;
        }

        .banner-area h2 {
            padding-bottom: 5px;
            height: 650px;
            background-repeat: no-repeat;
            background-size: cover;
            text-align: center;
            color: white;
            transition: all 0.5s ease-in-out;
            animation: slideInFromLeft 1s forwards;
        }

        .banner-area h2 {
            position: relative;
            margin-top: 200px;
            margin-left: 50px;
            color: white;
            width: 30%;
        }

        .navbar ul {
            margin-left: auto;
            margin-right: auto;
        }

        .navbar li {
            display: inline-block;
            margin-right: 50px;
            color: black;
            /* Adjust the value as needed */
        }

        .menu a:hover {
            color: black;
            border-radius: 20px;
            transform: scale(1.1);
            transition: all 0.3s ease;
        }

        .products img {
            border-radius: 20px;
            height: 300px;
            width: 100%;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
            transition: transform 0.3s ease;
        }

        .products img:hover {
            transform: scale(1.05);
        }

        .products h3 {
            padding: 10px;
            font-size: 30px;
            color: red;
            letter-spacing: 2px;
            animation: fadeIn 2s;
        }

        .products p {
            font-size: 24px;
            line-height: 20px;
            padding-top: 15px;
            font-weight: bold;
        }

        .products a {
            border: 2px solid green;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .products a:hover {
            background-color: green;
            color: white;
        }

        .foot-main h3:hover {
            text-decoration: underline;
            transform: scale(1.3);
            transition: all 0.3s ease;
        }

        .emailid {
            margin-bottom: 10px;
            border-radius: 20px;
            padding: 25px;
            height: 28px;
        }

        .spam {
            color: white;
        }

        .title {
            font-size: 40px;
            font-weight: bold;
            margin-top: 10px;
            opacity: 0;
            animation: fadeIn 1s forwards 0.5s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideInFromLeft {
            from {
                transform: scale(0.5);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes slideInFromTop {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideInFromBottom {
            from {
                transform: translateY(100%);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .banner-area h2 {
                margin-top: 100px;
                font-size: 24px;
            }

            .products h3 {
                font-size: 24px;
            }

            .products p {
                font-size: 18px;
            }
        }
    </style>
</head>

<body class="main-body">
    <div id="jsScroll" class="scroll" onclick="scrollToTop();">
        <i class="fa fa-angle-up"></i>
    </div>

    <script src="app.js"></script>
    <header class="bg-light py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="https://www.kmfnandini.coop/en/portfolio">
                <img src="images/new.png" alt="Logo" class="img-fluid" style="height: 110px; width: 150px; border-radius: 10px;">
            </a>
            <span class="title">Dairy Serve Management System</span>
            <a href="logout.php" class="btn btn-outline-success"><i class="fas fa-sign-in-alt"></i> Logout</a>
        </div>
    </header>
    <div class="banner-area">
        <nav class="navbar navbar-expand-lg bg-primary sticky-top">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a href="startpage.php" class="nav-link"><i class="fa-solid fa-home" style="color: black;"></i> Home</a></li>
                        <li class="nav-item"><a href="Service.php" class="nav-link"><i class="fa fa-shopping-cart" style="color: black;"></i> Services</a></li>
                        <li class="nav-item"><a href="aboutus.html" class="nav-link"><i class="fas fa-info-circle" style="color: black;"></i> About Us</a></li>
                        <li class="nav-item"><a href="gallery.html" class="nav-link"><i class="fa fa-picture-o" style="color: black;"></i> Gallery</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <h2 translate="yes">Welcome to farmer-friendly and eco-friendly dairy</h2>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-4 products">
                <h3>Our Products</h3>
                <img src="images/products.jpg" alt="Products">
                <p>We provide our customers a wide variety of dairy products from organic milk to butter and cheese.</p>
                <a href="products.html" class="btn btn-success">Read More</a>
            </div>
            <div class="col-md-4 products">
                <h3>Our Aim</h3>
                <img src="images/aim.jpg" alt="Aim">
                <p>To build a <span class="text-success">strong</span>, <span class="text-danger">healthy</span>, and <span class="text-primary">nutritious</span> country by providing employment to all small-scale farmers.</p>
                <a href="#" class="btn btn-success">Read More</a>
            </div>
            <div class="col-md-4 products">
                <h3>Working</h3>
                <img src="images/working.png" alt="Working">
                <p>Let's start.</p>
                <a href="#" class="btn btn-success">Read More</a>
            </div>
        </div>
    </div>
    <div class="b">
        <div class="logo-slider" data-v-4ef8651c="">
            <center>
                <div class="logos-slide" data-v-4ef8651c="">
                    <img src="images/php.jpeg" data-v-4ef8651c="">
                    <img src="images/htl.jpg" data-v-4ef8651c="">
                    <img src="images/js.jpeg" data-v-4ef8651c="">
                    <img src="images/boo.png" data-v-4ef8651c="">
                    <img src="images/chatgpt1.png" data-v-4ef8651c="">
                    <img src="images/ge.jpeg" data-v-4ef8651c="">
            </center>
        </div>
    </div>
    </div><br>
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 foot-main">
                    <h3>About Us</h3>
                    <p>A dairy is a business enterprise established for the processing of animal milk, mostly from cows or buffaloes, for human consumption.</p>
                    <a href="#" class="btn btn-outline-light">Read More</a>
                </div>
                <div class="col-md-4 foot-main">
                    <h3>Find Us</h3><br>
                    <p>SIDDARTHA NAGAR</p>
                    <p>CHAMUNDI VIHAR LAYOUT</p>
                    <p>MYSURU, KARNATAKA 570011</p>
                    <p>Phone: 0821 247 3933</p>
                </div>
                <div class="col-md-4 foot-main">
                    <h3>Contact Us</h3>
                    <p>Subscribe to get our latest updates and offers.</p>
                    <form action="subscribe.php" method="post" class="form-inline">
                        <div class="input-group">
                            <input type="email" name="email" id="email" class="input" required>
                            <label class="label">Enter Your Email ID</label><br>
                        </div>
                        <button type="submit" name="subscribe" class="btn btn-primary mb-2">Subscribe</button>
                    </form>
                    <p class="spam">Don't worry, we won't spam you!</p>
                </div>
            </div>
            <center>
                <div class="google-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3898.182579435614!2d76.68973627441778!3d12.303488229175146!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3baf71d211a9a679%3A0x7a414a3584b4dbcd!2sNandini%20Milk%20Parlour!5e0!3m2!1sen!2sin!4v1719359799348!5m2!1sen!2sin" width="390" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </center>
            <div class="text-center mt-3">
                <h5>Made with <img src="images/c4.png" alt="Made With Image" height="30px" width="100px"></h5>
            </div>
            <div class="text-center mt-3">
                <h3>Connect with</h3>
                <div class="d-flex justify-content-center mt-2">
                    <a href="https://www.instagram.com/?hl=en" class="text-decoration-none text-white mx-2">
                        <i class="fab fa-instagram fa-2x"></i>
                    </a>
                    <a href="https://www.facebook.com" class="text-decoration-none text-white mx-2">
                        <i class="fab fa-facebook fa-2x"></i>
                    </a>
                    <a href="https://www.twitter.com" class="text-decoration-none text-white mx-2">
                        <i class="fab fa-twitter fa-2x"></i>
                    </a>
                    <a href="https://www.telegram.com" class="text-decoration-none text-white mx-2">
                        <i class="fab fa-telegram fa-2x"></i>
                    </a>
                    <a href="https://www.github.com" class="text-decoration-none text-white mx-2">
                        <i class="fab fa-github fa-2x"></i>
                    </a>
                    <a href="https://rrgs_dev.com" class="text-decoration-none text-white mx-2">
                        <i class="fab fa-google fa-2x"></i>
                    </a>
                </div>
            </div>

            <!-- Include Font Awesome CSS -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


            <!-- Add Bootstrap Icons CSS -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">

        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
<script src="css/bootstrap-5.3.3/popper.min.js"></script>
<script src="css/bootstrap-5.3.3/jquery-3.5.1.slim.min.js"></script>
<script src="css/bootstrap-5.3.3/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>