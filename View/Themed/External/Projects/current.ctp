<table align="center" class="nocolor" style="margin:0 auto;width:auto">
		<tr>
			<td><?php echo $this->Html->link('All Projects', '/projects/all', array('class' => 'btn', 'escape' => false)); ?></td>
			<td><?php echo $this->Html->link('Current Projects', '/projects/current', array('class' => 'btn', 'escape' => false)); ?></td>
			<td><?php echo $this->Html->link('Completed Projects', '/projects/completed', array('class' => 'btn', 'escape' => false)); ?></td>
		</tr>
</table>
<div class="fullpage">
<div class="right"><?php echo $this->Html->link('Projects Map', 'http://maps.tucsonaz.gov/construction/', array('escape' => false)); ?></div>
	<h2><?php echo $this->Form->label(__('Current Projects')); ?></h2>
		<table class="noborder">
			<tbody>
			<?php $odd = TRUE;
			// Drainage
			if($pdrainage) echo '<tr class="pname"><td colspan="3"><b>Drainage</b></td></tr>'; 
			foreach($pdrainage as $drainage){ $odd = !$odd; ?>
			
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td colspan="3">
<?php echo $this->Html->link($drainage['Project']['CIPName'], '/projects/project/'.$drainage['Project']['CIPID'], array('escape' => false)); ?>
				</td>
			</tr>
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td><strong>Status:</strong><?php echo $drainage['Project']['Status']; ?></td><td>&nbsp;</td><td class="right"><?php if(isset($drainage['Project']['UpdateDate'][0])){ ?><strong>Updated:</strong> <?php echo date('F n, o', strtotime($drainage['Project']['UpdateDate'])); } ?></td>
			</tr>
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td colspan="3"><div class="comment more"><?php echo $drainage['Project']['Description']; ?></div></td>
			</tr>
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td colspan="3"><strong>Location:</strong> <?php echo $drainage['Project']['Location']; ?></td>
			</tr>
			
			<?php } ?>
			<?php // Facilities
			if($pfacilities) echo '<tr class="pname"><td colspan="3"><b>Facilities</b></td></tr>'; 
			foreach($pfacilities as $facility){ $odd = !$odd; ?>
			
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td colspan="3">
<?php echo $this->Html->link($facility['Project']['CIPName'], '/projects/project/'.$facility['Project']['CIPID'], array('escape' => false)); ?>
				</td>
			</tr>
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td><strong>Status:</strong><?php echo $facility['Project']['Status']; ?></td><td>&nbsp;</td><td class="right"><?php if(isset($facility['Project']['UpdateDate'][0])){ ?><strong>Updated:</strong> <?php echo date('F n, o', strtotime($facility['Project']['UpdateDate'])); } ?></td>
			</tr>
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td colspan="3"><div class="comment more"><?php echo $facility['Project']['Description']; ?></div></td>
			</tr>
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td colspan="3"><strong>Location:</strong> <?php echo $facility['Project']['Location']; ?></td>
			</tr>			
			
			<?php } ?>
			<?php // Miscelleanous
			if($pmiscellaneous) echo '<tr class="pname"><td colspan="3"><b>Miscellaneous</b></td></tr>';
			foreach($pmiscellaneous as $misc){ $odd = !$odd; ?>
			
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td colspan="3">
<?php echo $this->Html->link($misc['Project']['CIPName'], '/projects/project/'.$misc['Project']['CIPID'], array('escape' => false)); ?>
				</td>
			</tr>
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td><strong>Status:</strong><?php echo $misc['Project']['Status']; ?></td><td>&nbsp;</td><td class="right"><?php if(isset($misc['Project']['UpdateDate'][0])){ ?><strong>Updated:</strong> <?php echo date('F n, o', strtotime($misc['Project']['UpdateDate'])); } ?></td>
			</tr>
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td colspan="3"><div class="comment more"><?php echo $misc['Project']['Description']; ?></div></td>
			</tr>
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td colspan="3"><strong>Location:</strong> <?php echo $misc['Project']['Location']; ?></td>
			</tr>			
			
			<?php } ?>
			<?php // Signal
			if($psignal) echo '<tr class="pname"><td  colspan="3"><b>Signal</b></td></tr>'; 
			foreach($psignal as $signal){ $odd = !$odd;  ?>
			
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td colspan="3">
<?php echo $this->Html->link($signal['Project']['CIPName'], '/projects/project/'.$signal['Project']['CIPID'], array('escape' => false)); ?>
				</td>
			</tr>
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td><strong>Status:</strong><?php echo $signal['Project']['Status']; ?></td><td>&nbsp;</td><td class="right"><?php if(isset($signal['Project']['UpdateDate'][0])){ ?><strong>Updated:</strong> <?php echo date('F n, o', strtotime($signal['Project']['UpdateDate'])); } ?></td>
			</tr>
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td colspan="3"><div class="comment more"><?php echo $signal['Project']['Description']; ?></div></td>
			</tr>
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td colspan="3"><strong>Location:</strong> <?php echo $signal['Project']['Location']; ?></td>
			</tr>			
			
			<?php } ?>
			<?php // Transportation
			if($ptransportation) echo '<tr class="pname"><td colspan="3"><b>Transportation</b></td></tr>'; 
			foreach($ptransportation as $trans){ $odd = !$odd; ?>
			
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td colspan="3">
<?php echo $this->Html->link($trans['Project']['CIPName'], '/projects/project/'.$trans['Project']['CIPID'], array('escape' => false)); ?>
				</td>
			</tr>
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td><strong>Status:</strong><?php echo $trans['Project']['Status']; ?></td><td>&nbsp;</td><td class="right"><?php if(isset($trans['Project']['UpdateDate'][0])){ ?><strong>Updated:</strong> <?php echo date('F n, o', strtotime($trans['Project']['UpdateDate'])); } ?></td>
			</tr>
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td colspan="3"><div class="comment more"><?php echo $trans['Project']['Description']; ?></div></td>
			</tr>
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td colspan="3"><strong>Location:</strong> <?php echo $trans['Project']['Location']; ?></td>
			</tr>			
			
			<?php } ?>
			<?php // Wastewater
			if($pwastewater) echo '<tr class="pname"><td colspan="3"><b>Wastewater</b></td></tr>'; 
			foreach($pwastewater as $waste){ $odd = !$odd; ?>
			
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td colspan="3">
<?php echo $this->Html->link($waste['Project']['CIPName'], '/projects/project/'.$waste['Project']['CIPID'], array('escape' => false)); ?>
				</td>
			</tr>
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td><strong>Status:</strong><?php echo $waste['Project']['Status']; ?></td><td>&nbsp;</td><td class="right"><?php if(isset($waste['Project']['UpdateDate'][0])){ ?><strong>Updated:</strong> <?php echo date('F n, o', strtotime($waste['Project']['UpdateDate'])); } ?></td>
			</tr>
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td colspan="3"><div class="comment more"><?php echo $waste['Project']['Description']; ?></div></td>
			</tr>
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td colspan="3"><strong>Location:</strong> <?php echo $waste['Project']['Location']; ?></td>
			</tr>			
			
			<?php } ?>
			<?php // Water
			if($pwater) echo '<tr class="pname"><td colspan="3"><b>Water</b></td></tr>'; 
			foreach($pwater as $water){ $odd = !$odd; ?>
			
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td colspan="3">
<?php echo $this->Html->link($water['Project']['CIPName'], '/projects/project/'.$water['Project']['CIPID'], array('escape' => false)); ?>
				</td>
			</tr>
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td><strong>Status:</strong><?php echo $water['Project']['Status']; ?></td><td>&nbsp;</td><td class="right"><?php if(isset($water['Project']['UpdateDate'][0])){ ?><strong>Updated:</strong> <?php echo date('F n, o', strtotime($water['Project']['UpdateDate'])); } ?></td>
			</tr>
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td colspan="3"><div class="comment more"><?php echo $water['Project']['Description']; ?></div></td>
			</tr>
			<tr class="<?php echo $odd?'odd':'even'; ?>">
				<td colspan="3"><strong>Location:</strong> <?php echo $water['Project']['Location']; ?></td>
			</tr>			
			
			<?php } ?>
			</tbody>
		</table>
</div>
<script>
jQuery(document).ready(function() {
	var showChar = 100;
	var ellipsestext = "...";
	var moretext = "more";
	var lesstext = "less";
	jQuery('.more').each(function() {
		var content = jQuery(this).html();

		if(content.length > showChar) {

			var c = content.substr(0, showChar);
			var h = content.substr(showChar, content.length - showChar);

			var html = c + '<span class="moreelipses">'+ellipsestext+'</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">'+moretext+'</a></span>';

			jQuery(this).html(html);
		}

	});

	jQuery(".morelink").click(function(){
		if(jQuery(this).hasClass("less")) {
			jQuery(this).removeClass("less");
			jQuery(this).html(moretext);
		} else {
			jQuery(this).addClass("less");
			jQuery(this).html(lesstext);
		}
		jQuery(this).parent().prev().toggle();
		jQuery(this).prev().toggle();
		return false;
	});
});
</script>