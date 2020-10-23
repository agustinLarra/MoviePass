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

    <!-- Slider Area Start-->
    <div class="services-area">
        <div class="container">
            <!-- Section-tittle -->
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="section-tittle text-center mb-80">
                        <span>Cines</span>
                        <h2>Agregando un nuevo cine</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Slider Area End-->
         <div class="row d-flex justify-content-center"> 
                <div class="row">
                    <div class="col-12">
                       <!-- <h2 class="contact-title">Formulario</h2> -->
                     </div>
                    <div class="col-lg-8">
                    <form class="form-contact contact_form" action="<?php echo FRONT_ROOT?>Admin/addCine" method="post">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="nombre" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = ''" placeholder="Nombre del cine">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="ciudad" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = ''" placeholder="Ciudad">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="calle" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = ''" placeholder="Calle">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="numero" id="subject" type="number" onfocus="this.placeholder = ''" onblur="this.placeholder = ''" placeholder="Numero">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="button button-contactForm boxed-btn">Enviar</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="col-xl-2 col-lg-2 col-md-3">
                            <div class="header-right-btn f-right d-none d-lg-block">
                               <!-- <a href="addSalas.php" class="btn header-btn">Agregar salas a este cine</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

        </section>
    <!-- ================ contact section end ================= -->
    


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
        
		<!-- One Page, Animated-HeadLin -->
        <script src="./assets/js/wow.min.js"></script>
		<script src="./assets/js/animated.headline.js"></script>
		
		<!-- Scrollup, nice-select, sticky -->
        <script src="./assets/js/jquery.scrollUp.min.js"></script>
        <script src="./assets/js/jquery.nice-select.min.js"></script>
		<script src="./assets/js/jquery.sticky.js"></script>
        <script src="./assets/js/jquery.magnific-popup.js"></script>

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