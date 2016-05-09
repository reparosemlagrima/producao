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
<ul class="kpost-profile">
	<?php
		$avatar = $this->profile->getAvatarImage('kavatar', 'post');
		if($avatar):
	?>
			<li class="kpost-avatar">
				<span class="kavatar"><?php echo $this->profile->getLink( $avatar ); ?></span>
			</li>
	<?php
		endif;
	?>
	<li class="kpost-username">
		<?php echo $this->profile->getLink(null, null, 'nofollow', '', null, $this->topic->getCategory()->id) ?>
	</li>
	<?php
		if($this->profile->exists()):
	?>

			<li>
				<span class="kicon-button kbuttononline-<?php echo $this->profile->isOnline('yes', 'no') ?>">
					<span class="online-<?php echo $this->profile->isOnline('yes', 'no') ?>">
						<span><?php echo $this->profile->isOnline(JText::_('COM_KUNENA_ONLINE'), JText::_('COM_KUNENA_OFFLINE')); ?></span>
					</span>
				</span>
			</li>

	<?php
		if(!empty($this->userranktitle)):
	?>
			<li class="kpost-userrank">
				<?php echo $this->escape($this->userranktitle) ?>
			</li>
	<?php
		endif;
	
		if($this->userposts):
	?>
			<li class="kpost-userposts"><?php echo JText::_('COM_KUNENA_POSTS') .' '. intval($this->userposts); ?></li>
	<?php
		endif;

		if($this->userthankyou):
	?>
			<li class="kpost-usertyr"><?php echo JText::_('COM_KUNENA_MYPROFILE_THANKYOU_RECEIVED') .' '. intval($this->userthankyou); ?></li>
	<?php
		endif;
	
		if($this->userpoints):
	?>
			<li class="kpost-userposts"><?php echo JText::_('COM_KUNENA_AUP_POINTS') .' '. intval($this->userpoints); ?></li>
	<?php
		endif;

		if($this->userkarma):
	?>
			<li class="kpost-karma">
				<span class="kmsgkarma">
					<?php echo $this->userkarma ?>
				</span>
			</li>
	<?php
		endif;

		if(!empty($this->personalText)):
	?>
			<li class="kpost-personal">
				<?php echo $this->personalText ?>
			</li>
	<?php
		endif;

		if(!empty($this->usermedals)):
	?>
			<li class="kpost-usermedals">
				<?php foreach ( $this->usermedals as $medal ) : ?>
					<?php echo $medal; ?>
				<?php endforeach ?>
			</li>
	<?php
		endif;
	endif;
	?>
</ul>
