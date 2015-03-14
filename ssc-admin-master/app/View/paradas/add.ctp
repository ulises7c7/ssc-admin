	
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="application/json" src="webroot/js/json2.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>
var map, ren, ser;
var stops = [];
var data = {};

//goma();
vervalor();
function goma()
{
	map = new google.maps.Map( document.getElementById('mappy'), {'zoom':12, 'mapTypeId': google.maps.MapTypeId.ROADMAP, 'center': new google.maps.LatLng(-27.450323, -58.987600) })
// origen = (26.05678288577881, -80.30236816615798), destino (25.941991877144947, -80.16160583705641)
	ren = new google.maps.DirectionsRenderer( {'draggable':true} );
	ren.setMap(map);
	ser = new google.maps.DirectionsService();
	google.maps.event.addListener(map, 'click', function(e) {
		    placeMarker(e.latLng, map);	    
	});		
	
	
}

function placeMarker(position, map) {
		  var marker = new google.maps.Marker({
		    position: position,
		    map: map
		  });
		  
		  map.panTo(position);
		  stops.push(JSON.stringify(position));
		  		  
		  google.maps.event.addListener(marker, "dblclick", function() {
    		marker.setMap(null);
    		var index = stops.indexOf(JSON.stringify(marker.position));
    		if (index > -1) {
			    stops.splice(index, 1);
			}
		  });
		 //console.log(JSON.stringify(marker.position)==stops[0]);
		  //console.log(stops);
		 

}

function save_waypoints()
{
	var str = JSON.stringify(stops);
	$('textarea[id=ParadaParadas]').val(str);
	
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

var valor;
//var anterior = 14;//ParadaLineaId/

function vervalor() {
	goma();	
	//if ($("#ParadaLineaId").val() != anterior) {
		//console.log($("#ParadaLineaId").val());
	$.ajax({
	    url: '/ssc-admin-master/lineas/cargarRecorrido', 
	    type: "POST",
	    dataType: "json",
	    data: ({idLinea:$("#ParadaLineaId").val()}),

	    success: function(datos){
	        		var parad = datos[1]
	                var recorr = datos[0];
	                valor = recorr;
	        		try { 
	        			setroute( eval('(' + recorr + ')') ); 
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

function deleteMarkers() {
	goma();
	setroute(eval('(' + valor + ')'));
	stops = [];
	$('textarea[id=ParadaParadas]').val("Modifique el Mapa");

}

</script>


		<?php echo $this->form->create('Parada'); //pr($lineas);?> 
		<fieldset>

		<legend> Agregar Parada </legend>
				
			<?php echo $this->form->input('linea_id', array('readonly' => 'readonly')); //'onclick'=>'vervalor()' ?>
	

			<?php echo $this->form->input('paradas',array('value' =>'Modifique el mapa',
			'readonly' => 'readonly')); ?>
	
	    </fieldset>
	<!-- 	-->
		

	

	<body onLoad="vervalor()">
		<div id="mappy" style="width:900px; height:550px; margin:0px auto 0px auto; border:1px solid #cecece; background:#F5F5F5">			
		</div>

		<div style="width:900px; text-align:center; margin:0px auto 0px auto; margin-top:10px;">
			<input onclick="deleteMarkers();" type=button value="Deshacer Marcas">
			<input type="button" value="Establecer Paradas" onClick="save_waypoints()">
	    </div>

	</body>
	
<?php echo $this->form->end('Agregar'); ?>

