var edit = false;
$(document).on('click','#cli',function(){
    
    recuperar_tarea();
});
function recuperar_tarea(){
    edit=false;
    $.ajax({
        url:'../ajax-php/cliente.php',
        type:'GET',
        success:function(data){
            var lista_actividad=JSON.parse(data);
            var cabecera=`<div class="main-content">
            <div class="cards">
            <table class="table">
            <thead>
                    <tr>
                    <th scope="col">RUC</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">correo</th>
                    <th scope="col">Télefono</th>
                    <th scope="col">Inversión</th>
                    <th scope="col">Nombre proyecto</th>
                    <th scope="col">Tipo de Empresa</th>
                    <th scope="col">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="agregacli"><i class="bi bi-person-plus"></i> 
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
                <select class="form-select" name="rubro" id="rubro">
                
                </select>
                </div>
                <div class="col-md-6">
                <label for="inversion">Inversion:</label>
                <input type="number" class="form-control" name="inversion" id="inversion" placeholder="Ingrese importe">
                </div>
                <div class="col-md-12">
                <input type="submit" class="btn btn-primary" value="Crear Cliente" class="btn_save" name="form2" id="nuevo">
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
                <tr ID="${fila.ruc_cliente}">
                    <td>${fila.ruc_cliente}</td>
                    <td>${fila.nombre_clie}</td>
                    <td>${fila.apellido}</td>
                    <td>${fila.correo}</td>
                    <td>${fila.telefono}</td>
                    <td>${fila.inversion}</td>
                    <td>${fila.nombre_proyecto}</td>
                    <td>${fila.tipo_empresa}</td>
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

$(document).on('click','#agregacli',function(){
    $.ajax({
        url:'../ajax-php/rubro.php',
        type:'GET',
        success:function(data){
            var lista_actividad=JSON.parse(data);
            var registros='';
            lista_actividad.forEach(fila=>{
                registros +=`
                <option value="${fila.id_rubro}">${fila.tipo_empresa}</option>
                `;              
            });
            $('#rubro').html(registros);
            }  
    });
})
