
	<h2><?php echo __('Lista de Unidades'); ?></h2>

	
	


<?php  ?>
	<table>
	<tr> 
	
	<th>    Nombre     </th>
	<th>   Patente     </th>

	<th>   Empresa  </th>
	<th>   Linea </th>
	<th>   Acciones </th>
	
		  
	</tr>
	

<?php foreach ($unidades as $unidade): ?> 
 
	<tr>
		<td> <?php echo $unidade ['Unidade']['nombre'];  ?> </td>

		<td>
			<?php echo $unidade ['Unidade']['patente'];  ?>

		</td>

		<td>

			<?php echo $unidade ['Empresa']['razonsocial']; ?>
		</td>

		<td>

			<?php echo $unidade ['Linea']['nombre']; ?>
		</td>

		<td> 
		<?php echo  $this->Html->link('Borrar', 
		array('action'=>'delete', $unidade['Unidade']['id']), 
		null, 'Vas a borrar definitivamente esta unidad'); ?>
		
	   <?php echo  $this->Html->link('Editar', 
		array('action'=>'edit',$unidade['Unidade']['id']), 
		null); ?>
	
		</td>
		
	

		

	</tr>

<?php endforeach; ?>

</table>


 	   

	
	
<br><br>

	<?php echo $this->html->link('Agregar unidades', array('controller'=>'unidades', 'action' =>'add'))
//El primer parametro del array indica la ruta ?>