<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//delayed function must return a string
if(empty($arResult))
	return "";
	
$strReturn = '<div class="breadcumbs_block">';

$num_items = count($arResult);
for($index = 0, $itemSize = $num_items; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	
	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
		$strReturn .= '<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" class="breadcrumbs_link">'.$title.'</a>';
	else
		$strReturn .= '<span title="'.$title.'" class="breadcrumbs_active">'.$title.'</span>';
	
	if($index < $itemSize-1) $strReturn .= ' <span class="breadcumbs_separator">/</span> ';
}

$strReturn .= '</div>';

return $strReturn;
?>