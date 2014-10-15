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
					echo $this->Html->link($title, '#', array('escape' => false));
					?>
				</li>
            </ul>
        </div>
        <div class="clear"></div>
        <div class="maintable">
            <div class="box round first grid">
                <h2>Updated Projects</h2>
                <div class="block">   				
                <table class="data display datatable" id="example">
					<tbody>
					<?php $rows = 0; foreach($projects as $project){ $rows++; ?>
						<tr class="gradeX">
							<td><?php echo $project['PwcipP']['CIPNumber']; ?></td>
							<td>
							<?php 
							echo $this->Html->link($project['PwcipP']['CIPName'],
							array('controller' => 'projects', 'action' => 'approve', $project['PwcipP']['CIPID']));
							if($project['PwcipP']['ProjectDeleted'] != 0){
								echo '<span class="alert"> - Deleted</span>';
							} else {
								echo ($project['count'] == 0) ? '<span class="alert"> - New</span>' : '<span class="alert"> - Updated</span>';
							}
							?>
							</td>
						</tr>	
					<?php } if($rows == 0){ ?> <tr><td colspan="2" class="dataTables_empty">There are no updated projects</td></tr><?php } ?>
					</tbody>
				</table>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div id="site_info">
        <p><?php echo str_replace('-',' ',ucwords(APP_DIR)); ?></p>
    </div>