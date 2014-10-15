<script>
  jQuery(function() {
		jQuery( "#tabs" ).tabs().addClass( "ui-helper-clearfix");
  });
</script>
<?php echo $this->Html->link('Current Projects ', '/projects/current', array('escape' => false, 'all')); ?>
    <h2>Project &#35;<?php echo $project['Project']['CIPNumber']; ?> &#45; <?php echo $project['Project']['CIPName']; ?></h2>
<div class="table700">
	<div class="table700content">
<?php
	if(strlen(trim($project['Project']['ProjectPicture'])) > 0){
		echo $this->Html->link($this->Html->image('/pictures/'.$project['Project']['ProjectPicture'], array('alt' => 'Picture', 'class' => 'right', 'style' => 'width:140px;')), '/pictures/'.$project['Project']['ProjectPicture'], array('target' => 'new', 'escape' => false));
	}	else {
		echo $this->Html->image('/pictures/no-photo.png', array('alt' => 'Picture', 'class' => 'right', 'style' => 'width:140px;'));
	}?>
<table cellspacing="0" class="details" style="width:auto">
<tr><td class="location">Location:</td><td><?php echo $project['Project']['Location']; ?></td></tr>

<tr><td class="location">Status:</td><td><?php echo $project['Project']['Status']; ?></td></tr>

<tr><td class="location">Total Estimated Project Cost:</td><td>&#36;<?php echo $project['Project']['Budget']; ?></td></tr>

<tr>
	<td class="location">Expenditures to Date<br />Through <?php if(isset($project['Project']['TotProjExpenseUpdateDate'][0])){ echo CakeTime::format('m/d/Y', $project['Project']['TotProjExpenseUpdateDate']); } ?>:</td>
	<td><?php echo CakeNumber::currency($project['Project']['TotProjExpense'], 'USD'); ?></td>
</tr>
<tr>
	<td class="location">Estimated date of&nbsp;<br />completion as of <?php if(isset($project['Project']['ProjCompletionUpdateDate'][0])){ echo CakeTime::format('m/d/Y', $project['Project']['ProjCompletionUpdateDate']); } ?>:</td>
	<td><?php if(isset($project['Project']['ProjCompletionDate'][0])){ echo CakeTime::format('m/d/Y', $project['Project']['ProjCompletionDate']); } ?></td>
</tr>
<tr>
	<td class="location">Project Contact:</td><td>
<?php
	if($project['Project']['CityProjectManagerEmail']){
		echo $this->Html->link($project['Project']['CityProjectManager'], 'mailto:'.$project['Project']['CityProjectManagerEmail'], array('escape' => false, 'all'));
	} else {
		echo $project['Project']['CityProjectManager'];
	} ?></td>
</tr>
</table>
   <?php echo $this->Html->link('View this project on the Projects Map', 'http://maps.tucsonaz.gov/construction/?projID='.$project['Project']['CIPNumber'], array('target' => '_blank', 'escape' => false, 'all')); ?>
<table cellspacing="0" class="details">
<tr>
	<td class="location">Description:</td><td><?php echo $project['Project']['Description']; ?></td>
</tr>
<tr>
	<td class="location">Additional Info:</td><td><?php echo $project['Project']['AdditionalInfo']; ?></td>
</tr>
<tr>
	<td class="location">Designation(s):</td><td>City of Tucson, Rio Nuevo District, Downtown, Street Work, Streetscape Work, Capital Improvement Project</td>
</tr>
<tr>
	<td class="location">Last Update:</td><td><?php if(isset($project['Project']['UpdateDate'][0])){ echo CakeTime::format('m/d/Y', $project['Project']['UpdateDate']); } ?></td>
</tr>
</table>
	</div>
	<div class="table700bottom"></div>
</div>
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Updates</a></li>
    <li><a href="#tabs-2">Pictures</a></li>
    <li><a href="#tabs-3">Attachments</a></li>
  </ul>
  <div id="tabs-1">
    <h2>Project &#35;<?php echo $project['Project']['CIPNumber']; ?> &#45; Status</h2>
			
			<table class="display">
				<tbody>
				<?php $rows = 0; 
				foreach($statuses as $status){ $rows++; ?>
				<tr>
					<td style="width:15%;"><?php if(isset($status['ProjectStatus']['Date'][0])){ echo CakeTime::format('d-M-y', $status['ProjectStatus']['Date']); } ?></td>
					<td><?php echo $status['ProjectStatus']['Status']; ?></td>
				</tr>
				<?php } if($rows == 0) echo '<tr><td class="dataTables_empty">There are no updates to display</td></tr>'; ?>
				</tbody>
			</table>           
       
  </div>
  <div id="tabs-2">
    <h2>Project &#35;<?php echo $project['Project']['CIPNumber']; ?> &#45; Pictures</h2>			
			<table class="display">
				<tbody>
				<?php $rows = 0; 
				foreach($pictures as $picture){ $rows++; ?>
				<tr>
					<td style="width:15%;"><?php if(isset($picture['ProjectPicture']['Date'][0])){ echo CakeTime::format('d-M-y', $picture['ProjectPicture']['Date']); } ?></td>
					<td>						
<?php 
echo $this->Html->link($this->Html->image('/pictures/'.$picture['ProjectPicture']['Picture'],
array('style' => 'height:75px;width:100px;')), '/pictures/'.$picture['ProjectPicture']['Picture'], array('target' => '_blank', 'escape' => false)); 
?>
					</td>
				</tr>
				<?php } if($rows == 0) echo '<tr><td class="dataTables_empty">There are no pictures to display</td></tr>'; ?>
				</tbody>
			</table>             
	</div>
  <div id="tabs-3">
	<h2>Project &#35;<?php echo $project['Project']['CIPNumber']; ?> &#45; Attachments</h2>
		
		<table class="display">
			<tbody>
			<?php $rows = 0; 
			foreach($attachments as $attachment){ $rows++; ?>
			<tr>
				<td style="width:15%;"><?php if(isset($attachment['ProjectAttachment']['Date'][0])){ echo CakeTime::format('d-M-y', $attachment['ProjectAttachment']['Date']); } ?></td>
				<td>
				<?php echo $this->Html->link($attachment['ProjectAttachment']['AttachmentTitle'], 
					'/files/'.$attachment['ProjectAttachment']['Attachment'], array('target' => '_blank', 'escape' => false));
				 ?>
				</td>
			</tr>
			<?php } if($rows == 0) echo '<tr><td class="dataTables_empty">There are no attachments to display</td></tr>'; ?>
			</tbody>
		</table>                
	</div>
</div>