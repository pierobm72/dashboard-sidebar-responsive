<?php
require '../conexion.php';
$sql ="select * from cliente as c inner join rubro as r on r.id_rubro=c.id_rubro";
$resultado = $connection->prepare($sql);
$resultado->execute();
$json=array();
while($r=$resultado->fetch(PDO::FETCH_ASSOC)){
    $json[]=array(
        'ruc_cliente'=>$r['ruc_cliente'],
        'nombre_clie'=>$r['nombre_clie'],
        'apellido'=>$r['apellido'],
        'correo'=>$r['correo'],
        'telefono'=>$r['telefono'],
        'inversion'=>$r['inversion'],
        'nombre_proyecto'=>$r['nombre_proyecto'],
        'tipo_empresa'=>$r['tipo_empresa']
    );
}
echo json_encode($json);
