<div class="what-we-do we-padding">
            <div class="container">
                <!-- Section-tittle -->
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-tittle text-center">
                            <h2>Fechas por la que usted filtro la busqueda</h2>
                            <h4><?= $DiaInicio;?></h4>
                            <h4><?= $DiaFin;?></h4>
                        </div>
                    </div>
                </div>
                <?php 
                    if(!empty($peliculaVendida)){  ?>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single-do text-center mb-30">
                            <div class="do-icon">
                                <span  class="flaticon-tasks"></span>
                            </div>
                            <div class="do-caption">
                            <img class="col-lg-10 col-md-6"  src="<?php echo IMAGE_ROOT . $pelicula->getPosterPath();?>"  style="width:500px; weight:300px; position:relative;" />

                                <p>Pelicula:  <?=$pelicula->getTitle();?></p>
                                 <p>Entradas Vendidas:  <?= $peliculaVendida['entradasVendidas'] ;?></p>    
                                 <p>Recaudacion Total:  <?=  $peliculaVendida['recaudacionTotal'];?></p> 

                            </div>
                            
                        </div>
                    </div>
                </div>
                <?php }  ?>


                <?php 
                    if(!empty($cineVendido)){  ?>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single-do text-center mb-30">
                            <div class="do-icon">
                                <span  class="flaticon-tasks"></span>
                            </div>
                            <div class="do-caption">
                                <p>Cine:  <?=$cine->getNombre();?></p>
                                <p>Ciudad:  <?=$cine->getCiudad();?></p>
                                <p>Direccion:  <?=$cine->getCalle() ."  ".$cine->getNumero() ;?></p>
                                 <p>Entradas Vendidas:  <?= $cineVendido['entradasVendidas'] ;?></p>    
                                 <p>Recaudacion Total:  <?=  $cineVendido['recaudacionTotal'];?></p> 

                            </div>
                            
                        </div>
                    </div>
                </div>
                <?php }  ?>