<?php echo $this->form->create('Linea'); ?> 
<fieldset>
<legend> Editar Linea </legend>

<?php 

	echo $this->Form->hidden('id', array('value' => $this->data[0]['Linea']['id']));
	echo $this->Form->input('nombre', array('value' => $this->data[0]['Linea']['nombre']));
	echo $this->Form->input('nrolinea', array('value' => $this->data[0]['Linea']['nrolinea']));
	echo $this->form->input('recorrido',array('value' =>$this->data[0]['Linea']['recorrido'],
			'readonly' => 'readonly')); 
?>
</fieldset>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="webroot/js/json2.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>
var map, ren, ser;
var data = {};
function modificarRecorrido()
{
	id = $('#id').val();
	lineaRecorrido = $('#LineaRecorrido').val();
	map = new google.maps.Map( document.getElementById('mappy'), {'zoom':12, 'mapTypeId': google.maps.MapTypeId.ROADMAP, 'center': new google.maps.LatLng(-27.450323, -58.987600)})

		ren = new google.maps.DirectionsRenderer( {'draggable':true} );
		ren.setMap(map);
		ser = new google.maps.DirectionsService();
		setroute( eval('(' + lineaRecorrido + ')') ); 
	                		
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
function save_waypoints()
{
	var w=[],wp;
	var rleg = ren.directions.routes[0].legs[0];
	data.start = {'lat': rleg.start_location.lat(), 'lng':rleg.start_location.lng()}
	data.end = {'lat': rleg.end_location.lat(), 'lng':rleg.end_location.lng()}
	var wp = rleg.via_waypoints	
	for(var i=0;i<wp.length;i++)w[i] = [wp[i].lat(),wp[i].lng()]	
	data.waypoints = w;
	var str = JSON.stringify(data);
	$('textarea[id=LineaRecorrido]').val(str);
	
}
</script>

<body onload="modificarRecorrido()">
		<div id="mappy" style="width:900px; height:550px; margin:0px auto 0px auto; border:1px solid #cecece; background:#F5F5F5"></div>
		
		<div style="width:900px; text-align:center; margin:0px auto 0px auto; margin-top:10px;">
			<input type="button" value="Establecer Recorrido" onClick="save_waypoints()">
	    </div>
</body>

<?php echo $this->Form->end('Terminar Edicion');?>

<?php echo $this->html->link('Listar Lineas', array('action'=>'index'));?> 

<?php echo $this->html->link('Agregar Lineas', array('action'=>'add'));?>

