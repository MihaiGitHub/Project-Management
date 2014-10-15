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
			
               <h2>Edit Project Picture</h2>
                <div class="block">
<?php echo $this->Form->create('PwcipPicturesP', array('enctype' => 'multipart/form-data', 'url' => 
	array('controller' => 'PwcipPicturesPs', 'action' => 'edit/'))); ?>
                    <table class="form">
                        <tr>
                            <td>
                                <?php echo $this->Form->label(__('Project Name')); ?>
                            </td>
                            <td>
								<?php echo $name; ?>
                            </td>
                        </tr>
                   		<tr>
                            <td>
                                <?php echo $this->Form->label('Date', __('Date')); ?>
                            </td>
                            <td>
								<?php echo $this->Form->input('Date', array('id' => 'Date', 'label' => false, 'type' => 'text')); ?>
                            </td>
                        </tr>	
						<tr>
                            <td>
                                <?php echo $this->Form->label('Comments', __('Comments')); ?>
                            </td>
                            <td>
								<?php echo $this->Form->input('Comments', array('style' => 'width:100%', 'label' => false)); ?>
                            </td>
                        </tr>	
						<tr>
                            <td>
                                <?php echo $this->Form->label('Picture', __('Current Picture')); ?>
                            </td>
                            <td>
<?php echo $this->Html->link($this->Html->image('/pictures/'.$picture['PwcipPicturesP']['Picture'],
array('alt' => 'Picture', 'style' => 'height:75px;width:100px;')), '/pictures/'.$picture['PwcipPicturesP']['Picture'], 
array('target' => 'new', 'escape' => false)); ?>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <?php echo $this->Form->label(__('Upload Picture')); ?>
                            </td>
                            <td>
								<?php echo $this->Form->file('file.image'); ?>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <?php echo $this->Form->label('Delete', __('Delete')); ?>
                            </td>
                            <td>
								<span class="inline"><?php echo $this->Form->input('Delete', array('label' => false, 'options' => 
												array('NO' => 'NO', 'YES' => 'YES'), 'type' => 'select')); ?></span> select "YES" to delete this picture
                            </td>
                        </tr>						
					</table>
                   <button class="btn-icon btn-orange btn-check"><span></span>Save Picture</button>
<?php
echo $this->Form->input('CIPID', array('type' => 'hidden', 'label' => false, 'value' => $cipid)); 
echo $this->Form->input('PicturesID', array('type' => 'hidden', 'label' => false, 'value' => $picture['PwcipPicturesP']['PicturesID'])); 
echo $this->Form->input('AddDate', array('type' => 'hidden', 'label' => false, 'value' => CakeTime::format('d/m/Y', CakeTime::nice()))); 
echo $this->Form->input('AddIP', array('type' => 'hidden', 'label' => false, 'value' => $this->request->clientIp())); 
echo $this->Form->end(); 
?>
                </div>
<script type="text/javascript">
jQuery(function() {
	jQuery("#Date").datepicker({
	 	changeMonth: true,
		changeYear: true,
		dateFormat: "mm/dd/yy" 
	}).val();
});
</script>
            </div>
        </div>		
		
        <div class="clear"></div>
    </div>
    <div id="site_info">
        <p>City Of Tucson Projects | Admin Panel</p>
    </div>