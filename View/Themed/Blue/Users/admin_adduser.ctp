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

echo $this->Html->link( $title, 'index/', array('escape' => false));
?>				</li>
            </ul>
        </div>
        <div class="clear"></div>
      
        <div class="maintable">
            <div class="box round first grid">
                <h2>Add New User</h2>
                <div class="block">
					
					<?php echo $this->Form->create('User'); ?>
						
					<table class="form">
						<tr>
							<td class="col1"><?php echo $this->Form->label('username', __('Username')); ?></td>
							<td><?php echo $this->Form->input('username', array('label' => false)); ?></td>
						</tr>
						<tr>
							<td class="col2"><?php echo $this->Form->label('password', __('Password')); ?></td>
							<td><?php echo $this->Form->input('password', array('label' => false)); ?></td>
						</tr>
						<tr>
							<td><?php echo $this->Form->label('role', __('Role')); ?></td>
							<td><?php echo $this->Form->input('role', array('label' => false,
								'options' => array('admin' => 'Admin', 'standard' => 'Review')
							)); ?></td>
						</tr>
						<tr><td colspan="2"><button type="submit" class="btn-icon btn-orange btn-check"><span></span>Save User</button></td></tr>
					</table>
					<?php echo $this->Form->end(); ?>
					
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div id="site_info">
        <p>City Of Tucson Projects | Admin Panel</p>
    </div>