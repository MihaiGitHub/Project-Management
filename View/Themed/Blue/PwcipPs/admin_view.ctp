<?php
function bitMask($mask = 0) {
    if(!is_numeric($mask)) {
        return array();
    }
    $return = array();
    while ($mask > 0) {
        for($i = 0, $n = 0; $i <= $mask; $i = 1 * pow(2, $n), $n++) {
            $end = $i;
        }
        $return[] = $end;
        $mask = $mask - $end;
    }
    sort($return);
    return $return;
}
?>
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
            </ul>
        </div>
        <div class="clear"></div>
		<div class="grid_2">
            <div class="box sidemenu">
                <div class="blockk" id="section-menu">
                    <ul class="section menuu">
                        <li><a class="menuitem">Home</a>
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
				<?php 
				if($project['PwcipP']['ProjectPicture']){
					echo $this->Html->link($this->Html->image('/pictures/'.$project['PwcipP']['ProjectPicture'],
					array('alt' => 'Picture')), '/pictures/'.$project['PwcipP']['ProjectPicture'], 
					array('target' => 'new', 'escape' => false));
				} ?>
            </div>
        </div>
        <div class="grid_10">
            <div class="box round first fullpage">
                <h2>Project &#35;<?php echo $project['PwcipP']['CIPNumber']; ?> - <?php echo $project['PwcipP']['CIPName']; ?></h2>
                <div class="blockk">
                    <table class="form">
                        <tr>
                            <td class="col1">
                               <?php echo $this->Form->label(__('Project Number')); ?>
                            </td>
                            <td class="col2">
                              <?php echo $project['PwcipP']['CIPNumber']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo $this->Form->label(__('Project Name')); ?>
                            </td>
                            <td>
                                <?php echo $project['PwcipP']['CIPName']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo $this->Form->label(__('Location')); ?>
                            </td>
                            <td>
                                <?php echo $project['PwcipP']['Location']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                               <?php echo $this->Form->label(__('Status')); ?>
                            </td>
                            <td>
                               <?php echo $project['PwcipP']['Status']; ?>
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <?php echo $this->Form->label(__('Type')); ?>
                            </td>
                            <td>
                               <?php echo $project['PwcipP']['Type']; ?>
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <?php echo $this->Form->label(__('Total Estimated Project Cost')); ?>
                            </td>
                            <td><?php $dollarSign = strpos($project['PwcipP']['Budget'], '$');
                                echo ($dollarSign === false) ? '$'.$project['PwcipP']['Budget'] : $project['PwcipP']['Budget']; ?>
                            </td>
                        </tr>			
						 <tr>
                            <td>
                               <?php 
							   $date = (isset($project['PwcipP']['TotProjExpenseUpdateDate'])) ? CakeTime::format('m/d/Y', $project['PwcipP']['TotProjExpenseUpdateDate']) : '';
							   echo $this->Form->label(__('Expenditures to date through '.$date)); ?>
                            </td>
                            <td><?php $dollarSign = strpos($project['PwcipP']['Budget'], '$');
                              echo ($dollarSign === false) ? '$'.$project['PwcipP']['TotProjExpense'] : $project['PwcipP']['TotProjExpense']; ?>
                            </td>
                        </tr>	
						 <tr>
                            <td>
                                <?php 
								$date = (isset($project['PwcipP']['ProjCompletionUpdateDate'])) ? CakeTime::format('m/d/Y', $project['PwcipP']['ProjCompletionUpdateDate']) : '';
								echo $this->Form->label(__('Estimated Date of completion as of '.$date)); ?>
                            </td>
                            <td>
                               <?php if($project['PwcipP']['ProjCompletionDate']){ echo CakeTime::format('m/d/Y', $project['PwcipP']['ProjCompletionDate']); } ?>
                            </td>
                        </tr>	
						 <tr>
                            <td>
                               <?php echo $this->Form->label(__('Project Contact')); ?>
                            </td>
                            <td>
                               <?php echo $project['PwcipP']['CityProjectManager']; ?>
                            </td>
                        </tr>			
						 <tr>
                            <td>
                               <?php echo $this->Form->label(__('Contact Email')); ?>
                            </td>
                            <td>
                               <?php echo $project['PwcipP']['CityProjectManagerEmail']; ?>
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <?php echo $this->Form->label(__('Description')); ?>
                            </td>
                            <td>
								<?php echo $project['PwcipP']['Description']; ?>
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <?php echo $this->Form->label(__('Additional Info')); ?>
                            </td>
                            <td>
								<?php echo $project['PwcipP']['AdditionalInfo']; ?>
                            </td>
                        </tr>
						 <tr>
                            <td>
                               <?php echo $this->Form->label(__('Designation(s)')); ?>
                            </td>
                            <td>
								<?php 
$designations = bitMask($project['PwcipP']['ProjDesignations']);
$strDesignation = "";

if(empty($designations)){
	$strDesignation = "None, ";
} else {
	foreach($designations as $designation){
		if($designation == 1)
			$strDesignation .= "City of Tucson, ";
		if($designation == 2)
			$strDesignation .= "Rio Nuevo District, ";
		if($designation == 4)
			$strDesignation .= "Requires Development Agreement Deliverables, ";
		if($designation == 8)
			$strDesignation .= "Government: Non-City, ";
		if($designation == 16)
			$strDesignation .= "Private, ";
		if($designation == 32)
			$strDesignation .= "Downtown, ";
		if($designation == 64)
			$strDesignation .= "Street Work, ";
		if($designation == 128)
			$strDesignation .= "Streetscape Work, ";
		if($designation == 256)
			$strDesignation .= "RTA Funded, ";
		if($designation == 512)
			$strDesignation .= "Rio Nuevo Funded, ";
		if($designation == 1024)
			$strDesignation .= "Capital Improvement Project, ";	
	}
}
echo substr($strDesignation, 0, -2);
?>
                            </td>
                        </tr>	
						 <tr>
                            <td>
                                <?php echo $this->Form->label(__('Awaiting Review')); ?>
                            </td>
                            <td>
                               <?php echo ($project['PwcipP']['ProjectUpdated'] == 1) ? 'Yes' : 'No'; 
									echo ($project['PwcipP']['ProjectDeleted'] == 1) ? ' (Deleted) - Pending Review' : ''; ?>
                            </td>
                        </tr>						
					</table>
					<button onclick="window.location = '<?php echo $this->webroot.'admin/projects/edit/'.$cipid; ?>'" class="btn-icon btn-orange btn-check"><span></span>Edit Project</button>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div id="site_info">
        <p>City Of Tucson Projects | Admin Panel</p>
    </div>