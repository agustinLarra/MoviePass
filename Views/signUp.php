<?php namespace Views;
?>
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
                                           <li><a href="<?php echo FRONT_ROOT?>Home/viewHome"> Home</a></li>
                                           <!-- ACA REDIRECCIONAR BIEN-->
                                           <li><a href="">Cartelera</a>
                                               <ul class="submenu">
                                                   <li><a href="<?php echo FRONT_ROOT?>Home/viewAddCine">Agregar Cines</a></li>
                                                </ul>
                                            </li>
       
                                            <li><a href="contact.html">Peliculas</a>
                                               <ul class="submenu">
                                               <li><a  href="<?php echo FRONT_ROOT?>Admin/actualizarPeliculas">Actualizar peliculas</a></li>
                                                  <!-- ACA EDITAR Funciones -->
                                                  <!-- ACA ELIMINAR Funciones -->
                                                  <!-- ACA LISTAR SALAS -->
                                                </ul>
                                            </li>
       
       
                                       </ul>
                                   </nav>
                               </div>
                           </div>     
                           
                   <?php if(!isset($_SESSION['userLog'])) { ?>
                           <div class="col-xl-2 col-lg-2 col-md-3">
                               <div class="header-right-btn f-right d-none d-lg-block">
                                   <a href="<?= FRONT_ROOT?>Home/Index" class="btn header-btn">Login</a>
                               </div>
                           </div>
                           <div class="col-xl-2 col-lg-2 col-md-3">
                               <div class="header-right-btn f-right d-none d-lg-block">
                                   <a href="<?= FRONT_ROOT?>Home/viewSignUp" class="btn header-btn">Sign Up</a>
                               </div>
                           </div>
                        <?php	} ?>
                        <?php if(isset($_SESSION['userLog'])) { ?>
                           <div class="col-xl-2 col-lg-2 col-md-3">
                               <div class="header-right-btn f-right d-none d-lg-block">
                                   <a href="<?= FRONT_ROOT?>User/logout" class="btn header-btn">Logout</a>
                               </div>
                           </div>
                        <?php	} ?>
                       </div>
                   </div>
               </div>
          </div>

 <!-- Slider Area Start-->
        <div class="services-area">
            <div class="container">
            <!-- Section-tittle -->
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="section-tittle text-center mb-80">
                        <span>Usuario</span>
                        <h2>Creando un nuevo usuario</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Slider Area End-->
         <div class="row d-flex justify-content-center"> 
                <div class="row">
                    <div class="col-12">
                       <!-- <h2 class="contact-title">Formulario</h2> -->
                     </div>
                    <div class="col-lg-8">
                    <form class="form-contact contact_form" action="<?= FRONT_ROOT ?> User/signUp" method="post">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="nombre" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = ''" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="apellido" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = ''" placeholder="Apellido">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="dni" id="subject" type="number" onfocus="this.placeholder = ''" onblur="this.placeholder = ''" placeholder="DNI">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="email" id="subject" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = ''" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="password" id="subject" type="password" onfocus="this.placeholder = ''" onblur="this.placeholder = ''" placeholder="Contrasena">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="button button-contactForm boxed-btn">Enviar</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="col-xl-2 col-lg-2 col-md-3">
                            <div class="header-right-btn f-right d-none d-lg-block">
                               <!-- <a href="addSalas.php" class="btn header-btn">Agregar salas a este cine</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

        </section>
