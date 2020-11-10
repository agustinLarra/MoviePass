<div class="what-we-do we-padding">
            <div class="container">
                <!-- Section-tittle -->
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-tittle text-center">
                            <h2>Lista de Cines Activas</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                <?php foreach($listCines as $cine){
                    if($cine->getEstado() == 0){

                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-do text-center mb-30">
                            <div class="do-icon">
                                <span  class="flaticon-tasks"></span>
                            </div>
                            <div class="do-caption">
                                <h4><?= $cine->getNombre();?></h4>
                                <p>Ciudad: <?= $cine->getCiudad();?></p>
                                <p>Calle: <?= $cine->getCalle();?></p>
                                <p>Numero: <?= $cine->getNumero();?></p>
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
                                <?php echo "Aca hace bien el direccionamiento pero mal la accion"?>
                                <div> 
                                <form action="<?php echo FRONT_ROOT?>Admin/deleteCine" onclick="return ConfirmDelete()" method="POST">
                                    <input name= "id" type="hidden" value="<?= $cine->getId()?>"></input>
                                    <button type="submit" class='btn btn-danger'> Borrar BOTON </button>
                                </form> 
                                </div>
                                 
                            </div>


                        </div>
                    </div>
                    <?php } } ?>
                </div>

                <div class="section-tittle text-center">
                            <h2>Lista de cines No Disponibles</h2>
                 </div>
                 <div class="row">
                <?php foreach($listCines as $cine){
                    if($cine->getEstado()==1){
                        
                    ?>


                    <div class="col-lg-4 col-md-6">
                        <div class="single-do text-center mb-30">
                            <div class="do-icon">
                                <span  class="flaticon-tasks"></span>
                            </div>
                            <div class="do-caption">
                                <h4><?= $cine->getNombre();?></h4>
                                <p>Ciudad:  <?= $cine->getCiudad();?></p>
                                <p>Calle:   <?= $cine->getCalle();?></p>
                                <p>Numero:  <?= $cine->getNumero();?></p>
                            </div>
                            <div class="do-btn">

                            <script>
                            function ConfirmAlta(){
                             var respuesta = confirm("¿Estas seguro que quieres dar de alta?");
                             if(respuesta == true)
                             {
                                 return true;
                             }
                            else{
                                 return false;
                                }
                            }
                            
                            </script>

                                <div> <form action="<?php echo FRONT_ROOT?>Admin/altaCine" onclick="return ConfirmAlta()" method="POST">
                                <input name= "id" type="hidden" value="<?php $cine->getId()?>"></input>
                                <button type="submit" class='btn btn-danger'> Boton Alta </button>
                                </form> </div>

                                <a href="<?php echo FRONT_ROOT?>Admin/altaCine/<?php echo $cine->getId()?>"  onclick="return ConfirmAlta()"class='btn btn-danger'>Alta</a>
                            </div>
                            


                        </div>
                    </div>
                    <?php } } ?>
                </div>


            </div>
        </div>