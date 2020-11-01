<?php
use Models\Cine as Cine;

?>

<body>
    

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
                    <form class="form-contact contact_form" action="<?php echo FRONT_ROOT?>Admin/modifyCine" method="post">
                        
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">

                            
                                        <input class="form-control" name="nombre" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = ''" placeholder="<?php echo $retrieve->getNombre() ?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="ciudad" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = ''" placeholder="<?php echo $retrieve->getCiudad() ?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="calle" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = ''" placeholder="<?php echo $retrieve->getNumero() ?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="numero" id="subject" type="number" onfocus="this.placeholder = ''" onblur="this.placeholder = ''" placeholder="<?php echo $retrieve->getCalle() ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="button button-contactForm boxed-btn">Modificar</button>
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