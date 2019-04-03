<?php


class CodeCategoryBD{

    function add_exist_article($id_article,$cantidad){
        //instanciación de la clase conexión a postgresql.
        $conexion = new ConexionPGSQL();
        $conexion->conectar();
        if(!$conexion->conectar()) return false;
        $query = "SELECT exist FROM  article  WHERE id={$id_article}";
        $resultado = pg_query($conexion->url, $query) or die("Error en la Consulta SQL");
        $article_cantidad=0;
        while ($fila=pg_fetch_array($resultado)) {
                $article_cantidad=$fila['exist'];
        }
        $total=$article_cantidad+$cantidad;
        $sql="UPDATE article SET exist=".$total." WHERE id={$id_article}";
        pg_query($conexion->url, $sql);
    }
}

    if(isset($_POST["save"]))
    {
        $user= $_POST['user'];  
        $date_sale=$_POST['date_sale'];     
        $sql = "INSERT INTO sale(date_sale,id_user) VALUES ('{$date_sale}',{$user})";
        pg_query( $conexion, $sql);
    }

    if(isset($_POST['update'])){
        $user= $_POST['user'];  
        $date_sale=$_POST['date_sale'];  
        $id=$_POST['id'];   
        $sql = "UPDATE sale SET date_sale='{$date_sale}',id_user={$user} WHERE id={$id}";
        pg_query( $conexion, $sql);
    }
    
    if(isset($_POST['delete'])){ 
        $id=$_POST['id'];
        $query = "SELECT id_article,quantity FROM article_sale WHERE id_sale={$id}";
        echo $query;
        $resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL");
        while ($fila=pg_fetch_array($resultado)) {

            $ccbd=new CodeCategoryBD();
            $ccbd->add_exist_article($fila['id_article'],$fila['quantity']);
        }
        $sql="DELETE FROM article_sale WHERE id_sale={$id}";
        pg_query( $conexion, $sql);
        $sql="DELETE FROM sale WHERE id={$id}";
        pg_query( $conexion, $sql);
    }
?>