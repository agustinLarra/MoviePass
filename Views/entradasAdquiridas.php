<div class="what-we-do we-padding">
            <div class="container">
                <!-- Section-tittle -->
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-tittle text-center">
                            <h2>Lista de entradas adquiridas</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                <?php foreach($listaDeDivs as $div){?>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-do text-center mb-30">
                            <div class="do-icon">
                                <span  class="flaticon-tasks"></span>
                            </div>
                            <div class="do-caption">
                                <img class="col-lg-10 col-md-6"  src="<?php echo IMAGE_ROOT .  $div['PosterPath'];?>"  style="width:500px; weight:300px; position:relative;" />
                                <h4>Pelicula:  <?= $div['Title'];?></h4>
                                <p>Cine:  <?= $div['NombreCine'];?></p>
                                <p>Sala:  <?= $div['NombreSala'];?></p>
                                <p>Dia:  <?= $div['Dia']; ?></p>
                                <p>Hora:  <?= $div['Hora']; ?></p>
                                <p>Entradas compradas:  <?=  $div['EntradasAdquiridas'];?></p>
                                <p>Total:  <?= $div['Total'];?></p>    
                                
                                                      
                            </div>
                         
                        </div>
                    </div>
                    
                    <?php } ?>
                </div>

            </div>
        </div>