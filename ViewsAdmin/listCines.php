
 <!-- What We do start-->
 
 
 <div class="what-we-do we-padding">
            <div class="container">
                <!-- Section-tittle -->
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-tittle text-center">
                            <h2>Lista de Cines​</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php foreach($listCines as $cine){?>
                    
              
                    <div class="col-lg-4 col-md-6">
                        <div class="single-do text-center mb-30">
                            <div class="do-icon">
                                <span  class="flaticon-tasks"></span>
                            </div>
                            <div class="do-caption">
                                <h4><?= $cine->getNombre();?></h4>
                                <p>Ciudad: <?= $cine->getCiudad();?></p>
                                <p>Calle: <?=  $cine->getCalle() . " " . $cine->getNumero();?></p>
                            </div>
                            <div class="do-btn">
                                <a href="<?php echo FRONT_ROOT?>Admin/deleteCine/<?php echo $cine->getId()?>" class='btn btn-danger'>Borrar</a>
                            </div>
                            <br>
                           <!--  <div class="do-btn">
                                <a href="<?php echo FRONT_ROOT?>Admin/modifyCine/<?php echo $cine->getId()?>" class='btn btn-danger'>Modificar</a>
                            </div> -->
                        </div>
                    </div>
                    <?php } ?>
                </div>
                
            </div>
        </div>
        <!-- What We do End-->