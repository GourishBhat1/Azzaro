<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="image/favicon.png" type="image/png">
    <title>Deluxe Room - Azzaro Resorts</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="vendors/linericon/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
    <!-- main css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <style>
        /* Custom styles for the room details page */
        .room-carousel img {
            width: 100%;
            height: 500px;
            object-fit: cover;
        }
        .section-title {
            margin-bottom: 50px;
        }
        .review-item {
            margin-bottom: 30px;
        }
        .nearby-attractions img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <!--================Header Area =================-->
    <header class="header_area">
        <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="index.php"><span style="
                        display: inline-block;
                        width: 163px;
                        height: 30px;
                        font-size: 24px;
                        font-weight: bold;
                        line-height: 30px;
                        text-align: center;
                        font-family: Arial, sans-serif;
                        color: #000;
                    ">Azzaro Resorts</span></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                            <li class="nav-item active"><a class="nav-link" href="accomodation.html">Accomodation</a></li>
                            <li class="nav-item"><a class="nav-link" href="index.php#gallery">Gallery</a></li>
                            
                            <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                        </ul>
                    </div>
                </nav>
        </div>
    </header>
    <!--================Header Area =================-->

    <!--================Breadcrumb Area =================-->
    <section class="breadcrumb_area blog_banner_two">
        <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container">
            <div class="page-cover text-center">
                <h2 class="page-cover-tittle f_48">Deluxe Room</h2>
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Deluxe Room</li>
                </ol>
            </div>
        </div>
    </section>
    <!--================Breadcrumb Area =================-->

    <!--================Room Details Area =================-->
    <section class="room-details-area section_gap">
        <div class="container">
            <!-- Carousel Slider -->
            <div id="roomCarousel" class="carousel slide room-carousel" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#roomCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#roomCarousel" data-slide-to="1"></li>
                    <li data-target="#roomCarousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="image/rooms/bedroom_1.jpg" alt="Deluxe Room Image 1">
                    </div>
                    <div class="carousel-item">
                        <img src="image/rooms/bedroom_2.jpg" alt="Deluxe Room Image 2">
                    </div>
                    <div class="carousel-item">
                        <img src="image/rooms/bedroom_3.jpg" alt="Deluxe Room Image 3">
                    </div>
                    <div class="carousel-item">
                        <img src="image/rooms/bedroom_4.jpg" alt="Deluxe Room Image 3">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#roomCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#roomCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <!-- Room Description -->
            <div class="room-description mt-5">
                <h3 class="section-title">Deluxe Room</h3>
                <p>
                    Our Deluxe Rooms offer a perfect blend of comfort and luxury, featuring spacious layouts, modern amenities, and elegant décor. Whether you're traveling for business or leisure, our Deluxe Rooms provide a serene environment to relax and unwind.
                </p>
                <ul>
                    <li>Spacious King or Twin Beds</li>
                    <li>Flat-screen TV with Cable Channels</li>
                    <li>High-speed Wi-Fi</li>
                    <li>Mini Bar and Coffee Maker</li>
                    <li>En-suite Bathroom with Complimentary Toiletries</li>
                    <li>Room Service Available 24/7</li>
                </ul>
            </div>

            <!-- Pricing Section -->
            <div class="pricing-section mt-5">
                <h3 class="section-title">Pricing</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Room Type</th>
                            <th>Occupancy</th>
                            <th>Price per Night</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Deluxe Room - King</td>
                            <td>2 Adults</td>
                            <td>Rs 250</td>
                        </tr>
                        <tr>
                            <td>Deluxe Room - Twin</td>
                            <td>2 Adults</td>
                            <td>Rs 230</td>
                        </tr>
                        <tr>
                            <td>Deluxe Suite</td>
                            <td>2 Adults + 1 Child</td>
                            <td>Rs 350</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!--================Booking Tabel Area =================-->
            <section class="hotel_booking_area">
                <div class="container">
                    <div class="row hotel_booking_table">
                        <div class="col-md-3">
                            <h2>Book<br> Your Room</h2>
                        </div>
                        <div class="col-md-9">
                            <div class="boking_table">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="book_tabel_item">
                                            <div class="form-group">
                                                <div class='input-group date' id='datetimepicker11'>
                                                    <input type='text' class="form-control" placeholder="Arrival Date"/>
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class='input-group date' id='datetimepicker1'>
                                                    <input type='text' class="form-control" placeholder="Departure Date"/>
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="book_tabel_item">
                                            <div class="input-group">
                                                <select class="wide">
                                                    <option data-display="Adult">Adult</option>
                                                    <option value="1">Old</option>
                                                    <option value="2">Younger</option>
                                                    <option value="3">Potato</option>
                                                </select>
                                            </div>
                                            <div class="input-group">
                                                <select class="wide">
                                                    <option data-display="Child">Child</option>
                                                    <option value="1">Child</option>
                                                    <option value="2">Baby</option>
                                                    <option value="3">Child</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="book_tabel_item">
                                            <div class="input-group">
                                                <select class="wide">
                                                    <option data-display="Child">Number of Rooms</option>
                                                    <option value="1">Room 01</option>
                                                    <option value="2">Room 02</option>
                                                    <option value="3">Room 03</option>
                                                </select>
                                            </div>
                                            <a class="book_now_btn button_hover" href="#">Book Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--================Booking Tabel Area  =================-->

            <!--================ Testimonial Area  =================-->
            <section class="testimonial_area section_gap">
                <div class="container">
                    <div class="section_title text-center">
                        <h2 class="title_color">Testimonial from our Clients</h2>
                        <p>The French Revolution constituted for the conscience of the dominant aristocratic class a fall from </p>
                    </div>
                    <div class="testimonial_slider owl-carousel">
                        <div class="media testimonial_item">
                            <img class="rounded-circle" src="image/testtimonial-1.jpg" alt="">
                            <div class="media-body">
                                <p>As conscious traveling Paupers we must always be concerned about our dear Mother Earth. If you think about it, you travel across her face, and She is the </p>
                                <a href="#"><h4 class="sec_h4">Fanny Spencer</h4></a>
                                <div class="star">
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star-half-o"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="media testimonial_item">
                            <img class="rounded-circle" src="image/testtimonial-1.jpg" alt="">
                            <div class="media-body">
                                <p>As conscious traveling Paupers we must always be concerned about our dear Mother Earth. If you think about it, you travel across her face, and She is the </p>
                                <a href="#"><h4 class="sec_h4">Fanny Spencer</h4></a>
                                <div class="star">
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star-half-o"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="media testimonial_item">
                            <img class="rounded-circle" src="image/testtimonial-1.jpg" alt="">
                            <div class="media-body">
                                <p>As conscious traveling Paupers we must always be concerned about our dear Mother Earth. If you think about it, you travel across her face, and She is the </p>
                                <a href="#"><h4 class="sec_h4">Fanny Spencer</h4></a>
                                <div class="star">
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star-half-o"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="media testimonial_item">
                            <img class="rounded-circle" src="image/testtimonial-1.jpg" alt="">
                            <div class="media-body">
                                <p>As conscious traveling Paupers we must always be concerned about our dear Mother Earth. If you think about it, you travel across her face, and She is the </p>
                                <a href="#"><h4 class="sec_h4">Fanny Spencer</h4></a>
                                <div class="star">
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star-half-o"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--================ Testimonial Area  =================-->

            <!-- Nearby Attractions -->
            <div class="nearby-attractions-section mt-5">
                <h3 class="section-title">Nearby Attractions</h3>
                <div class="row">
                    <div class="col-md-4">
                        <div class="attraction-item">
                            <img src="image/attractions/attraction1.jpg" alt="Attraction 1">
                            <h5>Beach Paradise</h5>
                            <p>Just 2 km away, enjoy sunbathing, swimming, and water sports at the pristine Beach Paradise.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="attraction-item">
                            <img src="image/attractions/attraction2.jpg" alt="Attraction 2">
                            <h5>Mountain View Park</h5>
                            <p>Explore hiking trails and scenic viewpoints at the nearby Mountain View Park, only 5 km from the resort.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="attraction-item">
                            <img src="image/attractions/attraction3.jpg" alt="Attraction 3">
                            <h5>City Museum</h5>
                            <p>Discover local history and art at the City Museum, located 3 km away from Azzaro Resorts.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Room Details Area =================-->

    <!--================ start footer Area  =================-->
<footer class="footer-area section_gap">
    <div class="container">
        <div class="row">
            <!-- About Azzaro Resorts -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6 class="footer_title">About Azzaro Resorts</h6>
                    <p>
                        Azzaro Resort & Spa offers unparalleled luxury and personalized service. Our commitment to excellence ensures a memorable stay for every guest, combining elegance, comfort, and world-class amenities.
                    </p>
                </div>
            </div>
            <!-- Navigation Links -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6 class="footer_title">Navigation Links</h6>
                    <div class="row">
                        <div class="col-4">
                            <ul class="list_style">
                                <li><a href="index.html">Home</a></li>
                                <li><a href="accomodation.html">Accomodation</a></li>
                                <li><a href="gallery.html">Gallery</a></li>
                                <li><a href="blog.html">Blog</a></li>
                            </ul>
                        </div>
                        <div class="col-4">
                            <ul class="list_style">
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="elements.html">Elements</a></li>
                                <li><a href="contact.html">Contact</a></li>
                                <li><a href="booking.html">Book Now</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Newsletter Signup -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6 class="footer_title">Newsletter</h6>
                    <p>
                        Subscribe to receive the latest updates, special offers, and news from Azzaro Resort & Spa.
                    </p>
                    <div id="mc_embed_signup">
                        <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="subscribe_form relative">
                            <div class="input-group d-flex flex-row">
                                <input name="EMAIL" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address '" required="" type="email">
                                <button class="btn sub-btn"><span class="lnr lnr-location"></span></button>
                            </div>
                            <div class="mt-10 info"></div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- InstaFeed -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget instafeed">
                    <h6 class="footer_title">InstaFeed</h6>
                    <ul class="list_style instafeed d-flex flex-wrap">
                        <li><img src="image/instagram/Image-01.jpg" alt="Instagram Image 1"></li>
                        <li><img src="image/instagram/Image-02.jpg" alt="Instagram Image 2"></li>
                        <li><img src="image/instagram/Image-03.jpg" alt="Instagram Image 3"></li>
                        <li><img src="image/instagram/Image-04.jpg" alt="Instagram Image 4"></li>
                        <li><img src="image/instagram/Image-05.jpg" alt="Instagram Image 5"></li>
                        <li><img src="image/instagram/Image-06.jpg" alt="Instagram Image 6"></li>
                        <li><img src="image/instagram/Image-07.jpg" alt="Instagram Image 7"></li>
                        <li><img src="image/instagram/Image-08.jpg" alt="Instagram Image 8"></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="border_line"></div>
        <div class="row footer-bottom d-flex justify-content-between align-items-center">
            <p class="col-lg-8 col-sm-12 footer-text m-0">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;
                <script>document.write(new Date().getFullYear());</script> All rights reserved |
                This template is customized for <strong>Azzaro Resort & Spa</strong>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
            <div class="col-lg-4 col-sm-12 footer-social">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-dribbble"></i></a>
                <a href="#"><i class="fa fa-behance"></i></a>
            </div>
        </div>
    </div>
</footer>
<!--================ End footer Area  =================-->


    <!--================ Optional JavaScript =================-->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.js"></script>
    <script src="vendors/nice-select/js/jquery.nice-select.js"></script>
    <script src="js/mail-script.js"></script>
    <script src="js/stellar.js"></script>
    <script src="vendors/lightbox/simpleLightbox.min.js"></script>
    <script src="js/custom.js"></script>
    <!--================ End Optional JavaScript =================-->
</body>
</html>
