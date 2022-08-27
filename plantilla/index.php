<?php
include "../conexion2.php";

if(!empty($_POST['form1']))
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
                echo '<script>alert("Usuario Creado correctamente");</script>';
            }else{
                echo '<script><p>Error al crear el Usuario</p>';
            }
        }
    }
}

if(!empty($_POST['form2']))
{
    if(empty($_POST['ruc_cliente']) || empty($_POST['nombre_clie']) || empty($_POST['apellido']) || empty($_POST['correo']) || empty($_POST['telefono']) 
      || empty($_POST['inversion']) || empty($_POST['nombre_proyecto']) || empty($_POST['rubro']))
    {
        echo '<script>alert("Todos los Campos son Obligatorios");</script>';
    }else{

        $ruc_cliente  = $_POST['ruc_cliente'];
        $nombre_clie = $_POST['nombre_clie'];
        $apellido = $_POST['apellido'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $inversion = $_POST['inversion'];
        $nombre_proyecto = $_POST['nombre_proyecto'];
        $rubro  = $_POST['rubro'];
        
        $query = mysqli_query($conection,"SELECT * FROM cliente WHERE ruc_cliente = '$ruc_cliente' OR correo = '$correo' ");
        $result = mysqli_fetch_array($query);

        if($result > 0){
            $alert = '<p class="msg_error">El correo o el Usuario ya existen</p>';
        }else{
            $query_insert = mysqli_query($conection,"INSERT INTO cliente(ruc_cliente,nombre_clie,apellido,correo,telefono,inversion,nombre_proyecto,id_rubro)
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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./line-awesome/css/line-awesome.min.css">
    <!-- <link rel="stylesheet" href="styles.css"> -->
    
    <title>Panel Admin</title>
    <!--link de iconos de bootrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>   
    
    <link rel="stylesheet" href="styles-responsive.css"> 
</head>
<body>
    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2> <span class="lab la-accusoft"></span><span>Sistema contable</span></h2>
        </div>

        <div class="sidebar-menu">
            <ul> 
                <li>
                    <a href="" id="adm"><span class="las la-user-lock"></span><span>Administrador</span></a>
                </li>

                <li>
                    <a href="" id="cli"><span class="las la-users"></span><span>Cliente</span></a>
                </li>

                <li>
                    <a href=""><span class="las la-money-bill-wave"></span><span>Ingresos</span></a>
                </li>

                <li>
                    <a href=""><span class="las la-file-invoice"></span><span>Egresos</span></a>
                </li>

                <li>
                    <a href=""><span class="las la-receipt"></span><span>Caja </span></a>
                </li>

                <li>
                    <a href=""><span class="las la-file-contract"></span><span>Reporte</span></a>
                </li>
                
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">
                    <span class="las la-bars" ></span>
                </label>

                Panel administrador
            </h2>

            <div class="search-wrapper">
                <span class="las la-search"></span>
                <input type="text" placeholder="Buscar aqui">
            </div>

            <div class="log-out">
                <a href="../sistema/salir.php">Cerrar sesion</a>
            </div>

        </header>
        
    </div>
    <main id="cabecera">
       
    </main>
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../ajax-php/administrador.js"></script>
    <script src="../ajax-php/cliente.js"></script>
</body>

</html>