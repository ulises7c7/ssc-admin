<?php
/* display message saved in session if any */
echo $this->Session->flash();
?>
<div class="users form">
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Agregar Usuario'); ?></legend>
        <?php
        echo $this->Form->input('username', array('label' => 'Usuario'));
        echo $this->Form->input('password', array('label' => 'Contraseña'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Guardar')); ?>
</div>