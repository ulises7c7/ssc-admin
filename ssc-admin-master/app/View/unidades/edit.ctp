<?php echo $this->form->create('Unidade'); ?> 
<fieldset>
<legend> Editar Unidad </legend>

<?php 

	echo $this->Form->hidden('id', array('value' => $this->data[0]['Unidade']['id']));
	echo $this->Form->input('nombre', array ('value' => $this->data[0]['Unidade']['nombre']));
	echo $this->Form->input('patente', array('value' => $this->data[0]['Unidade']['patente']));
	echo $this->Form->input('empresa_id', array('type' => 'select', 'value' => $this->data[0]['Unidade']['empresa_id']));
	echo $this->Form->input('linea_id', array('value' => $this->data[0]['Unidade']['linea_id']));


?>
</fieldset>

<?php echo $this->Form->end('Terminar Edicion');?>

<?php echo $this->html->link('Listar unidades', array('action'=>'index'));?> 

<?php echo $this->html->link('Agregar unidades', array('action'=>'add'));?>

