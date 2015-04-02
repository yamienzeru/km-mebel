<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<form id="search_form" class="morphsearch-form" action="<?=$arParams["PAGE"]?>">
	<div class="search_form_area">			
		<input type="input" name="q" value="<?=$_REQUEST["q"]?>" placeholder="" class="morphsearch-input">
		<input type="submit" class="search_btn morphsearch-submit" >
	</div>
</form>