<?php
/**
 * Kunena Component
 * @package Kunena.Template.Blue_Eagle
 * @subpackage Category
 *
 * @copyright (C) 2008 - 2015 Kunena Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.kunena.org
 **/
defined ( '_JEXEC' ) or die ();

$tabclass = array ("row1", "row2" );
$mmm=0;

foreach($this->sections as $section):
	$htmlClassBlockTable = !empty($section->class_sfx) ? ' kblocktable' . $this->escape($section->class_sfx) : '';
	$htmlClassTitleCover = !empty($section->class_sfx) ? ' ktitle-cover' . $this->escape($section->class_sfx) : '';
?>
<div class="nts-kblock kblock kcategories-<?php echo intval($section->id) ?>">
	<div class="kheader">
		<?php if (count($this->sections) > 0) : ?>
			<span class="ktoggler"><a class="ktoggler close" title="<?php echo JText::_('COM_KUNENA_TOGGLER_COLLAPSE') ?>" rel="catid_<?php echo intval($section->id) ?>"></a></span>
		<?php endif; ?>

		<h2><span><?php echo $this->GetCategoryLink($section, $this->escape($section->name)); ?></span></h2>

		<?php if (!empty($section->description)) : ?>
			<div class="ktitle-desc km hidden-phone">
				<p><?php echo KunenaHtmlParser::parseBBCode ( $section->description ); ?></p>
			</div>
		<?php endif; ?>
	</div>

	<div class="kcontainer" id="catid_<?php echo intval($section->id) ?>">
		<div class="kbody">
			<ul class="kblocktable<?php echo $htmlClassBlockTable ?>" id="kcat<?php echo intval($section->id) ?>">
				<?php
					if(empty($this->categories[$section->id])){
						echo JText::_('COM_KUNENA_GEN_NOFORUMS');
					}
					else{
						$k = 0;

						foreach($this->categories [$section->id] as $category){
							if($this->formatLargeNumber ( $category->getTopics() ) != 0):
				?>
								<li class="k<?php echo $tabclass [$k ^= 1], isset ( $category->class_sfx ) ? ' k' . $this->escape($tabclass [$k]) . $this->escape($category->class_sfx) : '' ?>" id="kcat<?php echo intval($category->id) ?>">
									<div class="kblock-inner <?php if (! empty ( $this->categories [$category->id] )) echo 'has-subcats' ?>">
										<div class="kcol-first kcol-category-icon">
											<?php if (!empty($category->icon)) : ?>
												<span class="kicon">
													<i class="<?php echo $category->icon;?>"></i>
												</span>
											<?php else : ?>
												<?php echo $this->getCategoryLink($category, $this->getCategoryIcon($category), ''); ?>
											<?php endif; ?>
										</div>
						
										<div class="kcol-mid kcol-kcattitle">
											<div class="kthead-title kl">
												<?php
													// Show new posts, locked, review
													echo $this->getCategoryLink($category);

													if ($category->getNewCount()) {
														echo '<sup class="knewchar">(' . $category->getNewCount() . ' ' . JText::_('COM_KUNENA_A_GEN_NEWCHAR') . ")</sup>";
													}
													if ($category->locked) {
														echo $this->getIcon ( 'kforumlocked', JText::_('COM_KUNENA_LOCKED_CATEGORY') );
													}
													if ($category->review) {
														echo $this->getIcon ( 'kforummoderated', JText::_('COM_KUNENA_GEN_MODERATED') );
													}
												?>
											</div>
			
											<?php if (!empty($category->description)) : ?>
												<div class="kthead-desc km hidden-phone">
													<?php echo KunenaHtmlParser::parseBBCode ($category->description) ?>
												</div>
											<?php endif; ?>

											<?php
												// Display subcategories
												if (! empty ( $this->categories [$category->id] )) :
											?>
													<div class="kthead-child" style="display: none;">
														<div class="kcc-table">
															<?php foreach ( $this->categories [$category->id] as $childforum ) : ?>
																<div class="kcc-subcat km">
																	<?php
																		echo $this->getCategoryIcon($childforum, true);
																		echo $this->getCategoryLink($childforum);
																		echo '<span class="kchildcount ks">(' . $childforum->getTopics() . "/" . $childforum->getReplies() . ')</span>';
																	?>
																</div>
															<?php endforeach; ?>
														</div>
													</div>
											<?php
												endif;
											?>
											<?php
												if(!empty($category->moderators)):
											?>
													<div class="kthead-moderators ks">
														<?php
															// get the Moderator list for display
															$modslist = array();
															foreach ( $category->moderators as $moderator ) {
																$modslist[] = KunenaFactory::getUser($moderator)->getLink();
															}
															echo JText::_('COM_KUNENA_MODERATORS') . ': ' . implode(', ', $modslist);
														?>
													</div>
											<?php
												endif;
											?>
											<?php if (! empty ( $this->pending [$category->id] )) : ?>
												<div class="ks kalert">
													<?php echo JHtml::_('kunenaforum.link', 'index.php?option=com_kunena&view=topics&layout=posts&mode=unapproved&userid=0&catid='.intval($category->id), intval($this->pending [$category->id]) . ' ' . JText::_('COM_KUNENA_SHOWCAT_PENDING'), '', '', 'nofollow'); ?>
												</div>
											<?php endif; ?>
										</div>
						
										<!-- Sub categories -->
										<?php
											// Display subcategories
											if (! empty ( $this->categories [$category->id] )) :
										?>
											<div class="sub-cats">
												<div class="kthead-child">
													<div class="kcc-table">
													<?php foreach ( $this->categories [$category->id] as $childforum ) : ?>

														<div class="kcc-subcat km">
														<?php
															echo $this->getCategoryIcon($childforum, true);
															echo $this->getCategoryLink($childforum);
															echo '<span class="kchildcount ks">(' . $childforum->getTopics() . "/" . $childforum->getReplies() . ')</span>';
														?>
														</div>
													<?php endforeach; ?>
													</div>
													<span class="arrow"></span>
												</div>
												<span class="sc"></span>
											</div>
										<?php endif; ?>
										<!-- // Sub categories -->
			
										<div class="forum-info">
											<div class="kcol-mid kcol-kcattopics hidden-phone">
												<span class="kcat-topics-number"><?php echo $this->formatLargeNumber ( $category->getTopics() ) ?></span>
												<span class="kcat-topics"><?php echo JText::_('COM_KUNENA_TOPICS');?></span>
											</div>
											
											<?php $class_answer = $this->formatLargeNumber($category->getReplies()) == 0 ? "no_answer" : "answer"; ?>
											<div class="kcol-mid kcol-kcatreplies hidden-phone <?php echo $class_answer;?>">
												<span class="kcat-replies-number"><?php echo $this->formatLargeNumber ( $category->getReplies() ) ?></span>
												<span class="kcat-replies"><?php echo JText::_('COM_KUNENA_GEN_REPLIES');?> </span>
											</div>
										</div>
			
										<?php $last = $category->getLastTopic();
										if ($last->exists()) { ?>
										<div class="kcol-mid kcol-kcatlastpost">
											<span class="arrow"></span>
										
											<div class="klatest-subject ks">
												<?php echo JText::_('COM_KUNENA_GEN_LAST_POST') . ':<br/>'. $this->getLastPostLink($category,null,null,null,150) ?>
											</div>
								
											<div class="klatest-subject-by ks hidden-phone">
											<?php
													echo $last->getLastPostAuthor()->getLink(null, null, 'nofollow', '', null, $category->id);
													echo '<span class="nowrap" title="' . KunenaDate::getInstance($last->last_post_time)->toKunena('config_post_dateformat_hover') . '">' . KunenaDate::getInstance($last->last_post_time)->toKunena('config_post_dateformat') . '</span>';
													?>
											</div>
											<?php if ($this->config->avataroncat > 0) : ?>
											<?php
												$profile = KunenaFactory::getUser((int)$last->last_post_userid);
												$useravatar = $profile->getAvatarImage('klist-avatar', 'list');
												if ($useravatar) : ?>
													<span class="klatest-avatar hidden-phone"> <?php echo $last->getLastPostAuthor()->getLink( $useravatar, null, 'nofollow', '', null, $category->id ); ?></span>
												<?php endif; ?>
											<?php endif; ?>
										</div>
										
										
							
										<?php } else { ?>
										<div class="kcol-mid kcol-knoposts"><?php echo JText::_('COM_KUNENA_NO_POSTS'); ?></div>
										<?php } ?>
									</div>
								</li>
				<?php
							endif;
						}
					}
				?>
			</ul>
		</div>
	</div>
</div>
<!-- Begin: Category Module Position -->
	<?php $this->displayModulePosition('kunena_section_' . ++$mmm) ?>
<!-- Finish: Category Module Position -->
<?php endforeach; ?>
