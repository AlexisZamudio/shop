<?php
    
    if(isset($_POST['guardar'])){
        $name=$_POST['name'];
        $sql = "INSERT INTO role(name,tm_add,tm_update,active) VALUES ('{$name}','now()','now()',TRUE)";
        pg_query( $conexion, $sql);
    }

     if(isset($_POST['update'])){
        $name= $_POST['name'];  
        $id=$_POST['id'];
        $active=$_POST['active_t'];

        if($active=='t') {
           $active='true';
        }else if ($active=='f') {
            $active='false';
        }
        $sql="UPDATE role SET name='{$name}',tm_update='now()',active={$active} WHERE id={$id}";
        pg_query( $conexion, $sql);
        
        }        

    if(isset($_POST['delete'])){ 
        $id=$_POST['id'];
        $sql="DELETE FROM role WHERE id={$id}";
        pg_query( $conexion, $sql);
    }

?>
