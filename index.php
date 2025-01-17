<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="image/favicon.png" type="image/png">
        <title>Azzaro Resorts & Spa</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="vendors/linericon/style.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
        <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
        <!-- main css -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/responsive.css">
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
                            <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="about.html">About us</a></li>
                            <li class="nav-item"><a class="nav-link" href="accomodation.html">Accomodation</a></li>
                            <li class="nav-item"><a class="nav-link" href="gallery.html">Gallery</a></li>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Blog</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
                                    <li class="nav-item"><a class="nav-link" href="blog-single.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="elements.html">Elemests</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!--================Header Area =================-->

        <!--================Banner Area =================-->
        <section class="banner_area">
            <div class="booking_table d_flex align-items-center">
            	<div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
				<div class="container">
					<div class="banner_content text-center">
						<h6>Away from the Ordinary</h6>
						<h2>Indulge in Luxury</h2>
						<p>Escape to Azzaro Resorts & Spa, where serene surroundings, world-class amenities, and unparalleled comfort come together to create a truly unforgettable experience. Rediscover tranquility and elevate your stay with us.</p>
						<a href="#" class="btn theme_btn button_hover">Get Started</a>
					</div>
				</div>
            </div>
            <div class="hotel_booking_area position">
                <div class="container">
                    <div class="hotel_booking_table">
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
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                </select>
                                            </div>
                                            <div class="input-group">
                                                <select class="wide">
                                                    <option data-display="Child">Child</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
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
                                            <a class="book_now_btn button_hover" href="accomodation.html">Book Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================Banner Area =================-->

        <!--================ Accomodation Area  =================-->
        <section class="accomodation_area section_gap">
            <div class="container">
              <div class="section_title text-center">
                <h2 class="title_color">Exceptional Hotel Accommodation</h2>
                <p>
                  Experience timeless elegance and comfort in accommodations designed for the young at heart.
                  Embrace a lifestyle that prioritizes relaxation and joy, even as life speeds up around you.
                </p>
              </div>

                <div class="row mb_30">
                    <div class="col-lg-3 col-sm-6">
                        <div class="accomodation_item text-center">
                            <div class="hotel_img">
                                <img src="image/rooms/bedroom_1_thumb.jpg" alt="">
                                <a href="room_details.php" class="btn theme_btn button_hover">Book Now</a>
                            </div>
                            <a href="room_details.php"><h4 class="sec_h4">Double Deluxe Room</h4></a>
                            <h5>Rs 250<small>/night</small></h5>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="accomodation_item text-center">
                            <div class="hotel_img">
                                <img src="image/rooms/bedroom_2_thumb.jpg" alt="">
                                <a href="room_details.php" class="btn theme_btn button_hover">Book Now</a>
                            </div>
                            <a href="room_details.php"><h4 class="sec_h4">Single Deluxe Room</h4></a>
                            <h5>Rs 200<small>/night</small></h5>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="accomodation_item text-center">
                            <div class="hotel_img">
                                <img src="image/rooms/bedroom_3_thumb.jpg" alt="">
                                <a href="room_details.php" class="btn theme_btn button_hover">Book Now</a>
                            </div>
                            <a href="room_details.php"><h4 class="sec_h4">Honeymoon Suit</h4></a>
                            <h5>Rs 750<small>/night</small></h5>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="accomodation_item text-center">
                            <div class="hotel_img">
                                <img src="image/rooms/bedroom_4_thumb.jpg" alt="">
                                <a href="room_details.php" class="btn theme_btn button_hover">Book Now</a>
                            </div>
                            <a href="room_details.php"><h4 class="sec_h4">Economy Double</h4></a>
                            <h5>Rs 200<small>/night</small></h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================ Accomodation Area  =================-->

        <!--================ Facilities Area  =================-->
<section class="facilities_area section_gap">
    <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background="">
    </div>
    <div class="container">
        <div class="section_title text-center">
            <h2 class="title_w">Royal Facilities</h2>
            <p>Indulge in unparalleled amenities designed for luxury, comfort, and an unforgettable stay.</p>
        </div>
        <div class="row mb_30">
            <div class="col-lg-4 col-md-6">
                <div class="facilities_item">
                    <h4 class="sec_h4"><i class="lnr lnr-dinner"></i>Restaurant</h4>
                    <p>
                        Savor exquisite dining options at our on-site restaurants, offering international cuisine, local delicacies, and a world-class dining experience in an elegant setting.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="facilities_item">
                    <h4 class="sec_h4"><i class="lnr lnr-bicycle"></i>Sports Club</h4>
                    <p>
                        Stay active and healthy with access to our Sports Club featuring modern fitness equipment, tennis courts, and various recreational activities tailored for all ages.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="facilities_item">
                    <h4 class="sec_h4"><i class="lnr lnr-shirt"></i>Swimming Pool</h4>
                    <p>
                        Relax in our lavish swimming pool area, surrounded by lush landscaping and attentive service, perfect for unwinding and enjoying the serene ambiance.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="facilities_item">
                    <h4 class="sec_h4"><i class="lnr lnr-car"></i>Rent a Car</h4>
                    <p>
                        Explore the surrounding areas with ease using our convenient car rental service, offering a selection of vehicles to suit your travel needs.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="facilities_item">
                    <h4 class="sec_h4"><i class="lnr lnr-construction"></i>Gymnasium</h4>
                    <p>
                        Maintain your fitness routine in our state-of-the-art gymnasium, equipped with the latest training machines and personal coaching options.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="facilities_item">
                    <h4 class="sec_h4"><i class="lnr lnr-coffee-cup"></i>Bar</h4>
                    <p>
                        Enjoy handcrafted cocktails, fine wines, and an extensive selection of spirits at our stylish on-site bar, perfect for unwinding after a long day.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ Facilities Area  =================-->


<!--================ About History Area  =================-->
<section class="about_history_area section_gap">
<div class="container">
<div class="row">
    <div class="col-md-6 d_flex align-items-center">
        <div class="about_content">
            <h2 class="title title_color">
                About Azzaro Resort & Spa<br>
                Our Story<br>
                Mission & Vision
            </h2>
            <p>
                Founded with a passion for excellence, Azzaro Resort & Spa has been dedicated to offering unparalleled luxury and personalized service. Our history is rooted in a commitment to innovation, sustainability, and guest satisfaction. As we embrace our rich heritage, our mission remains to create transformative experiences that blend serenity, style, and comfort. Our vision is to be a beacon of excellence in hospitality, inspiring guests with our unwavering dedication to quality and care.
            </p>
            <a href="#" class="button_hover theme_btn_two">Discover More</a>
        </div>
    </div>
    <div class="col-md-6">
        <img class="img-fluid" src="image/rooms/outdoor_2.jpg" alt="Azzaro Resort Exterior">
    </div>
</div>
</div>
</section>
<!--================ About History Area  =================-->


<!--================ Testimonial Area  =================-->
<section class="testimonial_area section_gap">
<div class="container">
<div class="section_title text-center">
    <h2 class="title_color">Testimonials from Our Guests</h2>
    <p>Discover what our guests have to say about their exceptional experiences at Azzaro Resort & Spa.</p>
</div>
<div class="testimonial_slider owl-carousel">
    <div class="media testimonial_item">
        <img class="rounded-circle" src="image/testimonial-1.jpg" alt="Guest Photo">
        <div class="media-body">
            <p>"Our stay at Azzaro Resort & Spa was absolutely delightful. The staff, facilities, and ambience made our vacation unforgettable."</p>
            <a href="#"><h4 class="sec_h4">Anna Williams</h4></a>
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
        <img class="rounded-circle" src="image/testimonial-2.jpg" alt="Guest Photo">
        <div class="media-body">
            <p>"The luxury of the rooms and the breathtaking views exceeded our expectations. We highly recommend Azzaro Resort for a truly pampered experience."</p>
            <a href="#"><h4 class="sec_h4">James Anderson</h4></a>
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
        <img class="rounded-circle" src="image/testimonial-3.jpg" alt="Guest Photo">
        <div class="media-body">
            <p>"We were impressed by the exceptional service and attention to detail. Our family vacation at Azzaro Resort was memorable and relaxing."</p>
            <a href="#"><h4 class="sec_h4">Sophia Martinez</h4></a>
            <div class="star">
                <a href="#"><i class="fa fa-star"></i></a>
                <a href="#"><i class="fa fa-star"></i></a>
                <a href="#"><i class="fa fa-star"></i></a>
                <a href="#"><i class="fa fa-star"></i></a>
                <a href="#"><i class="fa fa-star-o"></i></a>
            </div>
        </div>
    </div>
    <div class="media testimonial_item">
        <img class="rounded-circle" src="image/testimonial-4.jpg" alt="Guest Photo">
        <div class="media-body">
            <p>"The serene environment and world-class amenities at Azzaro Resort make it a perfect destination for relaxation and rejuvenation."</p>
            <a href="#"><h4 class="sec_h4">Liam Patel</h4></a>
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


<!--================ Latest Blog Area  =================-->
<section class="latest_blog_area section_gap">
<div class="container">
<div class="section_title text-center">
    <h2 class="title_color">Latest Posts from Our Blog</h2>
    <p>Stay updated with our latest stories, travel tips, and behind-the-scenes insights from Azzaro Resort & Spa.</p>
</div>
<div class="row mb_30">
    <div class="col-lg-4 col-md-6">
        <div class="single-recent-blog-post">
            <div class="thumb">
                <img class="img-fluid" src="image/blog/azzaro_experience.jpg" alt="Azzaro Resort Experience">
            </div>
            <div class="details">
                <div class="tags">
                    <a href="#" class="button_hover tag_btn">Luxury</a>
                    <a href="#" class="button_hover tag_btn">Travel</a>
                </div>
                <a href="#">
                    <h4 class="sec_h4">Exploring Luxury at Azzaro Resorts</h4>
                </a>
                <p>
                    Discover what makes a stay at Azzaro Resort & Spa a truly luxurious experience—from exquisite dining to impeccable service.
                </p>
                <h6 class="date title_color">15th August, 2023</h6>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="single-recent-blog-post">
            <div class="thumb">
                <img class="img-fluid" src="image/blog/destination_guide.jpg" alt="Destination Guide">
            </div>
            <div class="details">
                <div class="tags">
                    <a href="#" class="button_hover tag_btn">Destination</a>
                    <a href="#" class="button_hover tag_btn">Guide</a>
                </div>
                <a href="#">
                    <h4 class="sec_h4">Top Attractions Near Azzaro Resort & Spa</h4>
                </a>
                <p>
                    Explore the must-visit destinations near our resort, including pristine beaches, cultural landmarks, and scenic adventures.
                </p>
                <h6 class="date title_color">22nd July, 2023</h6>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="single-recent-blog-post">
            <div class="thumb">
                <img class="img-fluid" src="image/blog/travel_tips.jpg" alt="Travel Tips">
            </div>
            <div class="details">
                <div class="tags">
                    <a href="#" class="button_hover tag_btn">Tips</a>
                    <a href="#" class="button_hover tag_btn">Lifestyle</a>
                </div>
                <a href="#">
                    <h4 class="sec_h4">Travel Tips for a Memorable Stay</h4>
                </a>
                <p>
                    Learn insider tips to enhance your travel experience and make the most out of your stay at Azzaro Resort & Spa.
                </p>
                <h6 class="date title_color">5th July, 2023</h6>
            </div>
        </div>
    </div>
</div>
</div>
</section>
<!--================ Latest Blog Area  =================-->


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



        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
        <script src="js/jquery.ajaxchimp.min.js"></script>
        <script src="js/mail-script.js"></script>
        <script src="vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.js"></script>
        <script src="vendors/nice-select/js/jquery.nice-select.js"></script>
        <script src="js/mail-script.js"></script>
        <script src="js/stellar.js"></script>
        <script src="vendors/lightbox/simpleLightbox.min.js"></script>
        <script src="js/custom.js"></script>
    </body>
</html>
