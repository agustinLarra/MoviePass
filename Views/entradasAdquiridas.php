<!--<div class="what-we-do we-padding">-->
            <div class="container">
                <!-- Section-tittle -->
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-tittle text-center">
                            <h2>Lista de entradas adquiridas</h2>
                        </div>
                    </div>
                </div>
                

                
                        <!---------------------FILTRO POR FECHA------------------>             
                        <form action="<?=FRONT_ROOT?>Home/viewFechasEntradas" method="post">
                            <h3>Seleccione Fecha</h3>
                            <select name="Id_fecha">
                                <?php foreach($fechas as $values)
                                {?>
                                    <option value="<?=$values?>"><?=$values?></option>
                                <?php } ?>
                            </select>
                            <br> <br>
                            <div class="header-left-btn f-left d-none d-lg-block">
                                <button type="submit" class="btn header-btn">Buscar</button>
                            </div>
                        </form>
           

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

           <!-- </div>-->
    