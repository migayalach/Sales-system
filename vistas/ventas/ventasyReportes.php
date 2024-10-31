<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Ventas.php";

	$c= new conectar();
	$conexion=$c->conexion();

	$obj= new ventas();

	$sql="SELECT id_venta,
				fechaCompra,
				id_cliente 
			from venta group by id_venta desc ";
	$result=mysqli_query($conexion,$sql); 
	$c=1;
	?>

<h4>Reportes y ventas</h4>
<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered" style="text-align: center;" id="tablaDinamicaLoad">
				<caption><label>Ventas :)</label></caption>
				<thead>
					<tr>
						<td>Numero</td>
						<td>Fecha</td>
						<td>Cliente</td>
						<td>Total de compra</td>
						<td>Reporte</td>
					</tr>
				</thead>
				<tbody>
		<?php while($ver=mysqli_fetch_row($result)): ?>
				<tr>
					<!--<td><?php //echo $ver[0] ?></td>-->
					<td><?php echo $c ?></td>
					<td><?php echo $ver[1] ?></td>
					<td>
						<?php
							if($obj->nombreCliente($ver[2])==" "){
								echo "S/C";
							}else{
								echo $obj->nombreCliente($ver[2]);
							}
						 ?>
					</td>
					<td>
						<?php 
							echo "Bs.-".$obj->obtenerTotal($ver[0]);
						 ?>
					</td>
					<td>
						<a href="../procesos/ventas/crearReportePdf.php?idventa=<?php echo $ver[0]; ?>" class="btn btn-danger btn-sm">
							Reporte <span class="glyphicon glyphicon-file"></span>
						</a>	
					</td>
					<?php $c++ ?>
				</tr>
		<?php endwhile; ?>
			</tbody>
			</table>
		</div>
	</div>
	<div class="col-sm-1"></div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#tablaDinamicaLoad').DataTable({
			language:{
				"processing": "Procesando...",
				"lengthMenu": "Mostrar _MENU_ registros",
				"zeroRecords": "No se encontraron resultados",
				"emptyTable": "Ningún dato disponible en esta tabla",
				"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
				"infoFiltered": "(filtrado de un total de _MAX_ registros)",
				"search": "Buscar:",
				"infoThousands": ",",
				"loadingRecords": "Cargando...",
				"paginate": {
					"first": "Primero",
					"last": "Último",
					"next": "Siguiente",
					"previous": "Anterior"
				},
				"aria": {
					"sortAscending": ": Activar para ordenar la columna de manera ascendente",
					"sortDescending": ": Activar para ordenar la columna de manera descendente"
				},
				"buttons": {
					"copy": "Copiar",
					"colvis": "Visibilidad",
					"collection": "Colección",
					"colvisRestore": "Restaurar visibilidad",
					"copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
					"copySuccess": {
						"1": "Copiada 1 fila al portapapeles",
						"_": "Copiadas %ds fila al portapapeles"
					},
					"copyTitle": "Copiar al portapapeles",
					"csv": "CSV",
					"excel": "Excel",
					"pageLength": {
						"-1": "Mostrar todas las filas",
						"_": "Mostrar %d filas"
					},
					"pdf": "PDF",
					"print": "Imprimir",
					"renameState": "Cambiar nombre",
					"updateState": "Actualizar",
					"createState": "Crear Estado",
					"removeAllStates": "Remover Estados",
					"removeState": "Remover",
					"savedStates": "Estados Guardados",
					"stateRestore": "Estado %d"
				},
				"autoFill": {
					"cancel": "Cancelar",
					"fill": "Rellene todas las celdas con <i>%d<\/i>",
					"fillHorizontal": "Rellenar celdas horizontalmente",
					"fillVertical": "Rellenar celdas verticalmentemente"
				},
				"decimal": ",",
				"searchBuilder": {
					"add": "Añadir condición",
					"button": {
						"0": "Constructor de búsqueda",
						"_": "Constructor de búsqueda (%d)"
					},
					"clearAll": "Borrar todo",
					"condition": "Condición",
					"conditions": {
						"date": {
							"after": "Despues",
							"before": "Antes",
							"between": "Entre",
							"empty": "Vacío",
							"equals": "Igual a",
							"notBetween": "No entre",
							"notEmpty": "No Vacio",
							"not": "Diferente de"
						},
						"number": {
							"between": "Entre",
							"empty": "Vacio",
							"equals": "Igual a",
							"gt": "Mayor a",
							"gte": "Mayor o igual a",
							"lt": "Menor que",
							"lte": "Menor o igual que",
							"notBetween": "No entre",
							"notEmpty": "No vacío",
							"not": "Diferente de"
						},
						"string": {
							"contains": "Contiene",
							"empty": "Vacío",
							"endsWith": "Termina en",
							"equals": "Igual a",
							"notEmpty": "No Vacio",
							"startsWith": "Empieza con",
							"not": "Diferente de",
							"notContains": "No Contiene",
							"notStarts": "No empieza con",
							"notEnds": "No termina con"
						},
						"array": {
							"not": "Diferente de",
							"equals": "Igual",
							"empty": "Vacío",
							"contains": "Contiene",
							"notEmpty": "No Vacío",
							"without": "Sin"
						}
					},
					"data": "Data",
					"deleteTitle": "Eliminar regla de filtrado",
					"leftTitle": "Criterios anulados",
					"logicAnd": "Y",
					"logicOr": "O",
					"rightTitle": "Criterios de sangría",
					"title": {
						"0": "Constructor de búsqueda",
						"_": "Constructor de búsqueda (%d)"
					},
					"value": "Valor"
				},
				"searchPanes": {
					"clearMessage": "Borrar todo",
					"collapse": {
						"0": "Paneles de búsqueda",
						"_": "Paneles de búsqueda (%d)"
					},
					"count": "{total}",
					"countFiltered": "{shown} ({total})",
					"emptyPanes": "Sin paneles de búsqueda",
					"loadMessage": "Cargando paneles de búsqueda",
					"title": "Filtros Activos - %d",
					"showMessage": "Mostrar Todo",
					"collapseMessage": "Colapsar Todo"
				},
				"select": {
					"cells": {
						"1": "1 celda seleccionada",
						"_": "%d celdas seleccionadas"
					},
					"columns": {
						"1": "1 columna seleccionada",
						"_": "%d columnas seleccionadas"
					},
					"rows": {
						"1": "1 fila seleccionada",
						"_": "%d filas seleccionadas"
					}
				},
				"thousands": ".",
				"datetime": {
					"previous": "Anterior",
					"next": "Proximo",
					"hours": "Horas",
					"minutes": "Minutos",
					"seconds": "Segundos",
					"unknown": "-",
					"amPm": [
						"AM",
						"PM"
					],
					"months": {
						"0": "Enero",
						"1": "Febrero",
						"10": "Noviembre",
						"11": "Diciembre",
						"2": "Marzo",
						"3": "Abril",
						"4": "Mayo",
						"5": "Junio",
						"6": "Julio",
						"7": "Agosto",
						"8": "Septiembre",
						"9": "Octubre"
					},
					"weekdays": [
						"Dom",
						"Lun",
						"Mar",
						"Mie",
						"Jue",
						"Vie",
						"Sab"
					]
				},
				"editor": {
					"close": "Cerrar",
					"create": {
						"button": "Nuevo",
						"title": "Crear Nuevo Registro",
						"submit": "Crear"
					},
					"edit": {
						"button": "Editar",
						"title": "Editar Registro",
						"submit": "Actualizar"
					},
					"remove": {
						"button": "Eliminar",
						"title": "Eliminar Registro",
						"submit": "Eliminar",
						"confirm": {
							"_": "¿Está seguro que desea eliminar %d filas?",
							"1": "¿Está seguro que desea eliminar 1 fila?"
						}
					},
					"error": {
						"system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
					},
					"multi": {
						"title": "Múltiples Valores",
						"info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
						"restore": "Deshacer Cambios",
						"noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
					}
				},
				"info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
				"stateRestore": {
					"creationModal": {
						"button": "Crear",
						"name": "Nombre:",
						"order": "Clasificación",
						"paging": "Paginación",
						"search": "Busqueda",
						"select": "Seleccionar",
						"columns": {
							"search": "Búsqueda de Columna",
							"visible": "Visibilidad de Columna"
						},
						"title": "Crear Nuevo Estado",
						"toggleLabel": "Incluir:"
					},
					"emptyError": "El nombre no puede estar vacio",
					"removeConfirm": "¿Seguro que quiere eliminar este %s?",
					"removeError": "Error al eliminar el registro",
					"removeJoiner": "y",
					"removeSubmit": "Eliminar",
					"renameButton": "Cambiar Nombre",
					"renameLabel": "Nuevo nombre para %s",
					"duplicateError": "Ya existe un Estado con este nombre.",
					"emptyStates": "No hay Estados guardados",
					"removeTitle": "Remover Estado",
					"renameTitle": "Cambiar Nombre Estado"
				}
			} 
		});
	});
</script>