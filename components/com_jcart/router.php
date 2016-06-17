<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2015 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
function JcartBuildRoute( &$query )
{
	$segments = array();
	if(isset($query['_route_']))
	{
		$segments_all=explode("/",$query['_route_']); 
		foreach($segments_all as $seg)
			$segments[]=$seg;    
		unset( $query['_route_'] );
	}
	return $segments;
}
function JcartParseRoute( $segments )
{
	$_route_=implode("/",$segments);
	$_route_=str_replace(":","-",$_route_);
	$vars = array();
	$vars['_route_']=$_route_;		
	return $vars;
}
?>