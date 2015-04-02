<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult['SECTIONS'])):?>
<div class="categories">
	<div class="inner_wrap_title_sidebar">
		<div class="title_sidebar_section" >категории
			<!--<span class="big_arrow"></span>-->
		</div>
	</div>	
	<div class="sidebar_section wrap_sidebar_section">
		<div class="inner_wrap_sidebar">
			<ul class="category_list">
			<?foreach($arResult['SECTIONS'] as $arSection):?>
				<li<?if($arSection["ID"] == $arParams["CURRENT_SECTION"]):?> class="active"<?endif?>>
					<a href="<?=$arSection['SECTION_PAGE_URL']?>" class="category_link"><?=$arSection['NAME']?></a>
				</li>
			<?endforeach?>
			</ul>
		</div>
	</div>
</div>
<?endif?>