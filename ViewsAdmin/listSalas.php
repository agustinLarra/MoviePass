<?php

use DAO\CineDAO;

$cine = new CineDAO(); ?>
<div class="what-we-do we-padding">
            <div class="container">
                <!-- Section-tittle -->
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-tittle text-center">
                            <h2>Lista de Salas Activas</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                <?php foreach($listSalas as $sala){
                    if($sala->getEstado()==0){
                    ?>


                    <div class="col-lg-4 col-md-6">
                        <div class="single-do text-center mb-30">
                            <div class="do-icon">
                                <span  class="flaticon-tasks"></span>
                            </div>
                            <div class="do-caption">
                                <h4><?= $sala->getNombre();?></h4>
                                <p>Cine:  <?= $sala->getNombreCine();?></p>
                                <p>Precio:  <?= $sala->getPrecio();?></p>
                                <p>Ciudad:  <?= ($cine->getByID($sala->getIdCine()))->getCiudad();?></p>
                                <p>Direccion:  <?= ($cine->getByID($sala->getIdCine()))->getCalle();?> <?= ($cine->getByID($sala->getIdCine()))->getNumero();?></p>

                                <p>Capacidad:  <?= $sala->getCapacidad();?></p>
                                <p>Tipo de Sala: <?=  $sala->getTipoSala();?></p>
                            </div>
                            <div class="do-btn">

                            <script>
                            function ConfirmDelete(){
                             var respuesta = confirm("¿Estas seguro que quieres eliminar?");
                             if(respuesta == true)
                             {
                                 return true;
                             }
                            else{
                                 return false;
                                }
                            }
                            </script>

                                <div> 
                                    <form action="<?php echo FRONT_ROOT?>Admin/deleteSala" onclick="return ConfirmDelete()" method="POST">
                                    <input name= "id" type="hidden" value="<?= $sala->getId()?>"></input>
                                    <button type="submit" class='btn btn-danger'>Borrar</button>
                                    </form> 
                                </div>
    
                                <!-- MODIFY-->
                                <!-- El MODIFY NO SE MUESTRA POR QUE SE LE PASA 1 SOLO PARAMETRO Y LOS NECESITA TODOS-->

                                <div> <form action="<?php echo FRONT_ROOT?>Admin/EditSala" method="POST">
                                <input name= "id" type="hidden" value="<?php $sala->getId()?>"></input> 
                                <button type="submit" class='btn btn-danger'> BOTON MODIFY  </button>
                                </form> </div>
                                <a href="<?php echo FRONT_ROOT?>Home/modificarSala/<?php echo $sala->getId() . '/' . $sala->getNombre()  . '/' . $sala->getPrecio() . '/' .  $sala->getCapacidad()?>"  class='btn btn-danger'>Modificar</a>

                            </div>

                            


                        </div>
                    </div>
                    <?php } } ?>
                </div>

                <div class="section-tittle text-center">
                            <h2>Lista de Salas No Disponibles</h2>
                 </div>
                 <div class="row">
                <?php foreach($listSalas as $sala){
                    if($sala->getEstado()==1){
                    ?>


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

                            <script>
                            function ConfirmAlta(){
                             var respuesta = confirm("¿Estas seguro que quieres dar de alta ?");
                             if(respuesta == true)
                             {
                                 return true;
                             }
                            else{
                                 return false;
                                }
                            }
                            
                            </script>
                                
                                <div> <form action="<?php echo FRONT_ROOT?>Admin/altaSala" onclick="return ConfirmAlta()" method="POST">
                                <input name= "id" type="hidden" value="<?= $sala->getId()?>"></input>
                                <button type="submit" class='btn btn-danger'> Alta BOTON </button>
                                </form> </div>

                            


                        </div>
                    </div>
                    <?php } } ?>
                </div>


            </div>
        </div>