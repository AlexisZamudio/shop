<?php

class CodeCategoryBD{

    function save($name){
        //instanciación de la clase conexión a postgresql.
        $conexion = new ConexionPGSQL();
        $conexion->conectar();
        if(!$conexion->conectar()) return false;
        $query = "SELECT * FROM  category_departament  WHERE name='{$name}'";
        $resultado = pg_query($conexion->url, $query) or die("Error en la Consulta SQL");
        return (pg_num_rows($resultado)>0);
    }
}

    //Method save category room
    //required only name
    if(isset($_POST["save"]))
    {
        $name= $_POST['name'];  
        $ccbd=new CodeCategoryBD();
        $status=$ccbd->save($name);
        if($status)  echo "existe";
        else {            
            $sql = "INSERT INTO category_departament(name,tm_add,tm_update) VALUES ('{$name}','now()','now()')";
            pg_query( $conexion, $sql);
        }
    }

    if(isset($_POST['update'])){
        $name= $_POST['name'];  
        $id=$_POST['id'];
        $ccbd=new CodeCategoryBD();
        $status=$ccbd->save($name);
        if($status)  echo "existe";
        else {
            $sql="UPDATE category_departament SET name='{$name}',tm_update='now()' WHERE id={$id}";
        pg_query( $conexion, $sql);
        }        
    }
    
    if(isset($_POST['delete'])){ 
        $id=$_POST['id'];
        $sql="DELETE FROM category_departament WHERE id={$id}";
        pg_query( $conexion, $sql);
    }
?>