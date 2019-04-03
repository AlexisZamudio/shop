<?php include('../bisnes_logic/conexion.php'); ?>
<?php include('../bisnes_logic/code_category_room.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category room</title>
    <link href="../shared/styles/category_room.css" rel="stylesheet">
    <link href="../shared/styles/generic_style.css" rel="stylesheet">
    <link href="../shared/styles/index.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../shared/styles/style-h.css">

    <!-- Recurso adicional-->
    <link href="../shared/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="../shared/fontawesome/css/brands.css" rel="stylesheet">
    <link href="../shared/fontawesome/css/solid.css" rel="stylesheet">
</head>
<body>
   <header>
  
      <h1>¡SHOP</h1>
   
     	<nav>
         <a href="../index.html"> Inicio</a>
          <a href="category_article.php">Categoría de artículos</a>
          <a href="article.php">Artículo</a>
          <a href="sale.php">Ventas</a>
          <a href="user_shop.php">Usuarios</a>
          <a href="role.php">Rol</a>
          <a href="about.html">Acerca de </a>
    </nav>
   
 </header>

    
    <div class="wrapper">
    <section>
        <h2 class="tittle_page_page">Categoria de cuarto</h2><br>
        <?php 
                $query = "SELECT id,name,tm_add,tm_update FROM  category_departament";
                $resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL");
                $numReg = pg_num_rows($resultado);
            
                if($numReg>0){
                    echo "<table align='center'>
                        <tr>
                            <th>Nombre</th>
                            <th>TM Add</th>
                            <th>TM Update</th>
                            <th></th>
                        </tr>";
                        while ($fila=pg_fetch_array($resultado)) {
                        echo " <tr>";
                        echo "<td>".$fila['name']."</td> <td>".$fila['tm_add']."</td><td>".$fila['tm_update']."</td>";
                        ?>
                            <td>
                            <i class="fas fa-edit " onclick="update_category_room(<?php echo $fila['id'].",'{$fila['name']}'" ?>)"></i>
                            <i class="fas fa-trash " onclick="delete_category_room(<?php echo $fila['id'].",'{$fila['name']}'" ?>)"></i>
                            </td>
                        </tr>
                        <?php    
                        }
                    echo "</table>";
                }else  echo "No hay Registros";        
    ?>
   
   <br>
   <i class="fas fa-plus-circle fa-2x" style="color: #17a2b8;" onclick="add_category_room()"></i>
    
    <div  class="form_data" id="container_button_add_category_room">
        <form method="post" action="category_room.php"> 
            <h3>Agregar</h3>
            <label>Nombre</label>
            <input id="name_category_room" type="text" name="name" required>
            <button class="btn btn_add" type="submit" name="save">Guardar <i class="fas fa-save"></i></button>
        </form>
    </div>

    <div class="form_data" id="container_button_update_category_room">        
        <form method="post" action="category_room.php"> 
            <h3>Editar</h3>   
            <input id="id_category_room_update" type="hidden" name="id" required>
            <label>Nombre</label>
            <input id="name_category_room_update" type="text" name="name" required>
                <button class="btn btn_update" type="submit" name="update">Actualizar</button>
        </form>
    </div>

    <div  class="form_data" id="container_button_delete_category_room">        
        <form method="post" action="category_room.php"> 
            <h3>Eliminar</h3>    
            <input id="id_category_room_delete" type="hidden" name="id" required>
            <label>Nombre: </label>
            <br>
            <label id="name_category_room_delete"></label>
            <br>
            <button class="btn btn_delete" type="submit" name="delete">Borrar</button>
        </form>
    </div>

    </section>
    </div>
</body>
<footer>
    <div class="container-footer-all">
        <div class="container-body">
            <div class="colum1">
                <h1>Información de la página</h1>
                <p>Esta página es creada con el fin de gestionar las ventas de la tienda iShop.</p>
            </div>
            <div class="colum2">
                <h1>Desarrolladores</h1>
                <div class="row">
                    <label>Jorge Jacobo</label>
                </div>
                <div class="row">
                    <label>Amanda Franco</label>
                </div>
                <div class="row">
                    <label>Alexis Zamudio</label>
                </div>
                <div class="row">
                    <label>David Hernández</label>
                </div>
            </div>
            <div class="colum3">
                <h1>Información de la tienda</h1>
                <div class="row2">
                    <label>iShop es una tienda que vende diferentes artículos para todo el público.</label>
                </div>
            </div>
        </div>
    </div>
    <div class="container-footer">
        <div class="footer">
            <div class="copyright">
                © 2019 Todos los Derechos Reservados para | iSHOP
            </div>
        </div>
    </div>
</footer>
<script src="../js/category.js"></script>
</html>