<div class="logincontainer">
	<section id="logincontent">
<?php if(isset($error)) echo '<div class="red">'.$error.'</div>'; ?>
<?php echo $this->Form->create('User', array('class' => 'loginform')); ?>
	<h1>Projects Review</h1>
<?php echo $this->Form->input('username', array('label' => false, 'placeholder' => 'Username', 'id' => 'username', 'type' => 'text')); ?>
<?php echo $this->Form->input('password', array('label' => false, 'placeholder' => 'Password', 'id' => 'password', 'type' => 'password')); ?>
<?php echo $this->Form->input('Login', array('label' => false, 'type' => 'submit')); ?>
<?php echo $this->Form->end(); ?>		
	</section>
</div>