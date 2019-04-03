<?php include('../bisnes_logic/conexion.php'); ?>
<?php include('../bisnes_logic/code_user_shop.php'); ?>

<script>
    function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = "áéíóúabcdefghijklmnñopqrstuvwxyz";

        if(letras.indexOf(tecla)==-1){
            return false;
        }
    }

     function soloNumeros(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = "0123456789";

        if(letras.indexOf(tecla)==-1){
            return false;
        }
    }
</script>

<?php
   $id='';
   $name='';
    $age='';
    $phone='';
   $address='';
   $active='t';
    $id_role='';
   $seleccionar=false;
if(isset($_GET['sele'])){
    $id=$_GET['sele'];
    $seleccionar=true;
    $record=pg_query($conexion,"SELECT * from user_shop WHERE id={$id}");
    if(@count($record)==1){
        $n=pg_fetch_array($record);
        $id=$n['id'];
        $name=$n['name'];
        $age=$n['age'];
        $phone=$n['phone'];
        $address=$n['address'];
        $active=$n['active'];
        $id_role=$n['id_role'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuario</title>
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
    <h2 class="tittle_page_page">Usuarios</h2><br>
    <?php
    $query = "
    SELECT user_shop.id AS id,user_shop.name AS name,age,phone,address,user_shop.active AS active,id_role, (SELECT name FROM role WHERE id=id_role) AS name_role,user_shop.tm_add AS tm_add,user_shop.tm_update AS tm_update FROM user_shop;";
   $resultado = pg_query($conexion, $query);
    $numReg = pg_num_rows($resultado);

    if($numReg>0){
        echo "<table align='center'>
        <tr>
        <th>Nombre</th>
        <th>Edad</th>
        <th>Teléfono</th>
        <th>Dirección</th>
        <th>Activo</th>
        <th>Rol</th>
        <th>Agregado</th>
        <th>Actualizado</th>
        <th>Seleccionar</th>
        </tr>";
        while ($fila=pg_fetch_array($resultado)) {
        echo "<tr>";
        echo "<td>".$fila['name']."</td>";
        echo "<td>".$fila['age']."</td>";
        echo "<td>".$fila['phone']."</td>";
        echo "<td>".$fila['address']."</td>";
        echo "<td>".$fila['active']."</td>";
        echo "<td>".$fila['name_role']."</td>";    
        echo "<td>".$fila['tm_add']."</td>";
        echo "<td>".$fila['tm_update']."</td>";
        echo "<td><a href=../pages/user_shop.php?sele=".$fila['id']." > <i class='fas fa-hand-pointer'></i></a></td>";
        }
                        echo "</table>";
    }else
                        echo "No hay Registros";
    
?>
<br>
<a href="user_shop.php">
<i class="fas fa-plus-circle fa-2x" style="color: #17a2b8;"></i>
</a>

<div  class="form_data" id="container_button_add_sale">
<form method="post" action="user_shop.php">
<input  type="hidden" name="id" value="<?php echo $id; ?>"><br>
		<label>Nombre:</label>
		<input type="text" value="<?php echo $name; ?>"  required onkeypress="return soloLetras(event)" name="name" placeholder="Nombre"/><br/> 
        <label>Edad:</label>
        <input type="text" value="<?php echo $age; ?>"  required onkeypress="return soloNumeros(event)" name="age" placeholder="Edad"/><br/>
        <label>Teléfono:</label>
        <input type="text" value="<?php echo $phone; ?>"  required onkeypress="return soloNumeros(event)" name="phone" placeholder="Número"/><br/>  
        <label>Dirección:</label>
        <input type="text" value="<?php echo $address; ?>" required onkeypress="return soloLetras(event)"name="address" placeholder="Dirección"/><br/>
         <label>Activo:</label>
         <?php 
            if($active == 't'){
                echo '  <input type="radio" value="true"  name="active" checked="checked"   /> True
                <input type="radio" value="false"  name="active" />False<br/> ';
            }else if($active='f'){
                    echo '  <input type="radio" value="true"  name="active" /> True
                    <input type="radio" value="false"  name="active" checked="checked" />False<br/> ';
            }
         ?>
      
        <label>Selecciona un rol: </label><br>
        <?php   $query="SELECT id,name FROM role WHERE active=true"; 
                    $r=pg_query($conexion,$query);
                    $lista1="<select name='id_role'>"; 
                    while($registro=pg_fetch_row($r)) 
                    { $lista1.="<option value='".$registro[0]."'>".$registro[1]."</option>"; } 
                    $lista1.="</select>"; 
                    echo $lista1; 
            ?>
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
</html>