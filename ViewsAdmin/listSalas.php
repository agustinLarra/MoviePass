<div class="what-we-do we-padding">
            <div class="container">
                <!-- Section-tittle -->
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-tittle text-center">
                            <h2>Lista de Salas</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                <?php foreach($listSalas as $sala){?>


                    <div class="col-lg-4 col-md-6">
                        <div class="single-do text-center mb-30">
                            <div class="do-icon">
                                <span  class="flaticon-tasks"></span>
                            </div>
                            <div class="do-caption">
                                <h4><?= $sala->getNombre();?></h4>
                                <p>Cine:  <?= $sala->getNombreCine();?></p>
                                <p>Precio:  <?= $sala->getPrecio();?></p>
                                <p>Capacidad:  <?= $sala->getCapacidad();?></p>
                                <p>Tipo de Sala: <?=  $sala->getTipoSala();?></p>
                            </div>
                            <div class="do-btn">
                                <a href="<?php echo FRONT_ROOT?>Admin/deleteSala/<?php echo $sala->getId()?>" class='btn btn-danger'>Borrar</a>
                            </div>


                        </div>
                    </div>
                    <?php } ?>
                </div>

            </div>
        </div>