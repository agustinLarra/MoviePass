
<body>
    
 
    <!-- Slider Area Start-->
    <div class="services-area">
        <div class="container">
            <!-- Section-tittle -->
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="section-tittle text-center mb-80">
                        <span>Salas</span>
                        <h2>Modificando sala<?=$nombre?></h2>
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
                    <form class="form-contact contact_form" action="<?php echo FRONT_ROOT?>Admin/modificarSala" method="post">

                    <input id="id_sala" name="id_sala" type="hidden" value="<?=$id_aux?>">
                            </select>
                                <br> <br>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                       Nombre: <input class="form-control" name="nombreSala" id="subject" type="text" minlength="2" maxlength= "25" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?=$nombre_sala?>'" placeholder="<?=$nombre_sala?>">
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-group">
                                      Precio: <input class="form-control" name="precio" id="subject" type="number" min="100" max="500" step="100" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?=$precio_aux?>'" placeholder="<?=$precio_aux?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                       Capacidad: <input class="form-control" name="capacidad" id="subject" type="number" min="50" max="200" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?=$capacidad_aux?>''" placeholder="<?=$capacidad_aux?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        Tipo:
                                        <select name="tipoSala">
                                            <option value="2D">Sala 2D</option> 
                                            <option value="3D">Sala 3D</option> 
                                        </select>                                    
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="button button-contactForm boxed-btn">Send</button>
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
    