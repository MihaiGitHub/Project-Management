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

echo $this->Html->link($title, '#', array('escape' => false));
?></li>
 <li class="ic-form-style">
<?php
$title = $this->Html->tag('span', 'Users');

echo $this->Html->link( $title, '/admin/Users/index', array('escape' => false));
?>
</li>
<li class="ic-form-style">
<?php
$title = $this->Html->tag('span', 'Add New Project');

echo $this->Html->link( $title, '/admin/projects/add/', array('escape' => false));
?>
				</li>
            </ul>
        </div>
        <div class="clear"></div>
      
        <div class="maintable">
            <div class="box round first grid">
                <h2>Modify/Update Project</h2>
                <div class="block">   				
                <table class="data display datatable" id="example">
					<tbody>
					<?php foreach($projects as $project){ ?>
						<tr class="odd gradeX">
							
							<td>#<?php echo $project['PwcipP']['CIPNumber']; ?></td>
<td>
	<?php echo $this->Html->link($project['PwcipP']['CIPName'], '/admin/projects/view/'.$project['PwcipP']['CIPID']); ?>
</td>
						</tr>	
					<?php } ?>
					</tbody>
				</table>
				<?php 
				echo $this->Paginator->prev('<< Previous ', null, null, array('class' => 'disabled', 'escape' => FALSE));
				echo $this->Paginator->numbers(); 
				echo $this->Paginator->next(' Next >> ', null, null, array('class' => 'disabled', 'escape' => FALSE));
				echo $this->Paginator->counter(); 
				?>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div id="site_info">
        <p>City Of Tucson Projects | Admin Panel</p>
    </div>