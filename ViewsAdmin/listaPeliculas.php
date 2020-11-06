
          
    

<div class="what-we-do we-padding">
            <div class="col-lg-6" style="float:left;">
                        <!---------------------FILTRO POR FECHA------------------>             
                        <form action="<?=FRONT_ROOT?>Home/viewPeliEstrenoAdmin" method="post">
                            <h3>Seleccione Fecha</h3>
                            <select name="estreno">
                                <?php foreach($arregloEstrenos as $values)  {?>
                                    <option value="<?=$values?>"><?=$values?></option>
                                <?php } ?>
                            </select>
                            <br> <br>
                            <div class="header-left-btn f-left d-none d-lg-block">
                                <button type="submit" class="btn header-btn">Buscar</button>
                            </div>
                        </form>
            </div>  
            <div class="container">
                <!-- Section-tittle -->
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-tittle text-center">
                            <h2>Lista de Peliculas</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                <?php foreach($peliculasList as $pelicula){?>
                    
                    <div class="col-lg-6 col-md-6">
                        <div class="single-do text-center mb-30">
                            <div class="do-icon">
                                <span  class="flaticon-tasks"></span>
                            </div>
                          
                            <div class="do-caption">
                                <img class="col-lg-10 col-md-6"  src="<?php echo IMAGE_ROOT . $pelicula->getPosterHorizontal();?>"  style="width:500px; weight:300px; position:relative;" />
                                <br><br>
                                <h4><?= $pelicula->getTitle();?></h4>
                            </div>


                        </div>
                    </div>
                    <?php } ?>
                </div>

            </div>
        </div>