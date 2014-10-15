<div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">Projects Admin</div>
                <div class="floatright">
                    <div class="floatleft">
						<?php echo $this->Html->image('img-profile.jpg', array('alt' => 'Profile')); ?>
					</div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Hello <?php echo $username; ?></li>
                            <li><?php echo $this->Html->link('Logout', '/admin/users/logout/', array('escape' => false)); ?></li>
                        </ul>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard">
				<?php
$title = $this->Html->tag('span', 'Projects Index');

echo $this->Html->link($title, '/admin/projects/index', array('escape' => false));
?></li>
<li class="ic-form-style">
<?php
$title = $this->Html->tag('span', 'Add New Project');

echo $this->Html->link( $title, '/admin/projects/add', array('escape' => false));
?>
				</li>
				<li class="ic-form-style">
<?php
$title = $this->Html->tag('span', 'Add New User');

echo $this->Html->link( $title, 'adduser/', array('escape' => false));
?>
				</li>
            </ul>
        </div>
        <div class="clear"></div>
      
        <div class="maintable">
		<?php if(isset($error)){ ?>
		<div class="message error">
			<h5>Error!</h5>
			<p><?php echo $error; ?></p>
		</div>
		<?php } ?>
            <div class="box round first grid">
                <h2>Change Password</h2>
                <div class="block">   				
               <?php echo $this->Form->create('User'); ?>
						
					<table class="form">
						<tr>
							<td class="col1"><?php echo $this->Form->label('oldpassword', __('Old Password')); ?></td>
							<td><?php echo $this->Form->input('oldpassword', array('type' => 'password', 'label' => false)); ?></td>
						</tr>
						<tr>
							<td class="col1"><?php echo $this->Form->label('newpassword', __('New Password')); ?></td>
							<td><?php echo $this->Form->input('newpassword', array('type' => 'password', 'label' => false)); ?></td>
						</tr>	
						<tr>
							<td class="col1"><?php echo $this->Form->label('password', __('Confirm Password')); ?></td>
							<td><?php echo $this->Form->input('password', array('label' => false)); ?></td>
						</tr>						
						<tr>
							<td><?php echo $this->Form->label('role', __('Role')); ?></td>
							<td><?php echo $this->Form->input('role', array('label' => false, 'value' => $user['User']['role'],
								'options' => array('admin' => 'Admin', 'standard' => 'Review')
							)); ?></td>
						</tr> 
						<tr>
							<td colspan="2">
			<button name="save" value="save" class="btn-icon btn-orange btn-check"><span></span>Save Password</button>
			<button name="delete" value="delete" class="btn-icon btn-grey btn-cross"><span></span>Delete User</button>
							</td>
						</tr>
					</table>
					<?php echo $this->Form->input('initialpass', array('type' => 'hidden', 'value' => $user['User']['password'])); ?>
					<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $user['User']['id'])); ?>
					<?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div id="site_info">
        <p>City Of Tucson Projects | Admin Panel</p>
    </div>