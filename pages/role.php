<?php include('../bisnes_logic/conexion.php'); ?>
<?php include('../bisnes_logic/code_role.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Role</title>
    <link href="../shared/styles/role.css" rel="stylesheet">
    <link href="../shared/styles/generic_style.css" rel="stylesheet">
    <link href="../shared/styles/index.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../shared/styles/style-h.css">

    <!-- Recurso adicional-->
    <link href="../shared/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="../shared/fontawesome/css/brands.css" rel="stylesheet">
    <link href="../shared/fontawesome/css/solid.css" rel="stylesheet">
</head>
</head>
<body>
<script>
    function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = "áéíóúabcdefghijklmnñopqrstuvwxyz ";

        if(letras.indexOf(tecla)==-1){
            return false;
        }
    }

    function soloNumeros(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = "0123456789.";

        if(letras.indexOf(tecla)==-1){
            return false;
        }
    }

    function soloNumeros2(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = "0123456789";

        if(letras.indexOf(tecla)==-1){
            return false;
        }
    }


    function filterFloat(evt,input){
    // Backspace = 8, Enter = 13, ‘0' = 48, ‘9' = 57, ‘.’ = 46, ‘-’ = 43
    var key = window.Event ? evt.which : evt.keyCode;    
    var chark = String.fromCharCode(key);
    var tempValue = input.value+chark;
    if(key >= 48 && key <= 57){
        if(filter(tempValue)=== false){
            return false;
        }else{       
            return true;
        }
    }else{
          if(key == 8 || key == 13 || key == 0) {     
              return true;              
          }else if(key == 46){
                if(filter(tempValue)=== false){
                    return false;
                }else{       
                    return true;
                }
          }else{
              return false;
          }
    }
}
function filter(__val__){
    var preg = /^([0-9]+\.?[0-9]{0,2})$/; 
    if(preg.test(__val__) === true){
        return true;
    }else{
       return false;
    }
    
}
 
</script>
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
    <h2 class="tittle_page_page"> Role</h2><br>

    <div class="body-table">
    <?php
    $query = "SELECT id,name,tm_add,tm_update,active FROM role";
    $resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL");
    $numReg = pg_num_rows($resultado);

    if($numReg>0){
        echo "<table align='center'>
        <tr>
        <th>Nombre</th>
        <th>Agregado</th>
        <th>Editado</th>
        <th>Activo</th>
        <th></th>
        </tr>";
        while ($fila=pg_fetch_array($resultado)) {
        echo "<tr>";
        echo "<td>".$fila['name']."</td>";
        echo "<td>".$fila['tm_add']."</td>";
        echo "<td>".$fila['tm_update']."</td>";
        if($fila['active']=='t') {
            echo "<td>Verdadero</td>";
        }else if($fila['active']=='f') {    echo "<td>Falso</td>";}
    
        ?>
         <td>
         <i class="fas fa-edit "  onclick="update_role(<?php echo $fila['id'].",'{$fila['name']}','{$fila['active']}'" ?>)"></i>
         <i class="fas fa-trash " onclick="delete_role(<?php echo $fila['id'].",'{$fila['name']}'" ?>)"></i>
        </td>
        <?php echo "</tr>";
        }
                        echo "</table>";
    }else
                        echo "No hay Registros";
?>

    </div>
    <i class="fas fa-plus-circle fa-2x" style="color: #17a2b8;" onclick="add_role()"></i>
<div class="form_data" id="container_button_add_role">
<form action="role.php" method="post">
        <h3>Agregar</h3>   
        <label>Nombre</label>
        <input type="text" name="name" onkeypress="return soloLetras(event)"  required placeholder="nombre">
        <button  class="btn btn_add" name="guardar">Guardar <i class="fas fa-save"></i></button>
    </form>
</div>
    

<div class="form_data" id="container_button_update_role">
<form action="role.php" method="post">
        <h3>Editar</h3>   
        <input type="hidden" name="id" id="id_role_update">
        <label>Nombre</label>
        <input type="text" name="name" onkeypress="return soloLetras(event)"  required placeholder="nombre" id="name_role_update">
        <label>Activo</label><br>
        Verdadero
        <input type="radio" class="radio_btn" name="active_t" value="t">
        Falso   
        <input type="radio" class="radio_btn" name="active_t" value="f">
        <button  class="btn btn_update" name="update">Actualizar <i class="fas fa-pen"></i></button>
    </form>
</div>


<div class="form_data" id="container_button_delete_role">
<form action="role.php" method="post">
        <h3>Borrar</h3>   
        <input type="hidden" name="id" id="id_role_delete">
        <label>Nombre</label>: <br>
        <label id="name_role_delete"></label>
        <br> 
        <button  class="btn btn_delete" name="delete">Eliminar <i class="fas fa-trash"></i></button>
    </form>
</div>
</section>
    </div>

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
<script src="../js/role.js"></script>
</body>
</html>