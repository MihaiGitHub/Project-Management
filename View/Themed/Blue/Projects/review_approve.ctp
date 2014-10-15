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
if(!empty($old))
	$oldprojdesignations = bitMask($old['Project']['ProjDesignations']);
if(!empty($new))
	$newprojdesignations = bitMask($new['PwcipP']['ProjDesignations']);

$strOldDesignation = "";
if(empty($oldprojdesignations)){
	$strOldDesignation = "None, ";
} else {
	foreach($oldprojdesignations as $designation){
		if($designation == 1)
			$strOldDesignation .= "City of Tucson, ";
		if($designation == 2)
			$strOldDesignation .= "Rio Nuevo District, ";
		if($designation == 4)
			$strOldDesignation .= "Requires Development Agreement Deliverables, ";
		if($designation == 8)
			$strOldDesignation .= "Government: Non-City, ";
		if($designation == 16)
			$strOldDesignation .= "Private, ";
		if($designation == 32)
			$strOldDesignation .= "Downtown, ";
		if($designation == 64)
			$strOldDesignation .= "Street Work, ";
		if($designation == 128)
			$strOldDesignation .= "Streetscape Work, ";
		if($designation == 256)
			$strOldDesignation .= "RTA Funded, ";
		if($designation == 512)
			$strOldDesignation .= "Rio Nuevo Funded, ";
		if($designation == 1024)
			$strOldDesignation .= "Capital Improvement Project, ";	
	}
}

$strNewDesignation = "";
if(empty($newprojdesignations)){
	$strNewDesignation = "None, ";
} else {
	foreach($newprojdesignations as $designation){
		if($designation == 1)
			$strNewDesignation .= "City of Tucson, ";
		if($designation == 2)
			$strNewDesignation .= "Rio Nuevo District, ";
		if($designation == 4)
			$strNewDesignation .= "Requires Development Agreement Deliverables, ";
		if($designation == 8)
			$strNewDesignation .= "Government: Non-City, ";
		if($designation == 16)
			$strNewDesignation .= "Private, ";
		if($designation == 32)
			$strNewDesignation .= "Downtown, ";
		if($designation == 64)
			$strNewDesignation .= "Street Work, ";
		if($designation == 128)
			$strNewDesignation .= "Streetscape Work, ";
		if($designation == 256)
			$strNewDesignation .= "RTA Funded, ";
		if($designation == 512)
			$strNewDesignation .= "Rio Nuevo Funded, ";
		if($designation == 1024)
			$strNewDesignation .= "Capital Improvement Project, ";	
	}
}
?>
<div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">Projects Review</div>
                <div class="floatright">
                    <div class="floatleft">
						<?php echo $this->Html->image('img-profile.jpg', array('alt' => 'Profile')); ?>
					</div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Hello <?php echo $username; ?></li>
                            <li><?php echo $this->Html->link('Logout', '/review/users/logout/', array('escape' => false)); ?></li>
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

					echo $this->Html->link($title, 'index/', array('escape' => false));
					?>
				</li>
            </ul>
        </div>
		<?php echo $this->Form->create('Project'); ?>
        <div class="clear"></div>
        <div class="grid_12">
		<?php if(!empty($old) && !$new['PwcipP']['ProjectDeleted']){ ?>
<button type="submit" name="save" value="save" class="btn-icon btn-orange btn-check"><span></span>Accept Changes</button>
<button type="button" onclick="window.location = '<?php echo $this->webroot.'/review/projects/index' ?>'" class="btn-icon btn-grey btn-check"><span></span>Cancel</button>
		<?php } ?>
            <div class="box round first fullpage">
				<?php 
				if($new['PwcipP']['ProjectDeleted']){ 
		echo $this->Form->input('CIPID', array('type' => 'hidden', 'value' => $CIPID));
	if(isset($old['Project']['ProjectPicture'])){
		echo $this->Form->input('ProjectPictureOld', array('type' => 'hidden', 'value' => $old['Project']['ProjectPicture']));
	}
	if(isset($old['Project']['AttachedBudget'])){
		echo $this->Form->input('Project.AttachedBudgetOld', array('type' => 'hidden', 'value' => $old['Project']['AttachedBudget']));
	}
		echo $this->Form->input('ProjectPictureNew', array('type' => 'hidden', 'value' => $new['PwcipP']['ProjectPicture']));
		echo $this->Form->input('Project.AttachedBudgetNew', array('type' => 'hidden', 'value' => $new['PwcipP']['AttachedBudget']));

// For Pictures Model
for($i = 0; $i < count($new['PwcipPicturesP']); $i++){
echo $this->Form->input("PwcipPictures.$i.Picture", array('type' => 'hidden', 'value' => $new['PwcipPicturesP'][$i]['Picture'])); 
}
// For Attachments Model
for($i = 0; $i < count($new['PwcipAttachmentsP']); $i++){
echo $this->Form->input("ProjectAttachments.$i.Attachment", array('type' => 'hidden', 'value' => $new['PwcipAttachmentsP'][$i]['Attachment'])); 
}
				?>
<h2><?php echo 'Delete Project: #'.$new['PwcipP']['CIPNumber'].' - '.$new['PwcipP']['CIPName']; ?></h2>
	<div class="block reviewtable">  
		<table class="data display datatable" id="example">
			<tbody>
				<tr>
					<th>Project Number:</th><td><?php echo $new['PwcipP']['CIPNumber']; ?></td>
				</tr>
				<tr>
					<th>Project Name:</th><td><?php echo $new['PwcipP']['CIPName']; ?></td>
				</tr>
				<tr>
					<th>Location:</th><td><?php echo $new['PwcipP']['Location']; ?></td>
				</tr>
				<tr>
					<th>Status:</th><td><?php echo $new['PwcipP']['Status']; ?></td>
				</tr>
				<tr>
					<th>Type:</th><td><?php echo $new['PwcipP']['Type']; ?></td>
				</tr>
				<tr>
					<th>Total Estimated Project Cost:</th>
					<td><?php $dollarSign = strpos($project['PwcipP']['Budget'], '$');
					echo ($dollarSign === false) ? '$'.$new['PwcipP']['Budget'] : $new['PwcipP']['Budget']; ?></td>
				</tr>
				<?php if($new['PwcipP']['TotProjExpenseUpdateDate'] > 0){ ?>
				<tr>
<th class="gold">Expenditures to Date<br />Through <?php echo CakeTime::format('m/d/Y', $new['PwcipP']['TotProjExpenseUpdateDate']); ?>:</th><td>$<?php echo $new['PwcipP']['TotProjExpense']; ?></td></tr>
				<?php } /* Attached Budget */
				if(isset($new['PwcipP']['AttachedBudget'][1])){ ?>
				<tr>
					<th>Budget:</th>
					<td><?php if(isset($new['PwcipP']['AttachedBudget'][1])){
 echo $this->Html->link('Budget', '/files/budget/'.$new['PwcipP']['AttachedBudget'], array('target' => 'new', 'escape' => false)); } ?>
					</td>
				</tr>
				<?php }
				if($new['PwcipP']['ProjCompletionUpdateDate'] > 0 && $new['PwcipP']['ProjCompletionDate'] > 0){ ?>
				<tr>
					<th>Estimated date of<br />completion as of <?php echo CakeTime::format('m/d/Y', $new['PwcipP']['ProjCompletionUpdateDate']); ?>:</th>
					<td><?php echo CakeTime::format('m/d/Y', $new['PwcipP']['ProjCompletionDate']); ?></td>
				</tr>
				<?php } ?>
				<tr>
					<th>Project Contact:</th><td><?php echo $new['PwcipP']['CityProjectManager']; ?></td>
				</tr>
				<tr>
					<th>Contact Email:</th><td><?php echo $new['PwcipP']['CityProjectManagerEmail']; ?></td>
				</tr>
				<tr>
					<th>Description:</th><td><?php echo $new['PwcipP']['Description']; ?></td>
				</tr>
				<tr>
					<th>Additional Info:</th><td><?php echo $new['PwcipP']['AdditionalInfo']; ?></td>
				</tr>
				<tr>
					<th>Designation(s):</th><td><?php echo substr($strNewDesignation, 0, -2); ?></td>
				</tr>
				<tr>
					<th>Date Updated:</th>
					<td><?php if(isset($new['PwcipP']['UpdateDate'])) echo CakeTime::format('m/d/Y', $new['PwcipP']['UpdateDate']); ?></td>
				</tr>
				<?php /* Project Picture */
				if(isset($new['PwcipP']['ProjectPicture'][1])){ ?>
				<tr>
					<th>Picture:</th>
					<td><?php echo $this->Html->link($this->Html->image('/pictures/'.$new['PwcipP']['ProjectPicture'],
					array('alt' => 'Picture', 'style' => 'height:75px;width:100px;')), '/pictures/'.$new['PwcipP']['ProjectPicture'], 
					array('target' => 'new', 'escape' => false)); ?>
					</td>
				</tr>
				<?php } else echo 'none'; /* Project Updates */
				if(!empty($new['PwcipStatusP'])){ ?>
				<tr><th colspan="2">Updates</th></tr>
		<?php
		foreach($new['PwcipStatusP'] as $status){
			echo '<tr><th class="gold"></th><td>'.CakeTime::format('m/d/Y', $status['Date']).': '.$status['Status'].'</td></tr>';
		}
				} /* Project Attachments */
				if(!empty($new['PwcipAttachmentsP'])){ ?>
				<tr><th colspan="2">Attachments</th></tr>
				<?php
				foreach($new['PwcipAttachmentsP'] as $attachment){
echo '<tr><th class="gold"></th><td>'.$this->Html->link($attachment['AttachmentTitle'], '/files/'.$attachment['Attachment'], array('target' => '_blank')).'</td></tr>';	
				}
				} /* Project Pictures */
				if(!empty($new['PwcipPicturesP'])){ ?>
				<tr><th colspan="2">Pictures</th></tr>
				<tr><th>&nbsp;</th><td>
				<?php $i = 1;
				foreach($new['PwcipPicturesP'] as $picture){
					echo $this->Html->link($this->Html->image('/pictures/'.$picture['Picture'],
					array('alt' => 'Picture', 'style' => 'height:75px;width:100px;')), '/pictures/'.$picture['Picture'], 
					array('target' => 'new', 'escape' => false));

					if ($i % 3 == 0)
						echo "<br/>";
						$i++;
				}
	
				echo '</td></tr>';
}
?>
<tr>
  <th class="dataTables_empty" colspan="2">
  <button type="submit" name="delete" value="delete" class="btn-icon btn-orange btn-check"><span></span>Delete Project</button>
  <button type="submit" name="cancel" value="cancel" class="btn-icon btn-orange btn-check"><span></span>Cancel Deletion</button>
  <button type="button" onclick="window.location = '<?php echo $this->webroot.'/review/projects/index' ?>'" class="btn-icon btn-orange btn-check"><span></span>Cancel Review</button>
  </th>
</tr>
</table>
				<?php } else {
					if(empty($old)){ 
					echo $this->Form->input('Project.CIPNumber', array('type' => 'hidden', 'value' => $new['PwcipP']['CIPNumber'])); 
?>
            <h2><?php echo 'New Project: #'.$new['PwcipP']['CIPNumber'].' - '.$new['PwcipP']['CIPName']; ?></h2>
			<div class="block reviewtable">  
				<table class="data display datatable" id="example">
					<tbody>
						<tr>
							<th>Project Number:</th><td><?php echo $new['PwcipP']['CIPNumber']; ?></td>
						</tr>
						<tr>
							<th>Project Name:</th><td><?php echo $new['PwcipP']['CIPName']; ?></td>
						</tr>
						<tr>
							<th>Location:</th><td><?php echo $new['PwcipP']['Location']; ?></td>
						</tr>
						<tr>
							<th>Status:</th><td><?php echo $new['PwcipP']['Status']; ?></td>
						</tr>
						<tr>
							<th>Type:</th><td><?php echo $new['PwcipP']['Type']; ?></td>
						</tr>
						<tr>
							<th>Total Estimated Project Cost:</th>
							<td><?php $dollarSign = strpos($new['PwcipP']['Budget'], '$');
							echo ($dollarSign === false) ? '$'.$new['PwcipP']['Budget'] : $new['PwcipP']['Budget']; ?></td>
						</tr>
						<?php if($new['PwcipP']['TotProjExpenseUpdateDate'] > 0){ ?>
						<tr>
							<th>Expenditures to Date<br />Through <?php echo CakeTime::format('m/d/Y',$new['PwcipP']['TotProjExpenseUpdateDate']); ?>:</th>
							<td><?php echo CakeNumber::currency($new['PwcipP']['TotProjExpense'], 'USD'); ?></td>
						</tr>
						<?php } 
						// Attached Budget 
						if($new['PwcipP']['AttachedBudget']){ ?>
						<tr>
							<th>Budget:</th>
							<td><?php if(isset($new['PwcipP']['AttachedBudget'][1])){
echo $this->Html->link('Budget', '/files/budget/'.$new['PwcipP']['AttachedBudget'], array('target' => 'new', 'escape' => false)); } ?>
							</td>
						</tr>
						<?php }
						if($new['PwcipP']['ProjCompletionUpdateDate'] > 0 && $new['PwcipP']['ProjCompletionDate'] > 0){ ?>
						<tr>
							<th>Estimated date of<br />completion as of <?php echo CakeTime::format($new['PwcipP']['ProjCompletionUpdateDate'], 'USD'); ?>:</th>
							<td><?php echo CakeTime::format($new['PwcipP']['ProjCompletionDate'], 'USD'); ?></td>
						</tr>
						<?php } ?>
						<tr>
							<th>Project Contact:</th><td><?php echo $new['PwcipP']['CityProjectManager']; ?></td>
						</tr>
						<tr>
							<th>Contact Email:</th><td><?php echo $new['PwcipP']['CityProjectManagerEmail']; ?></td>
						</tr>
						<tr>
							<th>Description:</th><td><?php echo $new['PwcipP']['Description']; ?></td>
						</tr>
						<tr>
							<th>Additional Info:</th><td><?php echo $new['PwcipP']['AdditionalInfo']; ?></td>
						</tr>
						<tr>
							<th>Designation(s):</th><td><?php echo substr($strNewDesignation, 0, -2); ?></td>
						</tr>
						<tr>
							<th>Date Added:</th><td><?php if($new['PwcipP']['AddDate']) echo CakeTime::format('m/d/Y h:i A', $new['PwcipP']['AddDate']); ?></td>
						</tr>
						<tr>
							<th>IP Added:</th><td><?php echo $new['PwcipP']['AddIP']; ?></td>
						</tr>
						<tr>
							<th>Date Updated:</th><td><?php if($new['PwcipP']['UpdateDate']) echo CakeTime::format('m/d/Y', $new['PwcipP']['UpdateDate']); ?></td>
						</tr>
						<tr>
						  <th>Project Picture:</th>
						  <td>
						  <?php if(isset($new['PwcipP']['ProjectPicture'][1])){
						echo $this->Html->link($this->Html->image('/pictures/'.$new['PwcipP']['ProjectPicture'],
						array('alt' => 'Picture', 'style' => 'height:75px;width:100px;')), '/pictures/'.$new['PwcipP']['ProjectPicture'], 
						array('target' => 'new', 'escape' => false));
							} else echo 'none'; ?>
						  </td>
						</tr>
						<?php if(!empty($new['PwcipStatusP'])){ ?>
						<tr>
							<th colspan="2">Updates</th>
						</tr>
						<?php
		foreach($new['PwcipStatusP'] as $status){
			echo '<tr><th class="gold"></th><td>'.CakeTime::format('m/d/Y', $status['Date']).': '.$status['Status'].'</td></tr>';
		}
						}

						if(!empty($new['PwcipAttachmentsP'])){ ?>
						<tr>
							<th colspan="2">Attachments</th>
						</tr>
						<?php
	foreach($new['PwcipAttachmentsP'] as $attachment){
echo '<tr><th class="gold"></th><td>'.$this->Html->link($attachment['AttachmentTitle'], '/files/'.$attachment['Attachment'], array('target' => '_blank')).'</td></tr>';	
	}
						}
						if(!empty($new['PwcipPicturesP'])){ ?>
						<tr>
							<th colspan="2">Pictures</th>
						</tr>
						<?php $i = 1;
						echo '<tr><th class="gold"></th><td>';

						foreach($new['PwcipPicturesP'] as $picture){
							
							echo $this->Html->link($this->Html->image('/pictures/'.$picture['Picture'],
							array('alt' => 'Picture', 'style' => 'height:75px;width:100px;')), '/pictures/'.$picture['Picture'], 
							array('target' => 'new', 'escape' => false));

							if ($i % 3 == 0)
								echo "<br/>";
								$i++;

						}
						
						echo '</td></tr>';
						}
?>
<tr>
	<th colspan="2">
<button type="submit" name="new" value="new" class="btn-icon btn-orange btn-check"><span></span>Accept New Project</button>
	</th>
</tr>

					</tbody>
				</table>
			</div>
					<?php } else { ?>

		<h2><?php echo 'Updated Project: #'.$new['PwcipP']['CIPNumber'].' - '.$new['PwcipP']['CIPName']; ?></h2>

			<div class="block reviewtable">  
                <table class="data display datatable" id="example">
					<tbody>
<tr><th class="dataTables_empty" colspan="2">Current</th><th colspan="2" class="dataTables_empty">Changes</th></tr>
<tr>
	<th style="width:20%;">Project Number:</th><td style="width:30%;"><?php echo $old['Project']['CIPNumber']; ?></td>
	<th style="width:20%;">Project Number:</th><td<?php if($old['Project']['CIPNumber'] != $new['PwcipP']['CIPNumber']) echo ' style="width:30%;background-color:#999;"'; ?>><?php echo $new['PwcipP']['CIPNumber']; ?></td>
</tr>
<tr>
	<th>Project Name:</th><td><?php echo $old['Project']['CIPName']; ?></td>
	<th>Project Name:</th><td<?php if($old['Project']['CIPName'] != $new['PwcipP']['CIPName']) echo ' class="updated"'; ?>><?php echo $new['PwcipP']['CIPName']; ?></td>
</tr>
<tr>
	<th>Location:</th><td><?php echo $old['Project']['Location']; ?></td>
	<th>Location:</th><td<?php if($old['Project']['Location'] != $new['PwcipP']['Location']) echo ' class="updated"'; ?>><?php echo $new['PwcipP']['Location']; ?></td>
</tr>
<tr>
	<th>Status:</th><td><?php echo $old['Project']['Status']; ?></td>
	<th>Status:</th><td<?php if($old['Project']['Status'] != $new['PwcipP']['Status']) echo ' class="updated"'; ?>><?php echo $new['PwcipP']['Status']; ?></td>
</tr>
<tr>
	<th>Type:</th><td><?php echo $old['Project']['Type']; ?></td>
	<th>Type:</th><td<?php if($old['Project']['Type'] != $new['PwcipP']['Type']) echo ' class="updated"'; ?>><?php echo $new['PwcipP']['Type']; ?></td>
</tr>
<tr>
	<th>Total Estimated Project Cost:</th>
	<td><?php $dollarSign = strpos($old['Project']['Budget'], '$');
	echo ($dollarSign === false) ? '$'.$old['Project']['Budget'] : $old['Project']['Budget']; ?></td>
	<th>Total Estimated Project Cost:</th><td<?php if($old['Project']['Budget'] != $new['PwcipP']['Budget']) echo ' class="updated"'; ?>><?php 
	$dollarSign = strpos($new['PwcipP']['Budget'], '$');
	echo ($dollarSign === false) ? '$'.$new['PwcipP']['Budget'] : $new['PwcipP']['Budget']; ?></td>
</tr>
<tr>
	<th>Expenditures to Date<br />Update Date:</th><td><?php if($old['Project']['TotProjExpenseUpdateDate']){ echo CakeTime::format('m/d/Y', $old['Project']['TotProjExpenseUpdateDate']); } ?></td>
	<th>Expenditures to Date<br />Update Date:</th><td<?php if(trim($old['Project']['TotProjExpenseUpdateDate']) != trim($new['PwcipP']['TotProjExpenseUpdateDate'])) echo ' class="updated"'; ?>><?php if($new['PwcipP']['TotProjExpenseUpdateDate']) { echo CakeTime::format('m/d/Y', $new['PwcipP']['TotProjExpenseUpdateDate']); } ?></td>
</tr>
<tr>
	<th>Expenditures to Date Through <?php if($old['Project']['TotProjExpenseUpdateDate']){ echo CakeTime::format('m/d/Y', $old['Project']['TotProjExpenseUpdateDate']); } ?>:</th><td><?php 
	$dollarSign = strpos($new['PwcipP']['TotProjExpense'], '$');
	echo ($dollarSign === false) ? '$'.$new['PwcipP']['TotProjExpense'] : $new['PwcipP']['TotProjExpense']; ?></td>
	<th>Expenditures to Date Through <?php if($old['Project']['TotProjExpenseUpdateDate']){ echo CakeTime::format('m/d/Y', $old['Project']['TotProjExpenseUpdateDate']); } ?>:</th><td<?php if($old['Project']['TotProjExpense'] != $new['PwcipP']['TotProjExpense']) echo ' class="updated"'; ?>><?php 
	$dollarSign = strpos($new['PwcipP']['TotProjExpense'], '$');
	echo ($dollarSign === false) ? '$'.$new['PwcipP']['TotProjExpense'] : $new['PwcipP']['TotProjExpense']; ?></td>
</tr>
<tr>
	<th>Budget:</th>
	<td>
	<?php 
	if(isset($old['Project']['AttachedBudget'][1])){ 

	echo $this->Html->link('Budget', '/files/budget/'.$old['Project']['AttachedBudget'], array('target' => 'new', 'escape' => false));

	} else echo 'none'; ?>
	</td>
	<th>Budget:</th>
	<td <?php if(trim($old['Project']['AttachedBudget']) != trim($new['PwcipP']['AttachedBudget'])) echo ' class="updated"'; ?>>
	<?php  if(isset($new['PwcipP']['AttachedBudget'][1])){ 
echo $this->Html->link('Budget', '/files/budget/'.$new['PwcipP']['AttachedBudget'], array('target' => 'new', 'escape' => false));
	} else echo 'none'; ?>
	</td>
</tr>
<tr>
	<th>Estimated Completion<br />Update Date:</th><td><?php if($old['Project']['ProjCompletionUpdateDate']){ echo CakeTime::format('m/d/Y', $old['Project']['ProjCompletionUpdateDate']); } ?></td>
	<th>Estimated Completion<br />Update Date:</th><td<?php if($old['Project']['ProjCompletionUpdateDate'] != $new['PwcipP']['ProjCompletionUpdateDate']) echo ' class="updated"'; ?>><?php if($new['PwcipP']['ProjCompletionUpdateDate']){ echo CakeTime::format('m/d/Y', $new['PwcipP']['ProjCompletionUpdateDate']); } ?></td>
</tr>
<tr>
	<th>Estimated date of completion<br />as of <?php if($old['Project']['ProjCompletionUpdateDate']){ 
	echo CakeTime::format('m/d/Y', $old['Project']['ProjCompletionUpdateDate']); } ?>:
	</th>
	<td>
<?php if($old['Project']['ProjCompletionDate']){ echo CakeTime::format('m/d/Y', $old['Project']['ProjCompletionDate']); } ?>
	</td>
	
	
	<th>Estimated date of completion<br />as of <?php if($old['Project']['ProjCompletionUpdateDate']){ 
		echo CakeTime::format('m/d/Y', $old['Project']['ProjCompletionUpdateDate']); } ?>:
	</th>
	<td<?php if($old['Project']['ProjCompletionDate'] != $new['PwcipP']['ProjCompletionDate']) echo ' class="updated"'; ?>>
	<?php if($new['PwcipP']['ProjCompletionDate']){ echo CakeTime::format('m/d/Y', $new['PwcipP']['ProjCompletionDate']); } ?></td>
</tr>
<tr>
	<th>Project Contact:</th><td><?php echo $old['Project']['CityProjectManager']; ?></td>
	<th>Project Contact:</th><td<?php if($old['Project']['CityProjectManager'] != $new['PwcipP']['CityProjectManager']) echo ' class="updated"'; ?>><?php echo $new['PwcipP']['CityProjectManager']; ?></td>
</tr>
<tr>
	<th>Contact Email:</th><td><?php echo $old['Project']['CityProjectManagerEmail']; ?></td>
	<th>Contact Email:</th><td<?php if($old['Project']['CityProjectManagerEmail'] != $new['PwcipP']['CityProjectManagerEmail']) echo ' class="updated"'; ?>><?php echo $new['PwcipP']['CityProjectManagerEmail']; ?></td>
</tr>
<tr>
	<th>Description:</th>
	<td><?php echo $old['Project']['Description']; ?></td>
	<th>Description:</th>
	<td<?php 
	if(strcmp($old['Project']['Description'], $new['PwcipP']['Description']))	echo ' class="updated"'; ?>>
		<?php echo $new['PwcipP']['Description']; ?>
	</td>
</tr>
<tr>
	<th>Additional Info:</th><td><?php echo $old['Project']['AdditionalInfo']; ?></td>
	<th>Additional Info:</th>
	<td<?php if(strcmp($old['Project']['AdditionalInfo'], $new['PwcipP']['AdditionalInfo'])) echo ' class="updated"'; ?>>
		<?php echo $new['PwcipP']['AdditionalInfo']; ?>
	</td>
</tr>
<tr>
	<th>Designation(s):</th><td><?php echo substr($strOldDesignation, 0, -2); ?></td>
	<th>Designation(s):</th><td<?php if($old['Project']['ProjDesignations'] != $new['PwcipP']['ProjDesignations']) echo ' class="updated"'; ?>><?php echo substr($strNewDesignation, 0, -2); ?></td>
</tr>
<tr>
	<th>Date Updated:</th><td><?php if($old['Project']['UpdateDate']){ echo CakeTime::format('m/d/Y', $old['Project']['UpdateDate']); } ?></td>
	<th>Date Updated:</th><td class="updated"><?php if($new['PwcipP']['UpdateDate']){ echo CakeTime::format('m/d/Y', $new['PwcipP']['UpdateDate']); } ?></td>
</tr>
<tr>
	<th>Project Picture:</th>
	<td>
	<?php if(isset($old['Project']['ProjectPicture'][1])){
echo $this->Html->link($this->Html->image('/pictures/'.$old['Project']['ProjectPicture'],
array('alt' => 'Picture', 'style' => 'height:75px;width:100px;')), '/pictures/'.$old['Project']['ProjectPicture'], 
array('target' => 'new', 'escape' => false));
	} else echo 'none';
	?>
	</td>
	<th>Project Picture:</th>
	<td <?php if(trim($old['Project']['ProjectPicture']) != trim($new['PwcipP']['ProjectPicture'])){ echo ' class="updated"'; } ?>>	
<?php 
	if(isset($new['PwcipP']['ProjectPicture'][1])){
echo $this->Html->link($this->Html->image('/pictures/'.$new['PwcipP']['ProjectPicture'],
array('alt' => 'Picture', 'style' => 'height:75px;width:100px;')), '/pictures/'.$new['PwcipP']['ProjectPicture'], 
array('target' => 'new', 'escape' => false));
	} else echo 'none';
?>
	</td>
</tr>
<tr><th colspan="4">Updates</th></tr>
<?php
	$old['ProjectStatus'] = array_reverse($old['ProjectStatus']);
	$new['PwcipStatusP'] = array_reverse($new['PwcipStatusP']);

	$count = (count($old['ProjectStatus']) > count($new['PwcipStatusP'])) ? count($old['ProjectStatus']) : count($new['PwcipStatusP']);

	echo '<tr>';
	for($i = $count; $i >= 0; $i--){
		if(isset($old['ProjectStatus'][$i-1]))
			echo '<td  class="dataTables_empty">'.CakeTime::format('m/d/Y', $old['ProjectStatus'][$i-1]['Date']).'</td><td>'.$old['ProjectStatus'][$i-1]['Status'].'</td>';
		else
			echo '<td colspan="2">&nbsp;</td>';		
		
		if(isset($new['PwcipStatusP'][$i-1])){
			echo '<td  class="dataTables_empty">'.CakeTime::format('m/d/Y', $new['PwcipStatusP'][$i-1]['Date']).'</td>';
			if($old['ProjectStatus'][$i-1]['Status'] != $new['PwcipStatusP'][$i-1]['Status']){ 
				echo '<td class="updated">'; 
			} else { 
				echo '<td>'; 
			}
			echo $new['PwcipStatusP'][$i-1]['Status'].'</td>';
		} else
			echo '<td colspan="2">&nbsp;</td>';
					
		echo ($i == $count) ? '</tr>' : '</tr><tr>';
	}
?>
<tr><th colspan="4">Pictures</th></tr>
<?php
	$old['ProjectPicture'] = array_reverse($old['ProjectPicture']);
	$new['PwcipPicturesP'] = array_reverse($new['PwcipPicturesP']);
	
	$count = (count($old['ProjectPicture']) > count($new['PwcipPicturesP'])) ? count($old['ProjectPicture']) : count($new['PwcipPicturesP']);

	echo '<tr>';
	for($i = $count; $i >= 0; $i--){
		if(isset($old['ProjectPicture'][$i-1])){
			echo '<td  class="dataTables_empty">'.CakeTime::format('m/d/Y', $old['ProjectPicture'][$i-1]['Date']).'</td>
				 <td>'.$this->Html->link($this->Html->image('/pictures/'.$old['ProjectPicture'][$i-1]['Picture'],
				 array('alt' => 'Picture', 'style' => 'height:75px;width:100px;')), '/pictures/'.$old['ProjectPicture'][$i-1]['Picture'], 
				 array('target' => 'new', 'escape' => false)).'</td>';
		} else
			echo '<td colspan="2">&nbsp;</td>';		
		
		if(isset($new['PwcipPicturesP'][$i-1])){
			echo '<td  class="dataTables_empty">'.CakeTime::format('m/d/Y', $new['PwcipPicturesP'][$i-1]['Date']).'</td>';
			if($old['ProjectPicture'][$i-1]['Picture'] != $new['PwcipPicturesP'][$i-1]['Picture']){
				echo '<td class="updated">';
			} else {
				echo '<td>';
			}
			echo $this->Html->link($this->Html->image('/pictures/'.$new['PwcipPicturesP'][$i-1]['Picture'],
				 array('alt' => 'Picture', 'style' => 'height:75px;width:100px;')), '/pictures/'.$new['PwcipPicturesP'][$i-1]['Picture'], 
				 array('target' => 'new', 'escape' => false)).'</td>';
		} else
			echo '<td colspan="2">&nbsp;</td>';
					
		echo ($i == $count) ? '</tr>' : '</tr><tr>';
	}
?>
<tr><th colspan="4">Attachments</th></tr>
<?php
	$old['ProjectAttachment'] = array_reverse($old['ProjectAttachment']);
	$new['PwcipAttachmentsP'] = array_reverse($new['PwcipAttachmentsP']);

	$count = (count($old['ProjectAttachment']) > count($new['PwcipAttachmentsP'])) ? count($old['ProjectAttachment']) : count($new['PwcipAttachmentsP']);

	echo '<tr>';
	for($i = $count; $i >= 0; $i--){
		if(isset($old['ProjectAttachment'][$i-1]))
			echo '<td  class="dataTables_empty">'.CakeTime::format('m/d/Y', $old['ProjectAttachment'][$i-1]['Date']).'</td><td>'.$this->Html->link($old['ProjectAttachment'][$i-1]['AttachmentTitle'], '/files/'.$old['ProjectAttachment'][$i-1]['Attachment'], array('target' => 'new', 'escape' => false)).'</td>';
		else
			echo '<td colspan="2">&nbsp;</td>';		
		
		if(isset($new['PwcipAttachmentsP'][$i-1])){
			echo '<td  class="dataTables_empty">'.CakeTime::format('m/d/Y', $new['PwcipAttachmentsP'][$i-1]['Date']).'</td>';
			if($old['ProjectAttachment'][$i-1]['Attachment'] != $new['PwcipAttachmentsP'][$i-1]['Attachment']){
				echo '<td class="updated">';
			} else {
				echo '<td>';
			}
			echo $this->Html->link($new['PwcipAttachmentsP'][$i-1]['AttachmentTitle'], '/files/'.$new['PwcipAttachmentsP'][$i-1]['Attachment'], array('target' => 'new', 'escape' => false)).'</td>';
		} else
			echo '<td colspan="2">&nbsp;</td>';
					
		echo ($i == $count) ? '</tr>' : '</tr><tr>';
	}
?>

					</tbody>
				</table> 
			</div>
<?php
			}
		
// Project Model
echo $this->Form->input('Project.CIPName', array('type' => 'hidden', 'value' => $new['PwcipP']['CIPName']));
echo $this->Form->input('Project.Location', array('type' => 'hidden', 'value' => $new['PwcipP']['Location']));
echo $this->Form->input('Project.Status', array('type' => 'hidden', 'value' => $new['PwcipP']['Status']));
echo $this->Form->input('Project.Type', array('type' => 'hidden', 'value' => $new['PwcipP']['Type']));
echo $this->Form->input('Project.Budget', array('type' => 'hidden', 'value' => $new['PwcipP']['Budget']));
if($new['PwcipP']['TotProjExpenseUpdateDate'])
echo $this->Form->input('Project.TotProjExpenseUpdateDate', array('type' => 'hidden', 'value' => $new['PwcipP']['TotProjExpenseUpdateDate']));

echo $this->Form->input('Project.TotProjExpense', array('type' => 'hidden', 'value' => $new['PwcipP']['TotProjExpense']));
echo $this->Form->input('Project.AttachedBudget', array('type' => 'hidden', 'value' => $new['PwcipP']['AttachedBudget']));

if($new['PwcipP']['ProjCompletionUpdateDate'])
echo $this->Form->input('Project.ProjCompletionUpdateDate', array('type' => 'hidden', 'value' => $new['PwcipP']['ProjCompletionUpdateDate']));

if($new['PwcipP']['ProjCompletionDate'])
echo $this->Form->input('Project.ProjCompletionDate', array('type' => 'hidden', 'value' => $new['PwcipP']['ProjCompletionDate']));

echo $this->Form->input('Project.CityProjectManager', array('type' => 'hidden', 'value' => $new['PwcipP']['CityProjectManager']));
echo $this->Form->input('Project.CityProjectManagerEmail', array('type' => 'hidden', 'value' => $new['PwcipP']['CityProjectManagerEmail']));
echo $this->Form->input('Project.Description', array('type' => 'hidden', 'value' => $new['PwcipP']['Description']));
echo $this->Form->input('Project.AdditionalInfo', array('type' => 'hidden', 'value' => $new['PwcipP']['AdditionalInfo']));
echo $this->Form->input('Project.ProjDesignations', array('type' => 'hidden', 'value' => $new['PwcipP']['ProjDesignations']));
echo $this->Form->input('Project.UpdateDate', array('type' => 'hidden', 'value' => CakeTime::format('m/d/Y', CakeTime::nice())));
echo $this->Form->input('Project.ProjectPicture', array('type' => 'hidden', 'value' => $new['PwcipP']['ProjectPicture']));
echo $this->Form->input('Project.CIPID', array('type' => 'hidden', 'value' => $CIPID)); 
echo $this->Form->input('Project.AddDate', array('type' => 'hidden', 'label' => false, 'value' => $new['PwcipP']['AddDate'])); 
echo $this->Form->input('Project.AddIP', array('type' => 'hidden', 'label' => false, 'value' => $this->request->clientIp())); 

// For Status Model
for($i = 0; $i < count($new['PwcipStatusP']); $i++){
echo $this->Form->input("ProjectStatus.$i.CIPID", array('type' => 'hidden', 'value' => $new['PwcipStatusP'][$i]['CIPID']));
echo $this->Form->input("ProjectStatus.$i.Status", array('type' => 'hidden', 'value' => $new['PwcipStatusP'][$i]['Status']));
echo $this->Form->input("ProjectStatus.$i.Date", array('type' => 'hidden', 'value' => $new['PwcipStatusP'][$i]['Date']));
echo $this->Form->input("ProjectStatus.$i.StatusID", array('type' => 'hidden', 'value' => $new['PwcipStatusP'][$i]['StatusID']));
echo $this->Form->input("ProjectStatus.$i.AddDate", array('type' => 'hidden', 'value' => $new['PwcipStatusP'][$i]['AddDate']));
echo $this->Form->input("ProjectStatus.$i.AddIP", array('type' => 'hidden', 'value' => $this->request->clientIp()));
}

// For Pictures Model
for($i = 0; $i < count($new['PwcipPicturesP']); $i++){
echo $this->Form->input("ProjectPicture.$i.CIPID", array('type' => 'hidden', 'value' => $new['PwcipPicturesP'][$i]['CIPID'])); 
echo $this->Form->input("ProjectPicture.$i.Picture", array('type' => 'hidden', 'value' => $new['PwcipPicturesP'][$i]['Picture'])); 
echo $this->Form->input("ProjectPicture.$i.Comments", array('type' => 'hidden', 'value' => $new['PwcipPicturesP'][$i]['Comments'])); 
echo $this->Form->input("ProjectPicture.$i.Date", array('type' => 'hidden', 'value' => $new['PwcipPicturesP'][$i]['Date'])); 
echo $this->Form->input("ProjectPicture.$i.PicturesID", array('type' => 'hidden', 'value' => $new['PwcipPicturesP'][$i]['PicturesID'])); 
echo $this->Form->input("ProjectPicture.$i.AddDate", array('type' => 'hidden', 'value' => $new['PwcipPicturesP'][$i]['AddDate'])); 
echo $this->Form->input("ProjectPicture.$i.AddIP", array('type' => 'hidden', 'value' => $this->request->clientIp())); 
}
// For Attachments Model
for($i = 0; $i < count($new['PwcipAttachmentsP']); $i++){
echo $this->Form->input("ProjectAttachment.$i.CIPID", array('type' => 'hidden', 'value' => $new['PwcipAttachmentsP'][$i]['CIPID'])); 
echo $this->Form->input("ProjectAttachment.$i.Attachment", array('type' => 'hidden', 'value' => $new['PwcipAttachmentsP'][$i]['Attachment'])); 
echo $this->Form->input("ProjectAttachment.$i.Date", array('type' => 'hidden', 'value' => $new['PwcipAttachmentsP'][$i]['Date'])); 
echo $this->Form->input("ProjectAttachment.$i.Comments", array('type' => 'hidden', 'value' => $new['PwcipAttachmentsP'][$i]['Comments'])); 
echo $this->Form->input("ProjectAttachment.$i.AttachmentsID", array('type' => 'hidden', 'value' => $new['PwcipAttachmentsP'][$i]['AttachmentsID'])); 
echo $this->Form->input("ProjectAttachment.$i.AttachmentTitle", array('type' => 'hidden', 'value' => $new['PwcipAttachmentsP'][$i]['AttachmentTitle'])); 
echo $this->Form->input("ProjectAttachment.$i.AddDate", array('type' => 'hidden', 'value' => $new['PwcipAttachmentsP'][$i]['AddDate'])); 
echo $this->Form->input("ProjectAttachment.$i.AddIP", array('type' => 'hidden', 'value' => $this->request->clientIp())); 
}
} // End of else from Delete
echo $this->Form->end();
?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div id="site_info">
        <p><?php echo str_replace('-',' ',ucwords(APP_DIR)); ?></p>
    </div>