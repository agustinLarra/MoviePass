<body>


    <!-- Slider Area Start-->
    <div class="services-area">
        <div class="container">
            <!-- Section-tittle -->
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="section-tittle text-center mb-80">
                        <span>Funciones</span>
                        <h2>Consulta sobre los totales vendidos</h2>
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
                    <form class="form-contact contact_form" action="<?php echo FRONT_ROOT?>Admin/consultaTotalesVendidos" method="post">
                            <div class="row">
                            <h3> Paso 1:  Seleccione un filtro de busqueda </h3>
                                <div class="col-12">
                                <h5>Pelicula</h5>
                                    <div class="form-group">
                                        <select name="idPelicula" class="form-group">
                                        <option value="-1">Selecione un pelicula</option>
                                        <?php   foreach($listaPeliculas as $pelicula){      ?>

                                            <option value="<?php echo $pelicula->getId();?>"><?php echo $pelicula->getTitle(); ?></option> 

                                        <?php }      ?>   
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="col-12">
                                    <div class="form-group">   
                                    <h5>Cines</h5>
                                     <select name="idCine"id="select"  onclick="muestraselect(this.value)">
                                        <option value="-1">Selecione un cine</option>
                                        <?php   foreach($listaCines as $cine){      ?>

                                            <option value="<?php echo $cine->getId();?>"><?php echo $cine->getNombre(); ?></option> 

                                        <?php }      ?>   
                                    </select>
                                    </div>
                                </div>            
                    
                            
                <script>
                window.addEventListener("load", fechaDinamica);

                function fechaDinamica(){
                    document.getElementById("fechaInicio").addEventListener("change",cambiarFecha);
                }
                
                function cambiarFecha(){
                    var fechaInicio = document.getElementById("fechaInicio").value;
                    console.log(fechaInicio);
                    document.getElementById("fechaFin").setAttribute("min", fechaInicio);

                }
                </script>
                            <div class="col-12">
                                    <h3> Paso 2: Elija las fechas en las que quiere buscar</h3>
                                    <div class="form-group">
                                    <?php $fecha_actual = (date("d-m-Y H:i:00"));     ?>
                                    
                                    <h5>Fecha inicio</h5>
                                    <input type="date" name="fechaInicio" id="fechaInicio"   />
                                            

                                    <h5>Fecha fin</h5>
                                    <input type="date" name="fechaFin" id="fechaFin" required min=<?php $hoy=date("Y-m-d"); echo $hoy;?> />
                                    
                                    </div>
                                </div> 

                            <div class="form-group mt-3">
                                <button type="submit" class="button button-contactForm boxed-btn">Buscar</button>
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
