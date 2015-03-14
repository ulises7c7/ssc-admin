	
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="webroot/js/json2.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>
var map, ren, ser;
var data = {};
function goma()
{
	map = new google.maps.Map( document.getElementById('mappy'), {'zoom':12, 'mapTypeId': google.maps.MapTypeId.ROADMAP, 'center': new google.maps.LatLng(-27.450323, -58.987600) })
// origen = (26.05678288577881, -80.30236816615798), destino (25.941991877144947, -80.16160583705641)
	ren = new google.maps.DirectionsRenderer( {'draggable':true} );
	ren.setMap(map);
	ser = new google.maps.DirectionsService();
	
	ser.route({ 'origin': new google.maps.LatLng(-27.443558, -59.003607), 'destination':  new google.maps.LatLng(-27.450323, -58.987600), 'travelMode': google.maps.DirectionsTravelMode.DRIVING},function(res,sts) {
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


		<?php echo $this->form->create('Linea'); ?> 
		<fieldset>

		<legend> Agregar Linea </legend>
			
			<?php //echo $this->form->id('idLinea');  ?>


			<?php echo $this->form->input('nrolinea'); ?>

			<?php echo $this->form->input('nombre'); ?>

			<?php echo $this->form->input('recorrido',array('value' =>'Modifique el mapa',
			'readonly' => 'readonly')); ?>
	
	    </fieldset>
	<!-- 	-->
		

	
	<?php echo $this->html->link('Listar Lineas', array('action'=>'index'));?>

	<body onLoad="goma()">
		<div id="mappy" style="width:900px; height:550px; margin:0px auto 0px auto; border:1px solid #cecece; background:#F5F5F5"></div>
		
		<div style="width:900px; text-align:center; margin:0px auto 0px auto; margin-top:10px;">
			<input type="button" value="Establecer Recorrido" onClick="save_waypoints()">
	    </div>

<?php echo $this->form->end('Agregar'); ?>


</body>