<?php
    if(isset($_POST)) {
        include("db.php");
        
        $id = $_POST['inputId'];
        $name = $_POST['name_upd'];
        $perfil = $_POST['perfil_profesional_upd'];
        $exp = $_POST['experiencia_laboral_upd'];
        $aptitudes = $_POST['aptitudes_upd'];
        $others = $_POST['otros_datos_upd'];

        $sql = "UPDATE profesors SET name = '$name', perfil = '$perfil', experience = '$exp', aptitudes = '$aptitudes', others = '$others' WHERE id = '$id'";
        if(mysqli_query($connection, $sql)) {
            header("Location: http://localhost/app/profesores.php");
        } else {
            echo "Error al actualizar los datos: " . mysqli_error($conn);
        }
    }
?>