var edit = false;
$(document).ready(function(){
    recuperar_tareas();
})

$(document).on('click','#adm',function(){
    recuperar_tareas();
});

function recuperar_tareas(){
    edit=false;
    $.ajax({
        url:'../ajax-php/administrador.php',
        type:'GET',
        success:function(data){
            var lista_actividad=JSON.parse(data);
            var cabecera=`
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bi bi-person-plus"></i> 
                    Agregar</button>
                    </th>
                    </tr>
                </thead>
                <tbody>`;
            var fin=`
                </tbody>
            </table>
            </div>
        </div>
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
                <input type="submit" class="btn btn-primary" value="Crear Usuario" class="btn_save" name="form1">
                </div>
            </form>
        </div>
	</section>
        </div>
        </div>
        </div>
        `;
            var registros='';
            lista_actividad.forEach(fila=>{
                registros +=`
                <tr ID="${fila.dni_admin}">
                    <td>${fila.dni_admin}</td>
                    <td>${fila.nombre}</td>
                    <td>${fila.apellido}</td>
                    <td>${fila.correo}</td>
                    <td>
                        <button type="button" class="btn btn-primary btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropx<?php echo $row[0];?>" ><i class="bi bi-pencil-square"></i></button> 
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrops<?php echo $row[0];?>"><i class="bi bi-person-x"></i></button>
                    </td>
                </tr>
                `;              
            });
            $('#cabecera').html(cabecera+registros+fin);
            }  
    });
}
