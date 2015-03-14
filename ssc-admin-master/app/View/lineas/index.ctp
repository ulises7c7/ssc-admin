<html>
<script language="JavaScript" type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="webroot/js/json2.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<h1> Lineas </h1>

<?php 

echo $this->html->link('Agregar lineas', array('controller'=>'lineas', 'action' =>'add'))
 ?>

<table>
	<tr> 
	
	<th>    Numero Linea     </th>
	<th>   Nombre</th>
	
	<th>   Acciones</th>
		  
	</tr>
	
<!-- Aquí es donde hacemos loop a lo largo de nuestro array $lineas, imprimiendo la información de los lineas -->

<?php foreach ($lineas as $linea): ?> 
 
	<tr>
		<td> <?php echo $linea['Linea']['nrolinea'];  ?> </td>

		<td> <?php echo $linea['Linea']['nombre'] ?> </td>
		
		


		<td> 
		<?php echo  $this->Html->link('Borrar', array('action'=>'delete', $linea['Linea']['id']), 
		null, 'Vas a borrar definitivamente esta linea'); echo "  "; ?>

		<?php echo  $this->Html->link('Modificar', array('action'=>'edit', $linea['Linea']['id']), 
		null, null); ?> 

		<?php echo "  ";
		$id = $linea['Linea']['id'];
		$myvar = $this->requestAction('/paradas/decimesilatiene/'.$id); 
		//pr($myvar);
		if ($myvar==0) {
			echo  $this->Html->link('Cargar Paradas', array('controller'=>'paradas','action'=>'add', $linea['Linea']['id']), 
			null, null);
		}else{
			echo  $this->Html->link('Editar Paradas', array('controller'=>'paradas','action'=>'edit', $linea['Linea']['id']), 
			null, null);
		}
		
		?> 


		<?php 
		
		printf('<a href="javascript:void(0)" onclick="verRecorrido(' . $linea['Linea']['id'] .')"> Ver Recorrido</a>') ; 

		?>
   
	
		</td>

		

	</tr>

<?php endforeach; ?>

 

</table>
<!-- se mira y no se toca -->
<script type="text/javascript">
	var map;

	function verRecorrido(id){
		$('#mappy').show();
		
		map = new google.maps.Map( document.getElementById('mappy'), {'zoom':12, 'mapTypeId': google.maps.MapTypeId.ROADMAP, 'center': new google.maps.LatLng(-27.450323, -58.987600)})

		ren = new google.maps.DirectionsRenderer( {'draggable':true} );
		ren.setMap(map);
		ser = new google.maps.DirectionsService();
		//idLinea = JSON.stringify(idLinea);
		//console.log(id); 
		$.ajax({
	            url: 'lineas/cargarRecorrido', 
	            type: "POST",
	            dataType: "json",
	            data: ({idLinea:id}),

	            success: function(datos){
	                		var parad = datos[1]
	                		var recorr = datos[0];
	                		try { 
	                			setroute( eval('(' + recorr + ')') );
	                			
	                			if (parad != 0) {
	                				var posiciones = eval('(' + parad + ')');
                					for (var i = 0; i < posiciones.length; i++) {
                						var ll = JSON.parse(posiciones[i]); 
             							var position = new google.maps.LatLng(ll['k'],ll['D']);
             							//console.log(ll);
             							var marker = new google.maps.Marker({
							    			 position: position,
							     	 	     map: map
				     		 			});
				     		 		
                					}; 

	                			} 
	                			
	                		}catch(e){ 
	                			alert(e); 
	                		}
	                    },
	            error : function(xhr,errmsg,err) {
	                   
	                    console.log(errmsg);
	                    alert(xhr.status + ": " + xhr.responseText); //debug = True
	                    //alert('Lo sentimos, ha sucedido un error para obtener los datos.');//debug = False
	                    }
	    }); 




	    
	}

	function setroute(os){
		var wp = [];
		for(var i=0;i<os.waypoints.length;i++)
			wp[i] = {'location': new google.maps.LatLng(os.waypoints[i][0], os.waypoints[i][1]),'stopover':false }
			
		ser.route({'origin':new google.maps.LatLng(os.start.lat,os.start.lng),
		'destination':new google.maps.LatLng(os.end.lat,os.end.lng),
		'waypoints': wp,
		'travelMode': google.maps.DirectionsTravelMode.DRIVING},function(res,sts) {
			if(sts=='OK')ren.setDirections(res);
		})
			
	}	

</script>

<body>
<div id="mappy" style="display:none; width:900px; height:550px;"></div>
</body>