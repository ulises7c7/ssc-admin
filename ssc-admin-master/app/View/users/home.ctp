<?php
/* display message saved in session if any */
echo $this->Session->flash();
?>
<p>
    <?php 
        /* link to add user form */
        echo $this->Html->link('add user', array('controller' => 'users', 'action' => 'add')); 
    ?>
</p>

<p>
<!--    check if user is logged, show user name and logout link or login link -->
    <?php if ($this->Session->read('Auth.User')): ?>
        You are logged in as <?php echo $this->Session->read('Auth.User.username'); ?>. <?php echo $this->Html->link('logout', array('controller' => 'users', 'action' => 'logout')); ?>
    <?php else: ?>
        <?php echo $this->Html->link('login', array('controller' => 'users', 'action' => 'login')); ?>
    <?php endif; ?>
</p>