
<?php
    	if(isset($_POST['insert'])){
        $categoria = $_POST['categoria'];
        $query = "select * from category_article where name='{$categoria}'";
        $resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL");
        if(pg_num_rows($resultado)>0){
            echo'<script type="text/javascript">
            alert("Esta categoría ya existe");
            window.location.href="../pages/category_article.php";
            </script>';
        }elseif(pg_num_rows($resultado)==0){
		$insertar = "INSERT INTO category_article(name,tm_add,tm_update) VALUES ('{$categoria}','now()','now()')";
		$ejecutar = pg_query($conexion,$insertar);
		if($ejecutar){
		echo "<script>window.open('category_article.php','_self')</script>";
        }
        }
    }

?> 

    <?php 
    if(isset($_POST['update'])){
        $actualizar_categoria = $_POST['categoria'];
        $id_actu=$_POST['id'];
        $query = "select * from category_article where name='{$actualizar_categoria}'";
        $resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL");
        if(pg_num_rows($resultado)>0){
            echo'<script type="text/javascript">
            alert("Esta categoría ya existe");
            window.location.href="../pages/category_article.php";
            </script>';
        }elseif(pg_num_rows($resultado)==0){
        $actualizar = "UPDATE category_article SET name='$actualizar_categoria',tm_update='now()' WHERE id=$id_actu";
        $ejecutar = pg_query($conexion, $actualizar);
        if($ejecutar){
        echo "<script>window.open('../pages/category_article.php','_self')</script>";
        }
    }
    }
    ?> 

 <?php 
        if(isset($_POST['eliminar'])){

        $borrar_id = $_POST['id'];
        $borrar = "DELETE FROM article WHERE  id_category_article=$borrar_id";
        $ejecutar = pg_query($conexion, $borrar); 

      
        $borrar = "DELETE FROM category_article WHERE id=$borrar_id";
        $ejecutar = pg_query($conexion, $borrar); 
            if($ejecutar){
            echo "<script>window.open('../pages/category_article.php','_self')</script>";
            }
        }
    
    ?>
