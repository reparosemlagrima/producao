<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');
?>
<div class="registration<?php echo $this->pageclass_sfx?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
		<div class="page-header">
			<h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
		</div>
	<?php endif; ?>
	
	<?php
		// Iterate through the form fieldsets and display each one.

		foreach ($this->form->getFieldsets() as $fieldset):
			$fields = $this->form->getFieldset($fieldset->name);
			
			if (count($fields)):
				// If the fieldset has a label set, display it as the legend.
				if(isset($fieldset->label)):
					echo "<h2>".JText::_($fieldset->label)."</h2>";
				endif;
			endif;
		endforeach;
	?>
	<form id="member-registration" action="<?php echo JRoute::_('index.php?option=com_users&task=registration.register'); ?>" method="post" class="form-validate form-horizontal well" enctype="multipart/form-data">
		<?php
			foreach ($this->form->getFieldsets() as $fieldset):
				$fields = $this->form->getFieldset($fieldset->name);

				if (count($fields)):
		?>
					<fieldset>
				
						<?php
							// Iterate through the fields in the set and display them.
							foreach ($fields as $field):
								// If the field is hidden, just display the input.
								if ($field->hidden):
									echo $field->input;
								else:
						?>
									<div class="control-group">
										<div class="control-label">
											<?php
												echo $field->label;
												if(!$field->required && $field->type != 'Spacer'):
											?>
													<span class="optional">
														<?php echo JText::_('COM_USERS_OPTIONAL');?>
													</span>
											<?php
												endif;
											?>
										</div>
										
										<div class="controls">
											<?php echo $field->input;?>
										</div>
									</div>
						<?php
								endif;
							endforeach;
						?>
					</fieldset>
		<?php
				endif;
			endforeach;
		?>
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn uk-button validate">
					<?php echo JText::_('JREGISTER');?>
				</button>
				<a class="btn uk-button uk-button-danger" href="<?php echo JRoute::_('');?>" title="<?php echo JText::_('JCANCEL');?>"><?php echo JText::_('JCANCEL');?></a>
				<input type="hidden" name="option" value="com_users" />
				<input type="hidden" name="task" value="registration.register" />
			</div>
		</div>
		<?php echo JHtml::_('form.token');?>
	</form>
</div>
