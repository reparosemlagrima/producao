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
<li class="item_lista_forum">
	<div class="titulo_categ_forum">
		<p>
			<?php
				echo ModuleKunenaLatest::shortenLink($this->getTopicLink($this->topic, 'last', null, ModuleKunenaLatest::setSubjectTitle($this, $this->topic->last_post_message)), 62);
			?>
		</p>
		<span>
			<?php
				$cat_explode = explode("</a>", $this->categoryLink);
				$cat_explode2 = explode("<a", $cat_explode[1]);
				$categ = "<a".$cat_explode2[1]."</a>";
				echo $categ;
			?>
		</span>
	</div>

	<div class="autor_tempo_forum">
		<p>
			<?php echo $this->lastPostAuthor->getLink($this->lastUserName); ?>
		</p>
		<p>
			<?php $override = $this->params->get('dateformat');
			echo KunenaDate::getInstance($this->topic->last_post_time)->toKunena($override ? $override : 'config_post_dateformat'); ?>
		</p>
	</div>

	<div class="foto_forum">
		<?php
			echo $this->lastPostAuthor->getLink($this->lastPostAuthor->getAvatarImage('', $this->params->get('avatarwidth'), $this->params->get('avatarheight')));
		?>
	</div>

	<div class="qtd_posts_forum">
		<?php $classe_answer = ($this->topic->getReplies() == 0) ? "no_answer" : "answer"; ?>
		<span class="<?php echo $classe_answer; ?>">
			<?php
				echo $this->topic->getReplies();
			?>
		</span>
	</div>

	<?php if(1 === 0): ?>
	<?php
		if($this->params->get('sh_topiciconoravatar') == 1):
	?>
			<div class="klatest-avatar">[ foto ]
				<?php
					echo $this->lastPostAuthor->getLink($this->lastPostAuthor->getAvatarImage('', $this->params->get('avatarwidth'), $this->params->get('avatarheight')));
				?>
			</div>
	<?php
		elseif($this->params->get('sh_topiciconoravatar') == 0):
	?>
			<div class="klatest-topicicon">
				<?php if($this->topic->unread): ?>
					<?php echo $this->getTopicLink($this->topic, 'unread', $this->topic->getIcon()) ?>
				<?php else: ?>
					<?php echo $this->getTopicLink($this->topic, null, $this->topic->getIcon()) ?>
				<?php endif; ?>
			</div>
	<?php
		endif;
	?>

		<p>
	<?php
			echo "[ titulo ] ".ModuleKunenaLatest::shortenLink($this->getTopicLink($this->topic, 'last', null, ModuleKunenaLatest::setSubjectTitle($this, $this->topic->last_post_message)), $this->params->get('titlelength'));

			if($this->params->get('sh_postcount'))
			{
				echo '[ qtd posts ] (' . $this->topic->getTotal() . ' ' . JText::_('MOD_KUNENALATEST_MSG') . ')';
			}

			if($this->topic->unread)
			{
				echo ' <span class="knewchar">' . JText::_($this->params->get('unreadindicator')) . '</span>';
			}

			if($this->params->get('sh_sticky') && $this->topic->ordering)
			{
				echo $this->getIcon('ktopicsticky', JText::_('MOD_KUNENALATEST_STICKY_TOPIC'));
			}

			if($this->params->get('sh_locked') && $this->topic->locked)
			{
				echo $this->getIcon('ktopiclocked', JText::_('COM_KUNENA_GEN_LOCKED_TOPIC'));
			}

			if($this->params->get('sh_favorite') && $this->topic->getUserTopic()->favorite)
			{
				echo $this->getIcon('kfavoritestar', JText::_('COM_KUNENA_FAVORITE'));
			}
			?>
		</p>

	<?php
		if($this->params->get('sh_firstcontentcharacter')):
	?>
			<div class="klatest-preview-content">
				<?php echo KunenaHtmlParser::stripBBCode($this->topic->last_post_message, $this->params->get('lengthcontentcharacters')); ?>
				<span class="link-read-more-forum"><?php echo $this->getTopicLink($this->topic, 'unread', 'leia mais'); ?></span>
			</div>
	<?php
		endif;

		if($this->params->get('sh_category')):
	?>
			<p class="klatest-cat"> [ categoria ]
				<?php echo JText::_('MOD_KUNENALATEST_IN_CATEGORY') . ' ' . $this->categoryLink ?>
			</p>
	<?php
		endif;

		if($this->params->get('sh_author')):
	?>
			<p class="klatest-author"> [ autor ]
				<?php echo JText::_('MOD_KUNENALATEST_LAST_POST_BY') . ' ' . $this->lastPostAuthor->getLink($this->lastUserName); ?>
			</p>
	<?php
		endif;

		if($this->params->get('sh_time')):
	?>
			<p class="klatest-posttime"> [ tempo ]
				<?php $override = $this->params->get('dateformat');
				echo KunenaDate::getInstance($this->topic->last_post_time)->toKunena($override ? $override : 'config_post_dateformat'); ?>
			</p>
	<?php
		endif;
	?>

	<?php endif; ?>
</li>
