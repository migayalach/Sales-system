<?php 
	session_start();
	require_once "../../clases/Conexion.php";
	$obj= new conectar();
	$conexion= $obj->conexion();
	$sum=0;
	$con=1;
	//echo($_SESSION['desde']);
	//echo($_SESSION['hasta']);
	//echo($_SESSION['consulta']);
	//echo($_SESSION['consulta1']);
?>

<div class="table-responsive">
	 <table class="table table-hover table-condensed table-bordered" style="text-align: center;" id="tablaDinamicaLoad">
	 	<caption><label>Historial :)</label></caption>
		<thead>
			<tr>
				<td>Nro.</td>
				<td>Fecha de compra</td>
				<td>Nombre</td>
				<td>Apellido</td>
				<td>Carnet</td>
				<td>Producto</td>
				<td>Tamaño</td>
				<td>Precio</td>
				<td>Cantidad</td>
				<td>Total</td>
			</tr>
		</thead>
		<tbody>
		<?php 
		if((isset($_SESSION['consulta']))&&(isset($_SESSION['desde']))&&(isset($_SESSION['hasta'])))
		{
			if($_SESSION['consulta']>0 && $_SESSION['desde']>0 && $_SESSION['hasta']>0)
			{
				$idp=$_SESSION['consulta'];
				$f1=$_SESSION['desde'];
				$f2=$_SESSION['hasta'];
		
				$sql="SELECT v.id_venta, 
							 v.fechaCompra, 
							 c.nombre, 
							 c.apellido, 
							 c.carnet, 
							 p.nombre_producto, 
							 p.tamaño, 
							 v.precio, 
							 v.cantidad, 
							 v.total
					   FROM venta v, producto p, cliente c
					   WHERE p.id_producto = v.id_producto and c.id_cliente = v.id_cliente and c.id_cliente='$idp' and v.fechaCompra BETWEEN '$f1' and '$f2'
					   ORDER BY v.fechaCompra DESC";
			}
		}

			else if((isset($_SESSION['consulta1']))&&(isset($_SESSION['desde']))&&(isset($_SESSION['hasta'])))
			{
				if($_SESSION['consulta1']>0 && $_SESSION['desde']>0 && $_SESSION['hasta']>0)
				{
					$idpro=$_SESSION['consulta1'];
					$f1=$_SESSION['desde'];
					$f2=$_SESSION['hasta'];
			
					$sql="SELECT v.id_venta, 
								v.fechaCompra, 
								c.nombre, 
								c.apellido, 
								c.carnet, 
								p.nombre_producto, 
								p.tamaño, 
								v.precio, 
								v.cantidad, 
								v.total
						FROM venta v, producto p, cliente c
						WHERE p.id_producto = v.id_producto and c.id_cliente = v.id_cliente and p.id_producto='$idpro' and v.fechaCompra BETWEEN '$f1' and '$f2'
						ORDER BY v.fechaCompra DESC";
				}
			}

			else if((isset($_SESSION['desde']))&&(isset($_SESSION['hasta'])))
			{
				if($_SESSION['desde']>0 || $_SESSION['hasta']>0)
				{
					$f1=$_SESSION['desde'];
					$f2=$_SESSION['hasta'];
				
					$sql="SELECT v.id_venta, 
								v.fechaCompra, 
								c.nombre, 
								c.apellido, 
								c.carnet, 
								p.nombre_producto, 
								p.tamaño, 
								v.precio, 
								v.cantidad, 
								v.total
						FROM venta v, producto p, cliente c
						WHERE p.id_producto = v.id_producto and c.id_cliente = v.id_cliente and v.fechaCompra BETWEEN '$f1' and '$f2'
						ORDER BY v.fechaCompra DESC";
				}
			}
					
			else if((isset($_SESSION['consulta']))&&(isset($_SESSION['consulta1'])))
			{
				if($_SESSION['consulta']>0 && $_SESSION['consulta1']>0)
				{
					$c1=$_SESSION['consulta'];
					$c2=$_SESSION['consulta1'];
				
					$sql="SELECT v.id_venta, 
								v.fechaCompra, 
								c.nombre, 
								c.apellido, 
								c.carnet, 
								p.nombre_producto, 
								p.tamaño, 
								v.precio, 
								v.cantidad, 
								v.total
						FROM venta v, producto p, cliente c
						WHERE p.id_producto = v.id_producto and c.id_cliente = v.id_cliente and c.id_cliente='$c1' and p.id_producto='$c2'
						ORDER BY v.fechaCompra DESC";
				}
			}
			
			else if((isset($_SESSION['consulta'])))
			{
				if($_SESSION['consulta']>0)
				{
					$idp=$_SESSION['consulta'];
					$sql="SELECT v.id_venta, 
								v.fechaCompra, 
								c.nombre, 
								c.apellido, 
								c.carnet, 
								p.nombre_producto, 
								p.tamaño, 
								v.precio, 
								v.cantidad, 
								v.total
						FROM venta v, producto p, cliente c
						WHERE p.id_producto = v.id_producto and c.id_cliente = v.id_cliente and c.id_cliente='$idp'
						ORDER BY v.fechaCompra DESC";
				}
			}

			else if((isset($_SESSION['consulta1'])))
			{
				if($_SESSION['consulta1']>0)
				{
					$idpro=$_SESSION['consulta1'];
					$sql="SELECT v.id_venta, 
								v.fechaCompra, 
								c.nombre, 
								c.apellido, 
								c.carnet, 
								p.nombre_producto, 
								p.tamaño, 
								v.precio, 
								v.cantidad, 
								v.total
						FROM venta v, producto p, cliente c
						WHERE p.id_producto = v.id_producto and c.id_cliente = v.id_cliente and p.id_producto='$idpro'
						ORDER BY v.fechaCompra DESC";
				}
			}

		else
		{
			$sql="SELECT v.id_venta, 
						 v.fechaCompra, 
						 c.nombre, 
						 c.apellido, 
						 c.carnet, 
						 p.nombre_producto, 
						 p.tamaño, 
						 v.precio, 
						 v.cantidad, 
						 v.total
				 FROM venta v, producto p, cliente c
				 WHERE p.id_producto = v.id_producto and c.id_cliente = v.id_cliente 
				 ORDER BY v.id_venta DESC";
		}

		if((isset($_SESSION['desde']))&&(isset($_SESSION['hasta']))&&(isset($_SESSION['consulta']))&&(isset($_SESSION['consulta1'])))
			{
				if($_SESSION['consulta']>0 && $_SESSION['consulta1']>0 && $_SESSION['desde']>0 && $_SESSION['hasta']>0)
				{
					$idp=$_SESSION['consulta'];
					$idpro=$_SESSION['consulta1'];
					$f1=$_SESSION['desde'];
					$f2=$_SESSION['hasta'];
			
					$sql="SELECT v.id_venta, 
								v.fechaCompra, 
								c.nombre, 
								c.apellido, 
								c.carnet, 
								p.nombre_producto, 
								p.tamaño, 
								v.precio, 
								v.cantidad, 
								v.total
						FROM venta v, producto p, cliente c
						WHERE p.id_producto = v.id_producto and c.id_cliente = v.id_cliente and c.id_cliente='$idp' and p.id_producto='$idpro' and v.fechaCompra BETWEEN '$f1' and '$f2'
						ORDER BY v.fechaCompra DESC";
				}
				else
				{
					$sql="SELECT v.id_venta, 
								v.fechaCompra, 
								c.nombre, 
								c.apellido, 
								c.carnet, 
								p.nombre_producto, 
								p.tamaño, 
								v.precio, 
								v.cantidad, 
								v.total
						FROM venta v, producto p, cliente c
						WHERE p.id_producto = v.id_producto and c.id_cliente = v.id_cliente 
						ORDER BY v.id_venta DESC";
				}
			}

		
		$result=mysqli_query($conexion,$sql);
		while($ver=mysqli_fetch_row($result)): ?>
		<tr>
			<td><?php echo $con; ?></td>			
			<td><?php echo $ver[1]; ?></td>
			<td><?php echo $ver[2]; ?></td>
			<td><?php echo $ver[3]; ?></td>
			<td><?php echo $ver[4]; ?></td>
			<td><?php echo $ver[5]; ?></td>
			<td><?php echo $ver[6]; ?></td>
			<td><?php echo $ver[7]; ?></td>
			<td><?php echo $ver[8]; ?></td>
			<td><?php echo $ver[9]; ?></td>
		</tr>
		<?php
			$con++;
			$sum=$sum+$ver[9]; 
			endwhile; ?>
	  </tbody>		
	  </table>
		<h2>Total vendido Bs.- <?php echo $sum; ?></h2>
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