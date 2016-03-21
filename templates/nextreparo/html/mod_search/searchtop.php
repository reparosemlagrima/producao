<?php
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// get application
$app = JFactory::getApplication();

// get item id
$itemid = intval($params->get('set_itemid', 0));

?>
<style type="text/css">
	.uk-box-search-top{
		width:400px;
		float: left;
		top: 18px;
	}
	.uk-field-search-top{ width: 90%; font-size: 12px !important; text-align: left; padding: 10px !important; line-height: 15px !important; height: 15px !important}
	.uk-button-top{ bottom: 6px}
	/* .uk-button-top{ position: relative; left:175px; bottom : 23px} */

/* Tablet and bigger */
@media (min-width: 768px) {
  .uk-box-search-top{
	  /* margin: auto; */
	  position: relative;

	  /* aa  */
  }
 
}
/* Desktop and bigger */
@media (min-width: 960px) {
  
 
}
/* Large screen and bigger */
@media (min-width: 1220px) {

  
}
@media (max-width: 480px) {
 

}


</style>


<div class="uk-box-search-top  uk-container-center uk-width-large-2-3 uk-width-medium-1-2"  data-uk-margin>
	<form id="search-<?php echo $module->id; ?>" class="uk-search-top" action="<?php echo JRoute::_('index.php'); ?>" method="post" role="search" <?php if($module->position !== 'offcanvas'):?>data-uk-search="{'source': '<?php echo JRoute::_("index.php?option=com_search&tmpl=raw&type=json&ordering=&searchphrase=all");?>', 'param': 'searchword', 'msgResultsHeader': '<?php echo JText::_("TPL_WARP_SEARCH_RESULTS"); ?>', 'msgMoreResults': '<?php echo JText::_("TPL_WARP_SEARCH_MORE"); ?>', 'msgNoResults': '<?php echo JText::_("TPL_WARP_SEARCH_NO_RESULTS"); ?>', flipDropdown: 1}"<?php endif;?>>
		<input class="uk-field-search-top" type="search" name="searchword" placeholder="<?php echo JText::_('TPL_WARP_SEARCH'); ?>">
		<span class="uk-button uk-button-top uk-button"><i class="uk-icon-search"></i></span>
		<input type="hidden" name="task" value="search">
		<input type="hidden" name="option" value="com_search">
		<input type="hidden" name="Itemid" value="<?php echo $itemid > 0 ? $itemid : $app->input->getInt('Itemid'); ?>">
	</form>
</div>