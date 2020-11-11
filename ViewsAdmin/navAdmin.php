<div class="header-area header-transparrent ">
        <div class="main-header header-sticky">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Logo -->
                    <div class="col-xl-2 col-lg-2 col-md-1">
                        <div class="logo">
                            <a>MOVIEPASS</a>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-8">
                        <!-- Main-menu -->
                        <div class="main-menu f-right d-none d-lg-block">
                            <nav> 
                                <ul id="navigation">    
                                    <li><a href="<?php echo FRONT_ROOT?>Home/viewHomeAdmin"> Home Admin</a></li>
                                    <!-- ACA REDIRECCIONAR BIEN-->
                                    <li><a href="">Cines</a>
                                        <ul class="submenu">
                                            <li><a href="<?php echo FRONT_ROOT?>Home/viewAddCine">Agregar Cines</a></li>
                                               <!-- ACA EDITAR CINE -->
                                                <!-- ACA ELIMINAR CINE -->
                                            <li><a href="<?php echo FRONT_ROOT?>Home/viewListCines">Lista de cines</a></li>
                                         </ul>
                                     </li>
                                      <!-- ACA REDIRECCIONAR BIEN-->
                                     <li><a href="">Salas</a>
                                        <ul class="submenu">
                                        <li><a href="<?php echo FRONT_ROOT?>Home/viewAddSalas">Agregar Salas</a></li>
                                           <!-- ACA EDITAR SALA -->
                                           <li><a href="<?php echo FRONT_ROOT?>Home/viewListSalas">Listar Salas</a></li>
                                                 <!-- ACA LISTAR SALAS -->
                                         </ul>
                                     </li>

                                     <li><a href="">Funciones</a>
                                        <ul class="submenu">
                                        <li><a href="<?php echo FRONT_ROOT?>Home/viewAddFunciones">Agregar Funciones</a></li>
                                           <!-- ACA EDITAR Funciones -->
                                        <li><a href="<?php echo FRONT_ROOT?>Home/viewListFunciones">Listar Funciones</a></li>
                                           <!-- ACA LISTAR SALAS -->
                                         </ul>
                                     </li>

                                     <li><a href="">Peliculas</a>
                                        <ul class="submenu">
                                        <li><a  href="<?php echo FRONT_ROOT?>Admin/actualizarPeliculas">Actualizar peliculas</a></li>
                                        <li><a  href="<?php echo FRONT_ROOT?>Home/viewListPeliculas">Listado de peliculas</a></li>
                                           <!-- ACA EDITAR Funciones -->
                                           <!-- ACA ELIMINAR Funciones -->
                                           <!-- ACA LISTAR SALAS -->
                                         </ul>
                                     </li>

                                     <li><a href="">Ventas</a>
                                        <ul class="submenu">
                                        <li><a  href="<?php echo FRONT_ROOT?>Home/viewConsultaTotalesVendidos">Totales vendidos</a></li>
                                         </ul>
                                     </li>

                                    






                                </ul>
                            </nav>
                        </div>
                    </div>     
                    
                  
                              
                    <div class="col-xl-2 col-lg-2 col-md-3">
                        <div class="header-right-btn f-right d-none d-lg-block">
                            <a href="<?= FRONT_ROOT?>User/logout" class="btn header-btn">Cerrar Sesion</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>

   <br> <br>
