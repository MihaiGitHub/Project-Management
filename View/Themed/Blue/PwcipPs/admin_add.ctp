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

echo $this->Html->link( $title, '/admin/projects/index', array('escape' => false));
?>				</li>
               
            </ul>
        </div>
        <div class="clear"></div>
      
        <div class="maintable">
            <div class="box round first grid">
                <h2>Add New Project</h2>
                <div class="block">
					<?php echo $this->Form->create('PwcipP', array('controller' => 'PwcipPs', 'action' => 'add')); ?>
                    <table class="form">
                        <tr>
                            <td class="col1">
                                <?php echo $this->Form->label('CIPNumber', __('Project #')); ?>
                            </td>
                            <td class="col2">
								<?php echo $this->Form->input('CIPNumber', array('class' => 'floatleft', 'type' => 'text', 'label' => false)); ?>
								<span class="required">*</span>
                            </td>
                        </tr>
						<tr>
                            <td class="col1">
                                <?php echo $this->Form->label('CIPName', __('Project Name')); ?>
                            </td>
                            <td class="col2">
								<?php echo $this->Form->input('CIPName', array('class' => 'large floatleft', 'type' => 'text', 'label' => false)); ?>
								<span class="required">*</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo $this->Form->label('Location', __('Location')); ?>
                            </td>
                            <td>
								<?php echo $this->Form->input('Location', array('label' => false, 'class' => 'large')); ?>
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
                                <?php echo $this->Form->label('TotProjExpenseUpdateDate', __('Expenditures to Date Update Date')); ?>
                            </td>
                            <td>
								<?php echo $this->Form->input('TotProjExpenseUpdateDate', array('type' => 'text', 'id' => 'TotProjExpenseUpdateDate', 'label' => false)); ?>
                            </td>
                        </tr>	
						 <tr>
                            <td>
                                <?php echo $this->Form->label('TotProjExpense', __('Expenditures to Date As Of Update Date'), array('class' => 'floatleft')); ?>
								<span class="floatright">&#36;</span>
                            </td>
                            <td>
								<?php echo $this->Form->input('TotProjExpense', array('type' => 'text', 'label' => false)); ?>
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <?php echo $this->Form->label('ProjCompletionUpdateDate', __('Estimated Completion Update Date')); ?>
                            </td>
                            <td>
								<?php echo $this->Form->input('ProjCompletionUpdateDate', array('type' => 'text', 'id' => 'ProjCompletionUpdateDate', 'label' => false)); ?>
                            </td>
                        </tr>	
						<tr>
                            <td>
                                <?php echo $this->Form->label('ProjCompletionDate', __('Estimated Project Completion Date')); ?>
                            </td>
                            <td>
								<?php echo $this->Form->input('ProjCompletionDate', array('type' => 'text', 'id' => 'ProjCompletionDate', 'label' => false)); ?>
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
                                <?php echo $this->Form->label('CityProjectManagerEmail', __('Contact Email', true)); ?>
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
array('multiple' => 'checkbox', 'label' => false, 'class' => 'multiple-chb', 'options' => 
array(1 => 'City of Tucson', 2 => 'Rio Nuevo District', 4 => 'Requires Development Agreement Deliverables', 
8 => 'Government: Non-City', 16 => 'Private', 32 => 'Downtown', 64 => 'Street Work', 128 => 'Streetscape Work', 
256 => 'RTA Funded', 512 => 'Rio Nuevo Funded', 1024 => 'Capital Improvement Project')));
?>
                            </td>
                        </tr>								
					</table>
                   <button class="btn-icon btn-orange btn-check"><span></span>Save Project</button>
			<?php 
			echo $this->Form->input('CIPID', array('type' => 'hidden', 'label' => false, 'value' => String::uuid())); 
			echo $this->Form->input('ProjectUpdated', array('type' => 'hidden', 'label' => false, 'value' => 1)); 
			echo $this->Form->input('ProjectDeleted', array('type' => 'hidden', 'label' => false, 'value' => 0)); 
			echo $this->Form->input('AddDate', array('type' => 'hidden', 'label' => false, 'value' => CakeTime::format('m/d/Y h:i A', CakeTime::nice()))); 
			echo $this->Form->input('AddIP', array('type' => 'hidden', 'label' => false, 'value' => $this->request->clientIp())); 
			echo $this->Form->end(); ?>
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
</script>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div id="site_info">
        <p>City Of Tucson Projects | Admin Panel</p>
    </div>