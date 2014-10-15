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

echo $this->Html->link($title, '/admin/projects/index/', array('escape' => false));
?></li>
                <li class="ic-form-style">
<?php
$title = $this->Html->tag('span', 'Add New Project');

echo $this->Html->link( $title, '/admin/projects/add/', array('escape' => false));
?>
				</li>	
				<li class="ic-gallery dd">
<?php
$title = $this->Html->tag('span', 'Add New Picture');

echo $this->Html->link( $title, '/admin/pictures/add/'.$cipid, array('escape' => false));
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
<li><?php echo $this->Html->link('Edit Project', '/admin/projects/edit/'.$cipid, array('escape' => false)); ?></li>
<li><?php 
$numupdates = $this->Html->tag('span', $updatescount);

echo $this->Html->link('Project Updates '.$numupdates, '/admin/updates/index/'.$cipid, array('escape' => false)); ?></li>
<li><?php 
$numpix = $this->Html->tag('span', $picturescount);

echo $this->Html->link('Pictures '.$numpix, '/admin/pictures/index/'.$cipid, array('escape' => false)); ?></li>
<li><?php 
$numattach = $this->Html->tag('span', $attachmentscount);

echo $this->Html->link('Attachments '.$numattach, '/admin/attachments/index/'.$cipid, array('escape' => false)); ?></li>
<li><?php 
$budget = $this->Html->tag('span', $attachedbudget);

echo $this->Html->link('Attach Budget '.$budget, '/admin/budget/'.$cipid, array('escape' => false)); ?></li>
<li><?php 
$pic = $this->Html->tag('span', $attachedpic);

echo $this->Html->link('Project Picture '.$pic, '/admin/projects/picture/'.$cipid, array('escape' => false)); ?></li>
<li><?php echo $this->Html->link('Public Page', '/projects/project/'.$cipid, array('target' => 'new', 'escape' => false)); ?></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="grid_10">
            <div class="box round first fullpage">
                <h2><?php echo $this->Form->label(__('Pictures')); ?></h2>
                <div class="blockk">
                    <table class="display">
						<tbody>
						<?php $rows = 0;
						foreach($pictures as $picture){ $rows++; ?>
						<tr>
							<td style="width:15%;">
<?php echo $this->Html->link(CakeTime::format('m/d/Y', $picture['PwcipPicturesP']['Date']),
array('controller' => 'PwcipPicturesPs', 'action' => 'edit', $picture['PwcipPicturesP']['PicturesID'])); ?>
							</td>
							<td>						
<?php 
echo $this->Html->link($this->Html->image('/pictures/'.$picture['PwcipPicturesP']['Picture'],
array('style' => 'height:75px;width:100px;')), '/pictures/'.$picture['PwcipPicturesP']['Picture'], array('target' => 'new', 'escape' => false)); 
?>
							</td>
							<td><?php echo $picture['PwcipPicturesP']['Comments']; ?></td>
						</tr>
						<?php } if($rows == 0) echo '<tr><td class="dataTables_empty">There are no pictures to display</td></tr>'; ?>
						</tbody>
					</table>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div id="site_info">
        <p>City Of Tucson Projects | Admin Panel</p>
    </div>