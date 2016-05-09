<?php
/**
 * Kunena Component
 * @package Kunena.Template.Blue_Eagle
 * @subpackage Topic
 *
 * @copyright (C) 2008 - 2015 Kunena Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.kunena.org
 **/
defined ( '_JEXEC' ) or die ();
?>
<div class="kmsg-header kmsg-header-left">
	
</div>
<table class="<?php echo $this->class ?>">
	<tbody>
		<tr>
			<td rowspan="2" class="kprofile-left">
				<?php $this->displayMessageProfile('vertical') ?>
			</td>
			<td class="kmessage-left">
				<h2>
					<?php echo $this->displayMessageField('subject') ?>
					<span class="kmsgdate" title="">
						<?php echo substr(KunenaDate::getInstance($this->message->time)->toKunena('config_post_dateformat_hover'),0,-6); ?>
					</span>
				</h2>
				<?php $this->displayMessageContents() ?>
			</td>
		</tr>
		<tr>
			<td class="kbuttonbar-left">
				<?php $this->displayMessageActions() ?>
			</td>
		</tr>
	</tbody>
</table>

<!-- Begin: Message Module Position -->
<?php $this->displayModulePosition('kunena_msg_' . $this->mmm) ?>
<!-- Finish: Message Module Position -->
