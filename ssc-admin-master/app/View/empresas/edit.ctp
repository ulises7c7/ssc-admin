<?php echo $this->form->create('Empresa'); ?> 
<fieldset>
<legend> Editar Empresa </legend>

<?php 

	echo $this->Form->hidden('id', array('value' => $this->data[0]['Empresa']['id']));
	echo $this->Form->input('razonSocial', array ('value' => $this->data[0]['Empresa']['razonsocial']));
	echo $this->Form->input('cuit', array('value' => $this->data[0]['Empresa']['cuit']));
?>
</fieldset>

<?php echo $this->Form->end('Terminar Edicion');?>

<?php echo $this->html->link('Listar empresas', array('action'=>'index'));?> 

<?php echo $this->html->link('Agregar Empresas', array('action'=>'add'));?>

