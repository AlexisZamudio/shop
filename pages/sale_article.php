<?php include('../bisnes_logic/conexion.php'); ?>
<?php include('../bisnes_logic/code_sale_article.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category room</title>
    <link href="../shared/styles/sale_article.css" rel="stylesheet">
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
        <h2 class="tittle_page_page">Articulos de venta</h2><br>
        <?php 
                $total=0;
                $id_sale=$_GET['id_sale'];
                $query = "SELECT s.id AS id,a.name AS name,a.price AS price,s.quantity AS quantity ,a.id AS id_article FROM article_sale s INNER JOIN article a ON s.id_article=a.id 
                WHERE s.id_sale={$id_sale}";
                $resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL");
                $numReg = pg_num_rows($resultado);

                if($numReg>0){
                    echo "<table align='center'>
                        <tr>
                            <th>Articulo</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th></th>
                        </tr>";
                        while ($fila=pg_fetch_array($resultado)) {
                            $total=$total+$fila['quantity']*$fila['price'];
                        echo " <tr>";
                        echo "<td>".$fila['name']."</td> <td>$".$fila['price']."</td>";
                        echo "<td>".$fila['quantity']."<td>";
                        echo "<td>$".($fila['quantity']*$fila['price'])."<td>";
                        ?>
                            <td>
                            <i class="fas fa-edit " onclick="update_sale_category(
                                <?php echo $fila['id'].",'{$fila['name']}',".$fila['price'].","
                                .$fila['quantity'].","
                                .$fila['id_article'].",'"
                                .$fila['name']."')" ?>"></i>
                            <i class="fas fa-trash " onclick="delete_sale_category(
                                <?php echo $fila['id'].",'{$fila['name']}',".$fila['price'].","
                                .$fila['quantity'].","
                                .$fila['id_article'].",'"
                                .$fila['name']."')" ?>"></i>
                            </td>
                        </tr>
                        <?php    
                        }
                    echo "</table>";
                    echo "<br>";

                    echo "Total de venta : $".$total;
                }else  echo "No hay Registros";        
    ?>
   
   <br>
   <i class="fas fa-plus-circle fa-2x" style="color: #17a2b8;" onclick="add_sale_category()"></i>
    
    <div  class="form_data" id="container_button_add_sale_article">
        <form method="post" action="sale_article.php"> 
            <h3>Agregar</h3>
            <label>Articulo</label>
            <?php   $query="SELECT id,name,price FROM article WHERE exist>0"; 
                    $r=pg_query($conexion,$query);
                    $lista1="<select name='article'>"; 
                    while($registro=pg_fetch_row($r)) 
                    { $lista1.="<option value='".$registro[0]."'>".$registro[1]. " $ ".$registro[2]."</option>"; } 
                    $lista1.="</select>"; 
                    echo $lista1; 
            ?>
            <label>Cantidad</label>
            <input name="quantity" type="number" min="1" required>
            <input name="id_sale" type="hidden" value="<?php echo $id_sale?>">
            <button class="btn btn_add" type="submit" name="save">Guardar <i class="fas fa-save"></i></button>
        </form>
    </div>

    <div class="form_data" id="container_button_update_sale_article">        
        <form method="post" action="sale_article.php"> 
            <h3>Editar</h3>   
            <input name="id_sale" type="hidden" value="<?php echo $id_sale?>">
            <input id="id_category_room_update" type="hidden" name="id" required>
            <label>Nombre articulo: </label>
            <label id="name_article_sale_article_update"></label>
            <br>
            <label>Cantidad</label>
            <input id="quality_article_sale_article_update" name="quantity" min="1" type="number" required>
            <input id="before_quantity_article_sale_article_update" name="before_quantity" type="hidden" required>
            <input name="article" type="hidden" id="article_update">
            <button class="btn btn_update" type="submit" name="update">Actualizar <i class="fas fa-pen"></i></button>
        </form>
    </div>

    <div  class="form_data" id="container_button_delete_sale_article">        
        <form method="post" action="sale_article.php"> 
            <h3>Eliminar</h3>  
            <input name="id_sale" type="hidden" value="<?php echo $id_sale?>"> 
            <input id="article_id_delete" name="article" type="hidden" required>
            <input id="quantity_delete" name="quantity" type="hidden" required>
            <input id="id_sale_article_delete" type="hidden" name="id" required>
            <label>Nombre articulo: </label>
            <label id="name_article_sale_article_delete"></label>
            <br>
            <label>Precio articulo: </label>
            <label id="price_article_sale_article_delete"></label>
            <br>
            <label>Cantidad articulo: </label>
            <label id="quality_article_sale_article_delete"></label>
            <br>
            <label>Total articulo: </label>
            
            <label id="all_sale_article_delete"></label>
        
            <br>
            <button class="btn btn_delete" type="submit" name="delete">Borrar <i class="fas fa-trash"></i></button>
        </form>
    </div>

    <a href="sale.php">
        <button class="btn" type="submit" name="delete">
        <i class="fas fa-long-arrow-alt-left"></i> Regresar
        </button>
        </a>
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
<script src="../js/sale_category.js"></script>
</html>