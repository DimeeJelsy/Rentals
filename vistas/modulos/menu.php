<aside class="main-sidebar">

<section class="sidebar">

<ul class="sidebar-menu">


	
<?php

	if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial"){
echo '<li class="active">
    <a href="inicio">
        <i class="fa fa-home"></i>
        <span>Inicio</span>
        
    </a>
   
</li>';
}

  if($_SESSION["perfil"] == "Administrador"){

 echo' <li>

			<a href="usuarios">

					<i class="fa fa-user"></i>
					<span>Usuarios</span>

				</a>

			</li>';

        }

        if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial"|| $_SESSION["perfil"] == "Vendedor"){

           echo  '<li>

				<a href="categorias">

					<i class="fa fa-th"></i>
					<span>Categorias</span>

				</a>

			</li>
        

            <li>

<a href="productos">

    <i class="fa fa-product-hunt"></i>
    <span>Productos</span>

</a>

</li>
<li>

<a href="equipos">

    <i class="fa fa-truck"></i>
    <span>Equipos</span>

</a>

</li>


<li>

<a href="clientes">

    <i class="fa fa-users"></i>
    <span>Clientes</span>

</a>

</li>

<li>

<a href="proveedores">

    <i class="fa fa-user-secret"></i>
    <span>Proveedores</span>

</a>

</li>';

        }

        if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial"||  $_SESSION["perfil"] == "Vendedor"){

echo '<li  class="treeview">
    <a href="">
    <i class="fa fa-list-ul"></i>
    
    <span>Ventas</span>
    
    <span class="pull-right-container">

    <i class="fa fa-angle-left pull-right"></i>

    </span>
    </a>
    <ul class="treeview-menu">

    </li> 
    <li> 
        <a href="ventas">

             <i class="fa fa-circle-o"></i>
             <span>Administrar Ventas</span>

        </a>


     </li>

    <li> 
        <a href="crear-venta">

             <i class="fa fa-circle-o"></i>
             <span>Crear Nueva Venta</span>

        </a>

     </li>
    </ul>
</li>';

        }

?>


</section>

</aside>