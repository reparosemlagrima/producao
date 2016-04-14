<?php
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die;

?>
<ul class="uk-breadcrumb">
	<?php
		$url = $_SERVER["REQUEST_URI"];
		$pieces = explode("/", $url);
		$page_var = $pieces[2];
		$pieces2 = explode("?", $page_var);
		echo $page_var2 = $pieces2[0];

		if (!$params->get('showLast', 1))
		{
			array_pop($list);
		}

		$count = count($list);

		for ($i = 0; $i < $count; $i ++)
		{
			// clean subtitle from breadcrumb
			if ($pos = strpos($list[$i]->name, '||'))
			{
				$name = trim(substr($list[$i]->name, 0, $pos));
			}
			else
			{
				$name = $list[$i]->name;
			}
		
			// mark-up last item as strong
			if($i < $count-1)
			{

				if(!empty($list[$i]->link))
				{
					echo '<li><a href="'.$list[$i]->link.'">'.$name.'</a></li>';
				}
				else
				{
					echo '<li><span>'.$name.'</span></li>';
				}

				if($i == 0 && @$page_var2 == "forum-reparo"){
					echo '<li><a href="/reparosemlagrima/forum-reparo">Fórum</a></li>';
				}
			}
			else
			{
				echo '<li class="uk-active"><span>'.$name.'</span></li>';
			}
		}
	?>
</ul>