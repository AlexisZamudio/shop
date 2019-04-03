<?php
$idar=0;
$articulo="";
$precio="";
$existencia="";
$descripcion="";
$categoria=0;
    

/**Metodo guardar */
if(isset($_POST['guardar']))
    {
        $articulo=$_POST['articulo'];
        $precio=$_POST['precio'];
        $existencia=$_POST['existencia'];
        $descripcion=$_POST['descripcion'];
        $categoria=$_POST['categoria'];

        $query = "select * from article where name='{$articulo}'";
        $resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL");
        if($categoria=="Click aquí"){
            echo'<script type="text/javascript">
            alert("Ingresa una categoría");
            window.location.href="../pages/article.php";
            </script>';
        }else{
            if(pg_num_rows($resultado)>0){
                echo'<script type="text/javascript">
                alert("Ese articulo ya existe");
                window.location.href="../pages/article.php";
                </script>';
            }elseif(pg_num_rows($resultado)==0){
            
                    if($existencia<=0){
                        echo'<script type="text/javascript">
                        alert("Ingresa una existencia valida");
                        window.location.href="../pages/article.php";
                        </script>';
                    }elseif($existencia>0){
                    //pg_query("INSERT INTO article VALUES (10,'holaaa','2 w','now()','now()',1)");
                    pg_query("INSERT INTO  article (name,price,exist,des,tm_add,tm_update,id_category_article) VALUES ('{$articulo}','{$precio}',{$existencia},'{$descripcion}','now()','now()',{$categoria})");
                    header('location:../pages/article.php');  
                    }   
            
            }
       
        }
    }

     /*Metodo actualizar */
     if(isset($_POST['update'])){
        $idar=$_POST['idar'];
        $articulo=$_POST['articulo'];
        $precio=$_POST['precio'];
        $existencia=$_POST['existencia'];
        $descripcion=$_POST['descripcion'];
        $categoria=$_POST['categoria'];
        $query = "select * from article where name='{$articulo}'";
        $resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL");
        if($categoria=="----------------------"){
            echo'<script type="text/javascript">
            alert("Ingresa una categoría");
            window.location.href="../pages/article.php";
            </script>';
        }else{  
                    if($existencia<=0){
                        echo'<script type="text/javascript">
                        alert("Ingresa una existencia valida");
                        window.location.href="../pages/article.php";
                        </script>';
                    }elseif($existencia>0){
                        pg_query("UPDATE article set name='$articulo',price='$precio',
                        exist='$existencia',des='$descripcion',
                        tm_update=now(),id_category_article='$categoria' where id=$idar");
                        header('location:../pages/article.php');
                    }
            }
    }//llave grande

    /*Metodo eliminar */
    if(isset($_POST['eliminar'])){
        $idar=$_POST['idar'];
        pg_query("delete from article where id=$idar");
        header('location:../pages/article.php');
    }

    ?>