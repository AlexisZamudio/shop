<?php include('../bisnes_logic/conexion.php'); ?>
<?php include('../bisnes_logic/code_sale.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category room</title>
    <link href="../shared/styles/sale.css" rel="stylesheet">
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
            <h1>CLOTHING STORE</h1>
            <nav>
            <a href="../index.html"> Inicio</a>
          <a href="category_article.php">Categoría de artículos</a>
          <a href="article.php">Artículo</a>
          <a href="sale.php">Ventas</a>
          <a href="about.html">Acerca de </a>
            </nav>
    </header>
    <div class="wrapper">
    <section>
        <h2 class="tittle_page_page">Ventas</h2><br>
        <?php 
                $query = "SELECT sale.id as id_sale, name,date_sale,sale.id_user AS id_user, (SELECT SUM ((quantity*article.price)) FROM article_sale INNER JOIN article
                ON article_sale.id_article=article.id WHERE 
               article_sale.id_sale=sale.id) AS total FROM sale  INNER JOIN user_shop ON sale.id_user=user_shop.id";
                $resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL");
                $numReg = pg_num_rows($resultado);
            
                if($numReg>0){
                    echo "<table align='center'>
                        <tr>
                            <th>Usuario</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Opciones</th>
                        </tr>";
                        while ($fila=pg_fetch_array($resultado)) {
                        echo " <tr>";
                        echo "<td>".$fila['name']."</td> <td>".$fila['date_sale']."</td> <td> $ ".$fila['total']."</td>";
                        ?>
                            <td>
                                <a href="sale_article.php?id_sale=<?php echo $fila['id_sale']?>">Articulos</a>
                            <i class="fas fa-edit " onclick="update_sale(<?php echo $fila['id_sale'].",'{$fila['date_sale']}',{$fila['id_sale']}" ?>)"></i>
                            <i class="fas fa-trash " onclick="delete_sale(<?php echo $fila['id_sale'].",'{$fila['date_sale']}','{$fila['name']}',{$fila['total']}" ?>)"></i>
                            </td>
                        </tr>
                        <?php    
                        }
                    echo "</table>";
                }else  echo "No hay Registros";        
    ?>
   
   <br>
   <i class="fas fa-plus-circle fa-2x" style="color: #17a2b8;" onclick="add_sale()"></i>
    
    <div  class="form_data" id="container_button_add_sale">
        <form method="post" action="sale.php"> 
            <h3>Agregar</h3>
            <label>Usuario</label>

            <?php   $query="SELECT id,name FROM user_shop WHERE active=true"; 
                    $r=pg_query($conexion,$query);
                    $lista1="<select name='user'>"; 
                    while($registro=pg_fetch_row($r)) 
                    { $lista1.="<option value='".$registro[0]."'>".$registro[1]."</option>"; } 
                    $lista1.="</select>"; 
                    echo $lista1; 
            ?>
            <label>Fecha</label>
            <input name="date_sale" type="date" required>
            <button class="btn btn_add" type="submit" name="save">Guardar <i class="fas fa-save"></i></button>
        </form>
    </div>

    <div class="form_data" id="container_button_update_sale">        
        <form method="post" action="sale.php"> 
            <h3>Editar</h3>   
            <input id="id_sale_update" type="hidden" name="id" required>
            <label>Usuario</label>
            <?php   $query="SELECT id,name FROM user_shop WHERE active=true"; 
                    $r=pg_query($conexion,$query);
                    $lista1="<select name='user'>"; 
                    while($registro=pg_fetch_row($r)) 
                    { $lista1.="<option value='".$registro[0]."'>".$registro[1]."</option>"; } 
                    $lista1.="</select>"; 
                    echo $lista1; 
            ?>
            <label>Fecha</label>
            <input id="date_sale_update" name="date_sale" type="date" required>
                <button class="btn btn_update" type="submit" name="update">Actualizar <i class="fas fa-pen"></i></button>
        </form>
    </div>

    <div  class="form_data" id="container_button_delete_sale">        
        <form method="post" action="sale.php"> 
            <h3>Eliminar</h3>    
            <input id="id_sale_delete" type="hidden" name="id" required>
            <label>Usuario: </label>
            <label id="name_users_sale_delete">Ejemplo</label>
            <br>
            <label>Fecha: </label>
            <label id="date_sale_delete"></label>
            <br>
            <label>Total de la venta: </label>
            <label id="all_sale_delete"></label>
            <br>
            <button class="btn btn_delete" type="submit" name="delete">Borrar  <i class="fas fa-trash"></i></button>
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
                <p>La primer funcionalidad de la pagina es mostrar los articulos de moda en venta</p>
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
                    <label>Clothing store es una tienda dedicada a vender moda desde el 2019</label>
                </div>
            </div>
        </div>
    </div>
    <div class="container-footer">
        <div class="footer">
            <div class="copyright">
                © 2019 Todos los Derechos Reservados para | Clothing Store
            </div>
        </div>
    </div>
</footer>
<script src="../js/sale.js"></script>
</html>