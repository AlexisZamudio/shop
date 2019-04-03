<?php include('../bisnes_logic/conexion.php'); ?>
<?php include('../bisnes_logic/code_article.php'); ?>
<?php
$seleccionar=false;

//metodo de seleccionar
if(isset($_GET['sele'])){
    $idar=$_GET['sele'];
    $seleccionar=true;
    $record=pg_query($conexion,"SELECT article.id as idar ,article.name as articulo
    ,article.price as precio , article.exist as existencia , article.des as descripcion ,
    category_article.name as categoria ,category_article.id as idca FROM  article inner join 
    category_article on article.id_category_article=category_article.id where article.id={$idar}");

    if(@count($record)==1){
        $n=pg_fetch_array($record);
        $idar=$n['idar'];
        $articulo=$n['articulo'];
        $precio=$n['precio'];
        $existencia=$n['existencia'];
        $descripcion=$n['descripcion'];
        $categoria=$n['categoria'];
        $idca=$n['idca'];
    }
}
?>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Articulos</title>
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
    <h2 class="tittle_page_page"> Artículo</h2><br>
    <?php
            $query = 'SELECT article.id as "idar",article.name as "nombre",article.price as "precio",article.exist as "existencia"
            ,article.des as "descripcion",category_article.name as "catego" FROM  article inner join 
            category_article on article.id_category_article=category_article.id';
            $resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL");
            $numReg = pg_num_rows($resultado);
        
            if($numReg>0){
                echo "<table align='center'>
                <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Existencia</th>
                <th>Descripción</th>
                <th>Categoría</th><th>Selecionar</th></tr>";
                while ($fila=pg_fetch_array($resultado)) {
                echo "<tr>";
                echo "<td>".$fila['nombre']."</td>";
                echo "<td>$ ".$fila['precio']."</td>";
                echo "<td>".$fila['existencia']."</td>";
                echo "<td>".$fila['descripcion']."</td>";
                echo "<td>".$fila['catego']."</td>";
                echo "<td><a href=../pages/article.php?sele=".$fila['idar']." ><i class='fas fa-hand-pointer'></i></a></td></tr>";
                }
                                echo "</table>";
            }else
                                echo "No hay Registros";
        
    ?><br>
    <a href="article.php"><i class="fas fa-plus-circle fa-2x" style="color: #17a2b8;"></i></a>

<div  class="form_data">  
    <form method="post" action="article.php">
        <input  type="hidden" name="idar" value="<?php echo $idar; ?>"><br>
        <label>Nombre de artículo:</label><br>
        <input type="text" onkeypress="return soloLetras(event)" required id="articulo" name="articulo" value="<?php echo $articulo; ?>"
        placeholder="Nombre de un artículo"><br>
        <label>Precio: </label><br>
        <input type="text" name="precio" onkeypress="return filterFloat(event,this);" value="<?php echo $precio; ?>" required 
        placeholder="Ejemplo: 10.50"><br>
        <label>Existencia: </label><br>
        <input type="number" name="existencia" min="1" value="<?php echo $existencia; ?>" required ><br>
        <label>Descripción: </label><br>
        <input type="text" name="descripcion" onkeypress="return soloLetras(event)" value="<?php echo $descripcion; ?>" required
        placeholder="Ingresa una descripción"><br>
        <label>Selecciona una categoría: </label><br>
        <?php if($seleccionar == true): ?>
        <?php   $query="SELECT id,name FROM category_article"; 
                $r=pg_query($conexion,$query);
                $lista1="<select name='categoria'>\n<option selected value={$idca}>Categoria registrada: {$categoria}</option>
                \n<option>----------------------</option>"; 
                while($registro=pg_fetch_row($r)) 
                { $lista1.="\n<option value='".$registro[0]."'>".$registro[1]."</option>"; } 
                $lista1.="\n</select><br><br>"; 
                echo $lista1; 
        ?>
        <button class="btn btn_update" type="submit" name="update">Actualizar <i class="fas fa-pen"></i></button>&nbsp;&nbsp;
        <button class="btn btn_delete" type="submit" name="eliminar">Eliminar <i class="fas fa-trash"></i></button><br><br>
        <?php else: ?>
        <?php 
        $query="SELECT id,name FROM category_article"; 
        $r=pg_query($conexion,$query);
        $lista1="<select name='categoria'>\n<option selected>Click aquí</option>"; 
        while($registro=pg_fetch_row($r)) 
        { 
        $lista1.="\n<option value='".$registro[0]."'>".$registro[1]."</option>"; 
        } 
        $lista1.="\n</select><br><br>"; 
        echo $lista1; 
        ?>
        <button class="btn btn_add"  type="submit" name="guardar">Guardar <i class="fas fa-save"></i></button><br><br>

<?php endif ?>
</form> 
</div> 

</section>
    </div>
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
</body>
</html>