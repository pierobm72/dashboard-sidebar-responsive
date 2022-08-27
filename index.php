<?php 
session_start();
if(!empty($_SESSION['active']))
{
	header('location: sistema/');
}else{

	if(!empty($_POST))
	{
		if(empty($_POST['dni_admin']) || empty($_POST['contraseña']))
		{
			$alert = 'Ingrese su dni y su contraseña';
		}else{

			require_once "conexion2.php";

			$user = mysqli_real_escape_string($conection,$_POST['dni_admin']);
			$pass = md5(mysqli_real_escape_string($conection,$_POST['contraseña']));

			$query = mysqli_query($conection,"SELECT * FROM administrador WHERE dni_admin= '$user' AND contraseña = '$pass'");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);

			if($result > 0)
			{
				$data = mysqli_fetch_array($query);
				$_SESSION['active'] = true;
				$_SESSION['dni_admin'] = $data['dni_admin'];
				$_SESSION['nombre'] = $data['nombre'];
				$_SESSION['apellido']  = $data['apellido'];
				$_SESSION['correo']   = $data['correo'];

				header('location: plantilla/');
			}else{
				$alert = 'El usuario o la clave son incorrectos';
				session_destroy();
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
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
    <!--  link de bootrack  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
    crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--  link de iconos de bootrack  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
  <div class="con_login">
    <div class="con"> 
      <img src="imagenes/img1.jpg" alt="" id="img1"  >
    </div>
    <div class="con">
      <form class="for_login" action="" method="post">
        <img src="imagenes/img2.webp" alt="" id="img2">
        <h1>Nombre</h1>
        <div class="row mb-3">
          <div class="col-10" id="login" >
            <input type="text" class="form-control" id="inputEmail3" placeholder="Ingresa tu DNI" name="dni_admin" >
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-sm-10" id="login">
            <input type="password" class="form-control" id="inputPassword3" placeholder="Ingresa tu contraseña" name ="contraseña">
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Ingresar</button>
      </form>
    </div>
   
</div>
</body>
</html>