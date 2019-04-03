

<?php
    if(isset($_POST['insert'])){
        $name = $_POST['name'];
        $age = $_POST['age'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
    $id_role = $_POST['id_role'];
    $active = $_POST['active'];

        $insertar ="INSERT INTO user_shop (name,age,phone,address,id_role,active,tm_add,tm_update) 
                            VALUES ('{$name}','{$age}','{$phone}','{$address}',{$id_role},'{$active}',now(),now())";
                            echo $insertar;
        $ejecutar = pg_query($conexion,$insertar);
        if($ejecutar){
        echo "<script>window.open('user_shop.php','_self')</script>";
        }
        }

?> 

    <?php 
    if(isset($_POST['update'])){
        $actualizar_name = $_POST['name'];
        $actualizar_age = $_POST['age'];
        $actualizar_phone = $_POST['phone'];
        $actualizar_address = $_POST['address'];
        $actualizar_active = $_POST['active'];
        $id_actu=$_POST['id'];
        $actualizar = "UPDATE user_shop SET name='$actualizar_name',age='$actualizar_age',phone='$actualizar_phone',address='$actualizar_address',active='$actualizar_active', tm_update=now() WHERE id=$id_actu";
        $ejecutar = pg_query($conexion, $actualizar);
        if($ejecutar){
        echo "<script>window.open('../pages/user_shop.php','_self')</script>";
        }
    }
    
    ?> 

 <?php 
        if(isset($_POST['eliminar'])){
        $borrar_id = $_POST['id'];
        $borrar = "DELETE FROM user_shop WHERE id=$borrar_id";
        $ejecutar = pg_query($conexion, $borrar); 
            if($ejecutar){
            echo "<script>window.open('../pages/user_shop.php','_self')</script>";
            }
        }
    
    ?>