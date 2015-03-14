	<?php echo $this->form->create('Empresa'); ?> 
	
		
		<fieldset>

		<legend> Agregar Empresa </legend>
			

			<?php echo $this->form->input('razonsocial'); ?>

			<?php echo $this->form->input('cuit'); ?>

	    </fieldset>
		
		
		
	<?php echo $this->form->end('Agregar'); ?>
	
	<?php echo $this->html->link('Listar Empresas', array('action'=>'index'));?>