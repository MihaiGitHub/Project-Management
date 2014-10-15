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
$selected = bitMask($project['PwcipP']['ProjDesignations']);
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
                        <li><?php echo $this->Html->link('Home', 'view/'.$cipid, array('escape' => false)); ?>
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
            <div class="box round first fullpage">
			<?php echo $this->Form->create('PwcipP'); ?>

                <h2>Project &#35;<?php echo $project['PwcipP']['CIPNumber']; ?> - <?php echo $project['PwcipP']['CIPName']; ?></h2>
                <div class="blockk">
                    
                    <table class="form">
                        <tr>
                            <td class="col1">
                                <?php echo $this->Form->label('CIPNumber', __('Project Number')); ?>
                            </td>
                            <td class="col2">
                              <?php echo $project['PwcipP']['CIPNumber']; ?>
                            </td>
                        </tr>
                       <tr>
                            <td>
                                <?php echo $this->Form->label('CIPName', __('Project Name')); ?>
                            </td>
                            <td>
                                <?php echo $this->Form->input('CIPName', array('class' => 'floatleft large', 'type' => 'text', 'label' => false)); ?>
								<span class="required">*</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo $this->Form->label('Location', __('Location')); ?>
                            </td>
                            <td>
                                <?php echo $this->Form->input('Location', array('class' => 'large', 'label' => false)); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo $this->Form->label('Status', __('Status')); ?>
                            </td>
                            <td>
								<?php 
$options = array('' => '','Under Construction' => 'Under Construction', 'Unknown' => 'Unknown', 'In Plan Review' => 'In Plan Review', 
'In Design' => 'In Design', 'In Planning' => 'In Planning', 'Completed' => 'Completed', 'Pre-Design' => 'Pre-Design', 'In Conceptual Design' => 'In Conceptual Design',
'Operational' => 'Operational', 'On Hold' => 'On Hold', 'Pending' => 'Pending', 'Suspended' => 'Suspended', 'Canceled' => 'Canceled',
'Archived' => 'Archived');
echo $this->Form->input('Status', array('label' => false, 'options' => $options, 'type' => 'select')); ?>
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <?php echo $this->Form->label('Type', __('Type')); ?>
                            </td>
                            <td>
								<?php 
$options = array('Drainage' => 'Drainage','Facilities' => 'Facilities', 'Miscellaneous' => 'Miscellaneous', 
'Signal' => 'Signal', 'Transportation' => 'Transportation', 'Wastewater' => 'Wastewater', 'Water' => 'Water');
echo $this->Form->input('Type', array('class' => 'floatleft', 'label' => false, 'options' => $options, 'type' => 'select')); ?>
								<span class="required">*</span>
                            </td>
                        </tr>
				 		 <tr>
                            <td>
                                <?php echo $this->Form->label('Budget', __('Total Estimated Project Cost'), array('class' => 'floatleft')); ?>
                            <span class="floatright">&#36;</span>
							</td>
                            <td>
                               <?php echo $this->Form->input('Budget', array('label' => false)); ?>
							   
                            </td>
                        </tr>			
						 <tr>
                            <td>
                                <?php echo $this->Form->label('TotProjExpenseUpdateDate', __('Expenditures to date update date')); ?>
                            </td>
                            <td>
                              <?php echo CakeTime::format('m/d/Y', $this->Form->input(CakeTime::format('m/d/Y','TotProjExpenseUpdateDate'), array('id' => 'TotProjExpenseUpdateDate', 'type' => 'text', 'label' => false))); ?>
                            </td>
                        </tr>	
						<tr>
                            <td>
                                <?php echo $this->Form->label('TotProjExpense', __('Expenditures to date as of update date')); ?>
								<span class="floatright">&#36;</span>
                            </td>
                            <td>
                              <?php echo $this->Form->input('TotProjExpense', array('type' => 'text', 'label' => false)); ?>
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <?php echo $this->Form->label('ProjCompletionUpdateDate', __('Estimated Completion update date')); ?>
                            </td>
                            <td>
                               <?php echo $this->Form->input('ProjCompletionUpdateDate', array('id' => 'ProjCompletionUpdateDate', 'type' => 'text', 'label' => false)); ?>
                            </td>
                        </tr>	
						 <tr>
                            <td>
                                <?php echo $this->Form->label('ProjCompletionDate', __('Estimated Project completion date')); ?>
                            </td>
                            <td>
                               <?php echo $this->Form->input('ProjCompletionDate', array('id' => 'ProjCompletionDate', 'type' => 'text', 'label' => false)); ?>
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <?php echo $this->Form->label('CityProjectManager', __('Project Contact')); ?>
                            </td>
                            <td>
                               <?php echo $this->Form->input('CityProjectManager', array('class' => 'medium', 'label' => false)); ?>
                            </td>
                        </tr>			
						 <tr>
                            <td>
                                <?php echo $this->Form->label('CityProjectManagerEmail', __('Contact Email')); ?>
                            </td>
                            <td>
							   <?php echo $this->Form->input('CityProjectManagerEmail', array('class' => 'medium', 'label' => false)); ?>
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <?php echo $this->Form->label('Description', __('Description')); ?>
                            </td>
                            <td>
								<?php echo $this->Form->input('Description', array('class' => 'txtarea', 'label' => false)); ?>
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <?php echo $this->Form->label('AdditionalInfo', __('Additional Info')); ?>
                            </td>
                            <td>
								<?php echo $this->Form->input('AdditionalInfo', array('class' => 'txtarea', 'label' => false)); ?>
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <?php echo $this->Form->label('ProjDesignations', __('Designation(s)')); ?>
                            </td>
                            <td>
								<?php 
echo $this->Form->input('ProjDesignations', 
array('selected' => $selected, 'multiple' => 'checkbox', 'label' => false, 'class' => 'multiple-chb', 'options' => 
array(1 => 'City of Tucson', 2 => 'Rio Nuevo District', 4 => 'Requires Development Agreement Deliverables', 
8 => 'Government: Non-City', 16 => 'Private', 32 => 'Downtown', 64 => 'Street Work', 128 => 'Streetscape Work', 
256 => 'RTA Funded', 512 => 'Rio Nuevo Funded', 1024 => 'Capital Improvement Project')));
?>
                            </td>
                        </tr>	
						 <tr>
                            <td>
                               <?php echo $this->Form->label('ProjectUpdated', __('Awaiting Review')); ?>
                            </td>
                            <td>
							   <?php echo ($project['PwcipP']['ProjectUpdated'] == 1) ? 'Yes' : 'No'; 
									echo ($project['PwcipP']['ProjectDeleted'] == 1) ? ' (Deleted) - Pending Review' : ''; ?>
                            </td>
                        </tr>	
					</table>
                </div>
			<button name="save" value="save" class="btn-icon btn-orange btn-check"><span></span>Save Project</button>
			<button onclick="return disp_confirm()" name="delete" value="delete" class="btn-icon btn-grey btn-cross"><span></span>Delete Project</button>
			<?php 				
echo $this->Form->input('CIPID', array('type' => 'hidden', 'value' => $project['PwcipP']['CIPID'])); 
echo $this->Form->input('UpdateDate', array('type' => 'hidden', 'label' => false, 'value' => CakeTime::format('m/d/Y', CakeTime::nice()))); 
echo $this->Form->input('AddIP', array('type' => 'hidden', 'label' => false, 'value' => $this->request->clientIp())); 
echo $this->Form->end();  ?>
            </div>
        </div>
	<script type="text/javascript">
jQuery(function() {	
	jQuery("#TotProjExpenseUpdateDate").datepicker({
	 	changeMonth: true,
		changeYear: true,
		dateFormat: "mm/dd/yy" 
	}).val();
	
	jQuery("#ProjCompletionUpdateDate").datepicker({
	 	changeMonth: true,
		changeYear: true,
		dateFormat: "mm/dd/yy" 
	}).val();
	
	jQuery("#ProjCompletionDate").datepicker({
	 	changeMonth: true,
		changeYear: true,
		dateFormat: "mm/dd/yy" 
	}).val();
});
function disp_confirm(){
	var r = confirm("Are you sure you want to delete?")
	if (r == true){
	  document.forms[0].submit();
	} else { return false; }
}
</script>	
        <div class="clear"></div>
    </div>
    <div id="site_info">
        <p>City Of Tucson Projects | Admin Panel</p>
    </div>