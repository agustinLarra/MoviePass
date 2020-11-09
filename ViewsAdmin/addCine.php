
<body>
    
    <!-- Preloader Start
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
     -->
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
                                        <input class="form-control" required name="nombre" name="nombre" id="subject" type="text" minlength="2" maxlength= "25" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nombre Cine'" placeholder="Nombre del cine">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" required name="ciudad" name="ciudad" id="subject" type="text" minlength="2" maxlength= "25" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ciudad'" placeholder="Ciudad">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" required name="calle" name="calle" id="subject" type="text" minlength="2" maxlength= "25" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Calle'" placeholder="Calle">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" required name="numero" name="numero"  id="subject" type="number"  min="1" max="9999" step="1" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Numero'" placeholder="Numero">
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
