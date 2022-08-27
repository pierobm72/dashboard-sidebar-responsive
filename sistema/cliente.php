<?php
include "../conexion.php";

if(!empty($_POST))
{
    if(empty($_POST['ruc_cliente ']) || empty($_POST['nombre_clie']) || empty($_POST['apellido']) || empty($_POST['correo']) || empty($_POST['telefono']) 
      || empty($_POST['inversion']) || empty($_POST['nombre_proyecto']) || empty($_POST['rubro ']))
    {
        $alert='<p class="msg_error">Todos los Campos son Obligatorios</p>';
    }else{

        $ruc_cliente  = $_POST['ruc_cliente '];
        $nombre_clie = $_POST['nombre_clie'];
        $apellido = $_POST['apellido'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $inversion = $_POST['inversion'];
        $nombre_proyecto = $_POST['nombre_proyecto'];
        $rubro  = $_POST['rubro '];
        
        $query = mysqli_query($conection,"SELECT * FROM cliente WHERE ruc_cliente = '$ruc_cliente' OR correo = '$correo' ");
        $result = mysqli_fetch_array($query);

        if($result > 0){
            $alert = '<p class="msg_error">El correo o el Usuario ya existen</p>';
        }else{
            $query_insert = mysqli_query($conection,"INSERT INTO cliente(ruc_cliente,nombre_clie,apellido,correo,telefono,inversion,nombre_proyecto,rubro)
                                                     VALUES('$ruc_cliente','$nombre_clie','$apellido','$correo','$telefono','$inversion','$nombre_proyecto','$rubro')");

            if($query_insert){
                $alert = '<p class="msg_save">Usuario Creado correctamente</p>';
            }else{
                $alert = '<p class="msg_error">Error al crear el Usuario</p>';
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
    <link rel="stylesheet" href="../plantilla/styles.css">
    <link rel="stylesheet" href="../plantilla/line-awesome/css/line-awesome.min.css">
    <!--link de bootracp-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cliente</title>
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
                    <th scope="col">Ruc Empresa</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">correo</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Inversion</th>
                    <th scope="col">Nombre proyecto</th>
                    <th scope="col">Tipo empresa</th>
                    <th scope="col">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bi bi-person-plus"></i> 
                    Agregar</button>
                    </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $query = mysqli_query($conection,"SELECT c.ruc_cliente,c.nombre_clie,c.apellido,c.correo,c.telefono,c.inversion,c.nombre_proyecto, r.tipo_empresa
                                                  FROM cliente c INNER JOIN rubro r ON c.id_rubro = r.id_rubro;");
                $result = mysqli_num_rows($query);
                if($result > 0){
				while($data = mysqli_fetch_array($query)){
                ?>
                    <tr class="mostrar"> 
                        <td><?php echo $data["ruc_cliente"]; ?></td>
                        <td><?php echo $data["nombre_clie"]; ?></td>  
                        <td><?php echo $data["apellido"]; ?></td>
                        <td><?php echo $data["correo"]; ?></td>  
                        <td><?php echo $data["telefono"]; ?></td>  
                        <td><?php echo $data["inversion"]; ?></td>  
                        <td><?php echo $data["nombre_proyecto"]; ?></td>  
                        <td><?php echo $data["tipo_empresa"]; ?></td>  
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
                        <h5 class="modal-title" id="staticBackdropLabel">Agregar Cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <section id="container">
		<div class="modal-body">
                <form class="row g-3"  action="" method="post">
                <div class="col-md-6">
                <label for="ruc_cliente">Ruc Cliente:</label>
                <input type="text" class="form-control" name="ruc_cliente" id="ruc_cliente" placeholder="Ingrese Ruc">
                </div>
                <div class="col-md-6">
                <label for="nombre_proyecto">Nombre de Proyecto:</label>
                <input type="text" class="form-control" name="nombre_proyecto" id="nombre_proyecto" placeholder="Ingrese Nombre de Proyecto">
                </div>
                <div class="col-md-6">
                <label for="nombre_clie">Nombre:</label>
                <input type="text" class="form-control" name="nombre_clie" id="nombre_clie" placeholder="Ingrese Nombres">
                </div>
                <div class="col-md-6">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Ingrese Apellidos">
                </div>
                <div class="col-md-6">
                <label for="correo">Correo Electronico:</label>
                <input type="email" class="form-control" name="correo" id="correo" placeholder="Ingrese Correo Electronico">
                </div>
                <div class="col-md-6">
                <label for="telefono">Telefono:</label>
                <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Ingrese telefono">
                </div>
                <div class="col-md-6">
                <label for="correo">Tipo de Empresa:</label>
                <?php 
                $query_rubro = mysqli_query($conection,"SELECT * FROM rubro");
                $result_rubro = mysqli_num_rows($query_rubro);

                ?>
                <select class="form-select" name="rubro" id="rubro">
                <?php
                if($result_rubro > 0)
                {
                    while ($rubro = mysqli_fetch_array($query_rubro)) {
                ?>
                        <option value="<?php echo $rubro["id_rubro"];?>"><?php echo $rubro["tipo_empresa"] ?></option>
                <?php
                    }
                }
                ?>
                </select>
                </div>
                <div class="col-md-6">
                <label for="inversion">Inversion:</label>
                <input type="number" class="form-control" name="inversion" id="inversion" placeholder="Ingrese importe">
                </div>
                <div class="col-md-12">
                <input type="submit" class="btn btn-primary" value="Crear Cliente" class="btn_save">
                </div>
            </form>
        </div>
	</section>
        </div>
        </div>
        </div>
    <!-- fin Modal -->

</main>
    
</body>
</html>