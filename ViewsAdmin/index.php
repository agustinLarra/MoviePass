<?php 
    include('header.php');
?>
   <body>
       
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <p>MOVIEPASS</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->

    <div class="header-area header-transparrent ">
        <div class="main-header header-sticky">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Logo -->
                    <div class="col-xl-2 col-lg-2 col-md-1">
                        <div class="logo">
                            <a>MOVIEPASS</a>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-8">
                        <!-- Main-menu -->
                        <div class="main-menu f-right d-none d-lg-block">
                            <nav> 
                                <ul id="navigation">    
                                    <li><a href="<?php echo FRONT_ROOT?>Admin/Index"> Home Admin</a></li>
                                    <!-- ACA REDIRECCIONAR BIEN-->
                                    <li><a href="contact.html">Cines</a>
                                        <ul class="submenu">
                                            <li><a href="<?php echo FRONT_ROOT?>Admin/showAddCine">Agregar Cines</a></li>
                                               <!-- ACA EDITAR CINE -->
                                                <!-- ACA ELIMINAR CINE -->
                                            <li><a href="<?php echo FRONT_ROOT?>Admin/showListCine">Lista de cines</a></li>

                                         </ul>
                                     </li>
                                      <!-- ACA REDIRECCIONAR BIEN-->
                                     <li><a href="contact.html">Salas</a>
                                        <ul class="submenu">
                                        <li><a href="<?php echo FRONT_ROOT?>Admin/showAddSalas">Agregar Salas</a></li>
                                           <!-- ACA EDITAR SALA -->
                                                <!-- ACA ELIMINAR SALA -->
                                                 <!-- ACA LISTAR SALAS -->
                                         </ul>
                                     </li>
                                </ul>
                            </nav>
                        </div>
                    </div>             
                    <div class="col-xl-2 col-lg-2 col-md-3">
                        <div class="header-right-btn f-right d-none d-lg-block">
                            <a href="<?= FRONT_ROOT?>Home/Index" class="btn header-btn">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
    <main>

        <!-- Slider Area Start-->
        <div class="slider-area ">
            <div class="slider-active">
                <div class="single-slider slider-height d-flex align-items-center" data-background="assets/img/hero/h1_hero.png">
                    <div class="container">
                        <div class="row d-flex align-items-center">
                            <div class="col-lg-7 col-md-9 ">
                                <div class="hero__caption">
                                    <h1 data-animation="fadeInLeft" data-delay=".4s">Movie Pass</h1>
                                    <p data-animation="fadeInLeft" data-delay=".6s">Welcome to Admin MoviePass</p>
                                    <!-- Hero-btn 
                                    <div class="hero__btn" data-animation="fadeInLeft" data-delay=".8s">
                                        <a href="industries.html" class="btn hero-btn">Contact Us</a>
                                    </div>
                                    -->
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="hero__img d-none d-lg-block" data-animation="fadeInRight" data-delay="1s">
                                    <img src="imagesAdmin/cinema.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          
 
	<!-- JS here -->
	
		<!-- All JS Custom Plugins Link Here here -->
        <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
		<!-- Jquery, Popper, Bootstrap -->
		<script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="./assets/js/popper.min.js"></script>
        <script src="./assets/js/bootstrap.min.js"></script>
	    <!-- Jquery Mobile Menu -->
        <script src="./assets/js/jquery.slicknav.min.js"></script>

		<!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="./assets/js/owl.carousel.min.js"></script>
        <script src="./assets/js/slick.min.js"></script>
        <!-- Date Picker -->
        <script src="./assets/js/gijgo.min.js"></script>
		<!-- One Page, Animated-HeadLin -->
        <script src="./assets/js/wow.min.js"></script>
		<script src="./assets/js/animated.headline.js"></script>
        <script src="./assets/js/jquery.magnific-popup.js"></script>

		<!-- Scrollup, nice-select, sticky -->
        <script src="./assets/js/jquery.scrollUp.min.js"></script>
        <script src="./assets/js/jquery.nice-select.min.js"></script>
		<script src="./assets/js/jquery.sticky.js"></script>
        
        <!-- contact js -->
        <script src="./assets/js/contact.js"></script>
        <script src="./assets/js/jquery.form.js"></script>
        <script src="./assets/js/jquery.validate.min.js"></script>
        <script src="./assets/js/mail-script.js"></script>
        <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
        
		<!-- Jquery Plugins, main Jquery -->	
        <script src="./assets/js/plugins.js"></script>
        <script src="./assets/js/main.js"></script>
        
    </body>
</html>