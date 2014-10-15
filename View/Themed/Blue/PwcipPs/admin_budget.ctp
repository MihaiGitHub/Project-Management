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
            </ul>
        </div>
        <div class="clear"></div>   	
		<div class="grid_2">
            <div class="box sidemenu">
                <div class="blockk" id="section-menu">
                    <ul class="section menuu">
                        <li><?php echo $this->Html->link('Home', '/admin/projects/view/'.$cipid, array('escape' => false)); ?>
                             <ul class="submenu">
<li><?php echo $this->Html->link('Edit Project', '/admin/projects/edit/'.$project['PwcipP']['CIPID'], array('escape' => false)); ?></li>
<li><?php 
$numupdates = $this->Html->tag('span', $updatescount);

echo $this->Html->link('Project Updates '.$numupdates, '/admin/updates/index/'.$project['PwcipP']['CIPID'], array('escape' => false)); ?></li>
<li><?php 
$numpix = $this->Html->tag('span', $picturescount);

echo $this->Html->link('Pictures '.$numpix, '/admin/pictures/index/'.$project['PwcipP']['CIPID'], array('escape' => false)); ?></li>
<li><?php 
$numattach = $this->Html->tag('span', $attachmentscount);

echo $this->Html->link('Attachments '.$numattach, '/admin/attachments/index/'.$project['PwcipP']['CIPID'], array('escape' => false)); ?></li>
<li><?php 
$budget = $this->Html->tag('span', $attachedbudget);

echo $this->Html->link('Attach Budget '.$budget, '/admin/projects/budget/'.$project['PwcipP']['CIPID'], array('escape' => false)); ?></li>
<li><?php 
$pic = $this->Html->tag('span', $attachedpic);

echo $this->Html->link('Project Picture '.$pic, '/admin/projects/picture/'.$project['PwcipP']['CIPID'], array('escape' => false)); ?></li>
<li><?php echo $this->Html->link('Public Page', '/projects/project/'.$project['PwcipP']['CIPID'], array('target' => 'new', 'escape' => false)); ?></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="grid_10">
		<?php if($error){ ?>
		<div class="message error">
			<h5>Error!</h5>
			<p>File type must be PDF</p>
		</div>
		<?php } ?>
            <div class="box round first fullpage">	
               <h2>Add New Budget</h2>
                <div class="block">
<?php echo $this->Form->create('PwcipP', array('enctype' => 'multipart/form-data', 'url' => 
											array('controller' => 'PwcipPs', 'action' => 'budget/'.$cipid))); ?>                    <table class="form">
                        <tr>
                            <td>
                                <?php echo $this->Form->label(__('Project Name')); ?>
                            </td>
                            <td>
								<?php echo $project['PwcipP']['CIPName']; ?>
                            </td>
                        </tr>
						<?php if($action == 'EDIT'){ ?>
						<tr>
							<td>
								<?php echo $this->Form->label(__('Current Budget')); ?>
							</td>
							<td>
<?php 
echo $this->Html->link($project['PwcipP']['AttachedBudget'], '/files/budget/'.$project['PwcipP']['AttachedBudget'], array('target' => 'new', 'escape' => false));
 ?>
							</td>
						</tr>
						<?php } ?>
						<tr>
                            <td>
                                <?php echo $this->Form->label('BudgetFile', __('Attach New Budget')); ?>
                            </td>
                            <td>
								<span class="inline">
									<?php echo $this->Form->input('BudgetFile', array('label' => false, 'type' => 'file')); ?>
								</span> PDF Only
                            </td>
                        </tr>	
						<?php if($action == 'EDIT'){ ?>
						<tr>
                            <td>
                                <?php echo $this->Form->label('Delete', __('Delete')); ?>
                            </td>
                            <td>
								<span class="inline">
								<?php echo $this->Form->input('Delete', array('label' => false, 'options' => 
												array('NO' => 'NO', 'YES' => 'YES'), 'type' => 'select')); ?> 		
								</span> select "YES" to delete this attachment
						   </td>
                        </tr>	
						<?php } ?>
					</table>
                   <button class="btn-icon btn-orange btn-check"><span></span>Save Budget</button>
			<?php 
echo $this->Form->input('CIPID', array('type' => 'hidden', 'label' => false, 'value' => $cipid)); 
echo $this->Form->input('action', array('type' => 'hidden', 'label' => false, 'value' => $action)); 
echo $this->Form->input('ProjectUpdated', array('type' => 'hidden', 'label' => false, 'value' => 1)); 
echo $this->Form->end(); ?>
                </div>
            </div>
        </div>		
        <div class="clear"></div>
    </div>
    <div id="site_info">
        <p>City Of Tucson Projects | Admin Panel</p>
    </div>