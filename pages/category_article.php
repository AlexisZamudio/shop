<?php include('../bisnes_logic/conexion.php'); ?>
<?php include('../bisnes_logic/code_category_article.php'); ?>

<script>
    function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = "áéíóúabcdefghijklmnñopqrstuvwxyz";

        if(letras.indexOf(tecla)==-1){
            return false;
        }
    }
</script>

<?php
   $id='';
   $name='';
   $seleccionar=false;
if(isset($_GET['sele'])){
    $id=$_GET['sele'];
    $seleccionar=true;
    $record=pg_query($conexion,"SELECT * from category_article WHERE id={$id}");
    if(@count($record)==1){
        $n=pg_fetch_array($record);
        $id=$n['id'];
        $name=$n['name'];
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category Article</title>
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
    <h2 class="tittle_page_page">Categoría de artículo</h2><br>

    <?php  
         $query = "SELECT id,name,tm_add,tm_update FROM  category_article";
         $resultado = pg_query($conexion, $query);
         $numReg = pg_num_rows($resultado);
     
         if($numReg>0){
             echo "<table align='center'>
             <tr>
             <th>Nombre</th>
             <th>Agregado</th>
             <th>Actualizado</th>
             <th>Seleccionar</th>
             </tr>";
             while ($fila=pg_fetch_array($resultado)) {
             echo "<tr>";
             echo "<td><a href=../pages/category_article.php?sele=".$fila['id']." >".$fila['name']."</a></td>";
             echo "<td>".$fila['tm_add']."</td>";
             echo "<td>".$fila['tm_update']."</td>";
             echo "<td><a href=../pages/category_article.php?sele=".$fila['id']." > <i class='fas fa-hand-pointer'></i></a></td>";
             }
                             echo "</table>";
         }else
                             echo "No hay Registros";
         
     
    ?>
    <br>
   <a href="category_article.php"><i class="fas fa-plus-circle fa-2x" style="color: #17a2b8;"></i></a>
<div  class="form_data">  
<form method="post" action="">
<input  type="hidden" name="id" value="<?php echo $id; ?>"><br>
		<label>Categoría:</label>
		<input type="text" value="<?php echo $name; ?>"  required onkeypress="return soloLetras(event)" name="categoria" placeholder="Nombre"/><br/> 
        <?php if($seleccionar == true): ?>
        <button class="btn btn_update" type="submit" name="update">Actualizar <i class="fas fa-pen"></i></button>&nbsp;&nbsp;
        <button class="btn btn_delete" type="submit" name="eliminar">Eliminar <i class="fas fa-trash"></i></button><br><br>
    <?php else: ?>
    <button class="btn btn_add" type="submit" name="insert">Guardar <i class="fas fa-save"></i></button><br><br>
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