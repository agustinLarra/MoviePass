<div class="what-we-do we-padding">
            <div class="container">
                <!-- Section-tittle -->
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-tittle text-center">
                            <h2>Lista de Funciones</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                <?php foreach($listFunciones as $funcion){
                    if($funcion->getEstado() == NULL){
                        echo "entro en NULL";
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-do text-center mb-30">
                            <div class="do-icon">
                                <span  class="flaticon-tasks"></span>
                            </div>
                            <div class="do-caption">
                                <h4><?= $funcion->getDia();?></h4>
                                <h4><?= $funcion->getHora();?></h4>
                                <img class="col-lg-10 col-md-6"  src="<?php echo IMAGE_ROOT . $funcion->getPosterPelicula();?>"  style="width:500px; weight:300px; position:relative;" />
                                <p>Pelicula:  <?= $funcion->getTitlePelicula();?></p>
                                <p>Cine:  <?= $funcion->getClassCine()->getNombre();?></p>
                                <p>Sala:  <?= $funcion->getClassSala()->getNombre();?></p>
                                <p>Descuento:  <?php  if($funcion->getDescuento() == 1){
                                                            echo PORCENTAJE_DESCUENTO;
                                                        }else{
                                                            echo "No";
                                                        }?></p>
                                 <p>Valor Unitario de Entrada:  <?= $funcion->getClassSala()->getPrecio();?></p>
                                 <p>Entradas Vendidas:  <?= $funcion->getEntradasVendidas();?></p>    
                                 <p>Recaudacion Total:  <?= $funcion->getRecaudacionTotal();?></p> 
                                 <p>Entradas disponibles:  <?= $funcion->getClassSala()->getCapacidad() - $funcion->getEntradasVendidas();?></p> 

                                                      
                            </div>
                            <div class="do-btn">
                                <a href="<?php echo FRONT_ROOT?>Admin/deleteFuncion/<?php echo $funcion->getId();?>" class='btn btn-danger'>Borrar</a>
                            </div>
                        </div>
                    </div>
                    
                    <?php } } ?>
                </div>



<!-- LISTA DE FUNCIONES QUE ESTAN BORRADAS -->
        <div class="section-tittle text-center">
                <h2>Lista de Funciones No Disponibles</h2>
                 </div>                                            
                <div class="row">
                <?php foreach($listFunciones as $funcion){
                    if($funcion->getEstado() == 1){
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-do text-center mb-30">
                            <div class="do-icon">
                                <span  class="flaticon-tasks"></span>
                            </div>
                            <div class="do-caption">
                                <h4><?= $funcion->getDia();?></h4>
                                <h4><?= $funcion->getHora();?></h4>
                                <img class="col-lg-10 col-md-6"  src="<?php echo IMAGE_ROOT . $funcion->getPosterPelicula();?>"  style="width:500px; weight:300px; position:relative;" />
                                <p>Pelicula:  <?= $funcion->getTitlePelicula();?></p>
                                <p>Cine:  <?= $funcion->getClassCine()->getNombre();?></p>
                                <p>Sala:  <?= $funcion->getClassSala()->getNombre();?></p>
                                <p>Descuento:  <?php  if($funcion->getDescuento() == 1){
                                                            echo PORCENTAJE_DESCUENTO;
                                                        }else{
                                                            echo "No";
                                                        }?></p>
                                 <p>Valor Unitario de Entrada:  <?= $funcion->getClassSala()->getPrecio();?></p>
                                 <p>Entradas Vendidas:  <?= $funcion->getEntradasVendidas();?></p>    
                                 <p>Recaudacion Total:  <?= $funcion->getRecaudacionTotal();?></p> 
                                 <p>Entradas disponibles:  <?= $funcion->getClassSala()->getCapacidad() - $funcion->getEntradasVendidas();?></p> 

                                                      
                            </div>
                            <div class="do-btn">
                               <!-- <a href="<?php echo FRONT_ROOT?>Admin/deleteFuncion/<?php echo $funcion->getId();?>" class='btn btn-danger'>Borrar</a> -->
                            </div>
                        </div>
                    </div>
                    
                    <?php } } ?>
                </div>                                       













            </div>
        </div>