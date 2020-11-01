<body>


    <!-- Slider Area Start-->
    <div class="services-area">
        <div class="container">
            <!-- Section-tittle -->
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="section-tittle text-center mb-80">
                        <span>Funciones</span>
                        <h2>Agregando una nueva funcion</h2>
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
                    <form class="form-contact contact_form" action="<?php echo FRONT_ROOT?>Admin/addFuncion" method="post">
                            <div class="row">
                                <div class="col-12">
                                <h5>Pelicula</h5>
                                    <div class="form-group">
                                        <select name="idPelicula" class="form-group">
                                        <?php   foreach($peliculasList as $value){      ?>

                                            <option value="<?php echo $value->getId();?>"><?php echo $value->getTitle(); ?></option> 

                                        <?php }      ?>   
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                    <h5>Dia de la funcion </h5>
                                    <input type="date" name="horario" id="horario"  require min="25-10-2020" >
                                    <br> <br>
                                    <h5>Horario de la funcion</h5>
                                    <input type="time" name="hora" id="hora">                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">   
                                    <h5>Cines</h5>
                                     <select name="idCine"id="select"  onclick="muestraselect(this.value)">
                                        <option value="">Selecione un cine</option>
                                        <?php   foreach($cineList as $value){      ?>

                                            <option value="<?php echo $value->getId();?>"><?php echo $value->getNombre(); ?></option> 

                                        <?php }      ?>   
                                    </select>
                                    </div>
                                </div>            


                                <div class="col-12">
                                    <div class="form-group">    
                                    <h5>Sala</h5>
                                    <div id="salas">      
                                        <select name="idSalas" id="select">
                                            <option value="">Selecione una sala</option>  
                                        </select>
                                    </div>           
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
