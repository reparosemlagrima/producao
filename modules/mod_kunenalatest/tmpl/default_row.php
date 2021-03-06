<?php
/**
 * Kunena Latest Module
 *
 * @package       Kunena.mod_kunenalatest
 *
 * @copyright (C) 2008 - 2015 Kunena Team. All rights reserved.
 * @license       http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link          http://www.kunena.org
 **/
defined('_JEXEC') or die ();
?>
<div class="uk-width-large-1-3 uk-width-medium-1-2">
	
		<?php
		if ($this->params->get('sh_topiciconoravatar') == 1) : ?>
			<div class="klatest-avatar">
				<?php echo $this->lastPostAuthor->getLink($this->lastPostAuthor->getAvatarImage('', $this->params->get('avatarwidth'), $this->params->get('avatarheight'))) ?>
			</div>
		<?php elseif ($this->params->get('sh_topiciconoravatar') == 0) : ?>
			<div class="klatest-topicicon">
				<?php if ($this->topic->unread) : ?>
					<?php echo $this->getTopicLink($this->topic, 'unread', $this->topic->getIcon()) ?>
				<?php else : ?>
					<?php echo $this->getTopicLink($this->topic, null, $this->topic->getIcon()) ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<h3>
			<?php
			echo ModuleKunenaLatest::shortenLink($this->getTopicLink($this->topic, 'last', null, ModuleKunenaLatest::setSubjectTitle($this, $this->topic->last_post_message)), $this->params->get('titlelength'));

			if ($this->params->get('sh_postcount'))
			{
				echo ' (' . $this->topic->getTotal() . ' ' . JText::_('MOD_KUNENALATEST_MSG') . ')';
			}

			if ($this->topic->unread)
			{
				echo ' <span class="knewchar">' . JText::_($this->params->get('unreadindicator')) . '</span>';
			}

			if ($this->params->get('sh_sticky') && $this->topic->ordering)
			{
				echo $this->getIcon('ktopicsticky', JText::_('MOD_KUNENALATEST_STICKY_TOPIC'));
			}

			if ($this->params->get('sh_locked') && $this->topic->locked)
			{
				echo $this->getIcon('ktopiclocked', JText::_('COM_KUNENA_GEN_LOCKED_TOPIC'));
			}

			if ($this->params->get('sh_favorite') && $this->topic->getUserTopic()->favorite)
			{
				echo $this->getIcon('kfavoritestar', JText::_('COM_KUNENA_FAVORITE'));
			}
			?>
		</h3>

		<?php if ($this->params->get('sh_firstcontentcharacter')) : ?>
			<div class="klatest-preview-content">
				<?php echo KunenaHtmlParser::stripBBCode($this->topic->last_post_message, $this->params->get('lengthcontentcharacters')); ?>
				<span class="link-read-more-forum"><?php echo $this->getTopicLink($this->topic, 'unread', 'leia mais'); ?></span>
			</div>
		<?php endif; ?>

		<?php if ($this->params->get('sh_category')) : ?>
			<li class="klatest-cat">
				<?php echo JText::_('MOD_KUNENALATEST_IN_CATEGORY') . ' ' . $this->categoryLink ?>
			</li>
		<?php endif; ?>

		<?php if ($this->params->get('sh_author')) : ?>
			<li class="klatest-author">
				<?php echo JText::_('MOD_KUNENALATEST_LAST_POST_BY') . ' ' . $this->lastPostAuthor->getLink($this->lastUserName); ?>
			</li>
		<?php endif; ?>

		<?php if ($this->params->get('sh_time')) : ?>
			<li class="klatest-posttime">
				<?php $override = $this->params->get('dateformat');
				echo KunenaDate::getInstance($this->topic->last_post_time)->toKunena($override ? $override : 'config_post_dateformat'); ?>
			</li>
		<?php endif; ?>
</div>
