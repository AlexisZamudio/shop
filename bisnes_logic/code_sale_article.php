<?php

class CodeCategoryBD{

    function save($id_article,$id_sale){
        //instanciación de la clase conexión a postgresql.
        $conexion = new ConexionPGSQL();
        $conexion->conectar();
        if(!$conexion->conectar()) return false;
        $query = "SELECT * FROM  article_sale  WHERE id_article={$id_article} AND id_sale={$id_sale} ";
        $resultado = pg_query($conexion->url, $query) or die("Error en la Consulta SQL");
        return (pg_num_rows($resultado)>0);
    }

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

    function remove_exist_article($id_article,$cantidad){
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
        $total=$article_cantidad-$cantidad;
        $sql="UPDATE article SET exist=".$total." WHERE id={$id_article}";
        pg_query($conexion->url, $sql);
    }

    function limit_article($id_article,$cantidad){
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
        return ($article_cantidad>=$cantidad);
    }
}

    //Method save category room
    //required only name
    if(isset($_POST["save"]))
    {
        $article= $_POST['article'];  
        $quantity=$_POST['quantity'];  
        $id_sale=$_POST['id_sale']; 
        $ccbd=new CodeCategoryBD();
        $status=$ccbd->save($article,$id_sale);
        if($status) {
             echo'<script type="text/javascript">
        alert("repetido");';
        echo 'window.location.href="../pages/sale_article.php?id_sale=';echo $id_sale; echo'"
        </script>';
        }  
        else {  
            if($ccbd->limit_article($article,$quantity))
            {
                $sql = "INSERT INTO article_sale(id_article,id_sale,quantity) VALUES ({$article},{$id_sale},{$quantity})";
                pg_query( $conexion, $sql);
                $ccbd=new CodeCategoryBD();
                $ccbd->remove_exist_article($article,$quantity);
                header("Location: ../pages/sale_article.php?id_sale=$id_sale");
            }else{
                echo'<script type="text/javascript">
                alert("Limite");';
                echo 'window.location.href="../pages/sale_article.php?id_sale=';echo $id_sale; echo'"
                </script>';
            }
  
        }
    }

    if(isset($_POST['delete'])){ 
        $id=$_POST['id'];
        $id_sale=$_POST['id_sale']; 
        $article= $_POST['article'];  
        $quantity=$_POST['quantity'];
        $sql="DELETE FROM article_sale WHERE id={$id}";
        pg_query( $conexion, $sql);
        $ccbd=new CodeCategoryBD();
        $ccbd->add_exist_article($article,$quantity);
        header("Location: ../pages/sale_article.php?id_sale=$id_sale");
    }

    if(isset($_POST['update'])){ 
        $id=$_POST['id'];
        $id_sale=$_POST['id_sale']; 
        $article= $_POST['article'];  
        $quantity=$_POST['quantity'];
        $before_quantity=$_POST['before_quantity'];
            if($before_quantity>$quantity) {
                $ccbd=new CodeCategoryBD();
                $all=$before_quantity-$quantity;
                $ccbd->add_exist_article($article,$all);
                $sql="UPDATE article_sale SET quantity={$quantity} WHERE id={$id}";
                pg_query( $conexion, $sql);
            }else {    
                $ccbd=new CodeCategoryBD();
                $all=$quantity-$before_quantity;
                $ccbd=new CodeCategoryBD();
                if($ccbd->limit_article($article,$quantity))
                {
                    $ccbd->remove_exist_article($article,$all);
                    $sql="UPDATE article_sale SET quantity={$quantity} WHERE id={$id}";
                    pg_query( $conexion, $sql);
                }else{
                    echo'<script type="text/javascript">
                    alert("Limite");';
                    echo 'window.location.href="../pages/sale_article.php?id_sale=';echo $id_sale; echo'"
                    </script>';
                }
            }
         header("Location: ../pages/sale_article.php?id_sale=$id_sale");
        
       
    }

?>