<header class="main-header">

     <!-- Logotipo -->
   <a href="" class="logo">
 
       <!-- Logo mini-->
<span class="logo-mini">

<img src="vistas/img/plantilla/cuadrito-lemars.png" class="img-responsive" style="height:10px 0px">

</span>

       <!-- Logo normal-->
       <span class="logo-lg">

<img src="vistas/img/plantilla/normal-lemars.png" class="img-responsive" style="height:10px 0px"

</span>

   </a>
 
   <!-- Barra de navegacion-->
<nav class="navbar navbar-static-top" role="navigation">
    
   <!-- Boton  de navegacion-->
   <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>
  <!-- perfil de usuario-->
   <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">

    <li class="dropdow user user-menu">

    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

    <?php

if($_SESSION["foto"] != ""){

  echo '<img src="'.$_SESSION["foto"].'" class="user-image">';

}else{


  echo '<img src="vistas/img/usuarios/default/anonymus.jpg" class="user-image">';

}


?>

<span class="hidden-xs"><?php  echo $_SESSION["nombre"]; ?></span>

    </a>

    <!-- dropdown-toggle-->

   <ul class="dropdown-menu">

     <li class="user-body">
 
     <div class="pull-right">
     <a href="perfil" class="btn btn-default btn-flat">Perfil</a>
     <a href="salida" class="btn btn-default btn-flat">Salir</a>

      </div>

     </li>

      </ul>
      </li>
    </ul>
     </div>
   
</nav>

  

</header>