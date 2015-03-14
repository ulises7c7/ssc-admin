	<?php echo $this->form->create('Unidade'); ?> 
	
		
		<fieldset>

		<legend> Agregar Unidad </legend>
			

			<?php echo $this->form->input('nombre'); ?>

			<?php echo $this->form->input('patente'); ?>

			<?php echo $this->form->input('empresa_id'); ?>

			<?php echo $this->form->input('linea_id'); ?>


	    </fieldset>
		
		
		
	<?php echo $this->form->end('Agregar'); ?>
	
	<?php echo $this->html->link('Listar Unidades', array('action'=>'index'));?>