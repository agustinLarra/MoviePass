
<main>

<!--<div class="what-we-do we-padding">LA COMENTO POR QUE TIRA ERROR EN EL SELECT Y MUESTRA UN OPTION SOLO -->
         <div class="container">

            <div class="col-lg-6" style="float:left;">
                        <!---------------------FILTRO POR FECHA DE ESTRENOS------------------>             
                        <form action="<?=FRONT_ROOT?>Home/viewPeliEstrenoAdmin" method="post">
                            <h3>Buscar por Fecha de Estreno</h3>
                            <select name="estreno">  
                                <?php
                                foreach($fechas_estreno as $values)  {?>
                                    <option value="<?=$values?>"><?=$values?></option>
                                <?php } ?>
                            </select>
                            <br> <br>
                            <div class="header-left-btn f-left d-none d-lg-block">
                                <button type="submit" class="btn header-btn">Buscar</button>
                            </div>
                        </form>
            </div> 

            <div class="col-lg-6" style="float:left;">
                        <!---------------------FILTRO POR FECHA DE FUNCION------------------>             
                        <form action="<?=FRONT_ROOT?>Home/viewPeliFuncionAdmin" method="post">
                            <h3>Buscar por Fecha de Funcion</h3>
                            <select name="funcion">  
                                <?php
                                foreach($fechaDeFuncion as $values)  {?>
                                    <option value="<?=$values?>"><?=$values?></option>
                                <?php } ?>
                            </select>
                            <br> <br>
                            <div class="header-left-btn f-left d-none d-lg-block">
                                <button type="submit" class="btn header-btn">Buscar</button>
                            </div>
                        </form>
            </div> 

            <div class="col-lg-6" style="float:left;">
                        <!---------------------FILTRO POR GENERO------------------>             
                        <form action="<?=FRONT_ROOT?>Home/viewPeliGeneroAdmin" method="post">
                            <h3>Buscar por Genero</h3>
                            <select name="genero">  
                                <?php
                                foreach($generoList as $values)  {?>
                                    <option value="<?=$values->getId()."-".$values->getTipo();?>"><?=$values->getTipo();?></option>
                                <?php } ?>
                            </select>
                            <br> <br>
                            <div class="header-left-btn f-left d-none d-lg-block">
                                <button type="submit" class="btn header-btn">Buscar</button>
                            </div>
                        </form>
            </div> 
        
        

            
 
                <!-- Section-tittle -->
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-tittle text-center">
                            <h2>Lista de Peliculas</h2>
                        </div>
                    </div>
                </div>

                <?php if((isset($seleccion))){ ?>       
                     <h3>Buscando por: <?=$seleccion?><h/3>
                <?php } ?>

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

        <!--    </div>  -->
</main>
     

