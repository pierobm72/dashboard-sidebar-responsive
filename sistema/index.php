<?php
include "../conexion.php";

if(!empty($_POST))
{
    if(empty($_POST['dni_admin']) || empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['correo']) || empty($_POST['contraseña']))
    {
        echo '<script>alert("complete los datos");</script>';
    }else{

        $dni_admin = $_POST['dni_admin'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $correo = $_POST['correo'];
        $contraseña = md5($_POST['contraseña']);
        
        $query = mysqli_query($conection,"SELECT * FROM administrador WHERE dni_admin = '$dni_admin' OR correo = '$correo' ");
        $result = mysqli_fetch_array($query);

        if($result > 0){
            $alert = '<p class="msg_error">El correo o el Usuario ya existen</p>';
        }else{
            $query_insert = mysqli_query($conection,"INSERT INTO administrador(dni_admin,nombre,apellido,correo,contraseña)
                                                     VALUES('$dni_admin','$nombre','$apellido','$correo','$contraseña')");

            if($query_insert){
                echo '<script><p>Usuario Creado correctamente</p>';
            }else{
                echo '<script><p>Error al crear el Usuario</p>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="stylesheet" href="../plantilla/styles.css">
    <link rel="stylesheet" href="../plantilla/line-awesome/css/line-awesome.min.css">
    <!--link de bootracp-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
</head>
<body>
    <?php
    require("../plantilla/index.html");
    ?>
    <main>
     <div class="main-content">
            <div class="cards">
                <table class="table">
                <thead>
                    <tr>
                    <th scope="col">DNI</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">correo</th>
                    <th scope="col">
                    <button type="button" class="btn btn-primary" 
                    data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bi bi-person-plus"></i> 
                    Agregar</button>
                    </th>
                    </tr>
                </thead>
                
                <tbody>
                <?php
                $query = mysqli_query($conection,"SELECT * FROM administrador;");
                $result = mysqli_num_rows($query);
                if($result > 0){
				while($data = mysqli_fetch_array($query)){
                ?>
                    <tr class="mostrar"> 
                    <td><?php echo $data["dni_admin"]; ?></td>   
                    <td><?php echo $data["nombre"]; ?></td>  
                    <td><?php echo $data["apellido"]; ?></td>
                    <td><?php echo $data["correo"]; ?></td>  
                        <td>
                            <button type="button" class="btn btn-primary btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropx<?php echo $row[0];?>" ><i class="bi bi-pencil-square"></i></button> 
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrops<?php echo $row[0];?>"><i class="bi bi-person-x"></i></button>
                        </td>
                    </tr> 
                    <?php 
				}
			}
			?>
                 </tbody>
                </table>                
            </div>
        </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Agregar Trabajador</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <section id="container">
		<div class="modal-body">
                <form class="row g-3"  action="" method="post">
                <div class="col-md-6">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese Nombres">
                </div>
                <div class="col-md-6">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Ingrese Apellidos">
                </div>
                <div class="col-md-6">
                <label for="dni_admin">DNI:</label>
                <input type="text" class="form-control" name="dni_admin" id="dni_admin" placeholder="Ingrese DNI">
                </div>
                <div class="col-md-6">
                <label for="correo">Correo Electronico:</label>
                <input type="email" class="form-control" name="correo" id="correo" placeholder="Ingrese Correo Electronico">
                </div>
                <div class="col-md-6">
                <label for="contraseña">Contraseña:</label>
                <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Ingrese Contraseña">
                </div>
                <div class="col-md-12">
                <input type="submit" class="btn btn-primary" value="Crear Usuario" class="btn_save">
                </div>
            </form>
        </div>
	</section>

                

        </div>
        </div>
        </div>
    </main>
        </body>
        </html>