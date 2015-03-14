<html>

<h1> Empresas </h1>

<?php echo $this->html->link('Agregar Empresas', array('controller'=>'Empresas', 'action' =>'add'))
 ?>

<table>
	<tr> 
	
	
	<th>   Razon Social</th>
	<th>   Cuit </th>
	<th>   Acciones</th>
		  
	</tr>
	
<!-- Aquí es donde hacemos loop a lo largo de nuestro array $empresas, imprimiendo la información de los empresas -->

<?php foreach ($empresas as $empresa): ?> 
 
	<tr>
		

		<td> <?php echo $empresa['Empresa']['razonsocial'] ?> </td>
		
		<td> <?php echo $empresa['Empresa']['cuit'] ?> </td>


		<td> 
		<?php echo  $this->Html->link('Borrar', 
		array('action'=>'delete', $empresa['Empresa']['id']), 
		null, 'Vas a borrar definitivamente esta empresa'); ?>
		
	   <?php echo  $this->Html->link('Editar', 
		array('action'=>'edit',$empresa['Empresa']['id']), 
		null); ?>
	
		</td>

		

	</tr>

<?php endforeach; ?>

 

</table>
<!-- se mira y no se toca -->
