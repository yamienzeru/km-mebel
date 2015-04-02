<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/colors.css',
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
);
?>
<?/*<div class="bx_filter <?=$templateData["TEMPLATE_CLASS"]?> <?if ($arParams["FILTER_VIEW_MODE"] == "horizontal"):?>bx_horizontal<?endif?>">
	<div class="bx_filter_section">
		<div class="bx_filter_title"><?echo GetMessage("CT_BCSF_FILTER_TITLE")?></div>*/?>
		<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="bx_filter">
			<div class="inner_wrap_title_sidebar">
				<div class="title_sidebar_section">фильтр
			<!--<span class="big_arrow"></span>-->
				</div>
			</div>
			<div class="sidebar_section sidebar_section_filter wrap_sidebar_section">
				<div class="inner_wrap_sidebar">	
					<input class="filter_btn filter_btn_show" type="submit" id="set_filter" name="set_filter" value="Применить фильтр" />
					<input class="filter_btn filter_btn_hide" type="submit" id="del_filter" name="del_filter" value="Сбросить" />

					<div class="bx_filter_popup_result <?=$arParams["POPUP_POSITION"]?>" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?> style="display: inline-block;">
						<?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
						<span class="arrow"></span>
						<a href="<?echo $arResult["FILTER_URL"]?>"><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
					</div>
				</div>
			<?foreach($arResult["HIDDEN"] as $arItem):?>
			<input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
			<?endforeach;
			//prices
			foreach($arResult["ITEMS"] as $key=>$arItem)
			{
				$key = $arItem["ENCODED_ID"];
				if(isset($arItem["PRICE"])):
					if (!$arItem["VALUES"]["MIN"]["VALUE"] || !$arItem["VALUES"]["MAX"]["VALUE"] || $arItem["VALUES"]["MIN"]["VALUE"] == $arItem["VALUES"]["MAX"]["VALUE"])
						continue;
					?>
					<hr class="filter_separator">
					<div class="inner_wrap_sidebar">
						<span class="bx_filter_container_modef"></span>	
						<span class="filter_container_title" onclick="smartFilter.hideFilterProps(this)">Цена</span>
						<div class="bx_filter_block">
							<div class="filter_container price">						
								<div class="filter_param_area">
									<div class="filter_param_block">
										<div class="input_container">
											<input
												class="min-price min_price_box price_box"
												type="text"
												name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
												id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
												value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
												size="5"
												onkeyup="smartFilter.keyup(this)"
											/>
										</div>
									</div>
									<div class="filter_param_block">
										<div class="input_container">
											<input
												class="max-price max_price_box price_box"
												type="text"
												name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
												id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
												value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
												size="5"
												onkeyup="smartFilter.keyup(this)"
											/>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="slider_track" id="drag_track_<?=$key?>">
									<div class="pricebar bx_ui_slider_pricebar_VD" id="colorUnavailableActive_<?=$key?>"></div>
									<div class="pricebar bx_ui_slider_pricebar_VN" id="colorAvailableInactive_<?=$key?>"></div>
									<div class="pricebar bx_ui_slider_pricebar_V" id="colorAvailableActive_<?=$key?>"></div>
									<div class="slider_range" id="drag_tracker_<?=$key?>">
										<a class="slider_handle slider_handle_left" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
										<a class="slider_handle slider_handle_right" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?/*<div class="bx_filter_parameters_box active">
						<span class="bx_filter_container_modef"></span>
						<div class="bx_filter_parameters_box_title" onclick="smartFilter.hideFilterProps(this)"><?=$arItem["NAME"]?></div>
						<div class="bx_filter_block">
							<div class="bx_filter_parameters_box_container">
								<div class="bx_filter_parameters_box_container_block">
									<div class="bx_filter_input_container">
										<input
											class="min-price"
											type="text"
											name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
											id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
											value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
											size="5"
											onkeyup="smartFilter.keyup(this)"
										/>
									</div>
								</div>
								<div class="bx_filter_parameters_box_container_block">
									<div class="bx_filter_input_container">
										<input
											class="max-price"
											type="text"
											name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
											id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
											value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
											size="5"
											onkeyup="smartFilter.keyup(this)"
										/>
									</div>
								</div>
								<div style="clear: both;"></div>

								<div class="bx_ui_slider_track" id="drag_track_<?=$key?>">
									<?
									$price1 = $arItem["VALUES"]["MIN"]["VALUE"];
									$price2 = $arItem["VALUES"]["MIN"]["VALUE"] + round(($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"])/4);
									$price3 = $arItem["VALUES"]["MIN"]["VALUE"] + round(($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"])/2);
									$price4 = $arItem["VALUES"]["MIN"]["VALUE"] + round((($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"])*3)/4);
									$price5 = $arItem["VALUES"]["MAX"]["VALUE"];
									?>
									<div class="bx_ui_slider_part p1"><span><?=$price1?></span></div>
									<div class="bx_ui_slider_part p2"><span><?=$price2?></span></div>
									<div class="bx_ui_slider_part p3"><span><?=$price3?></span></div>
									<div class="bx_ui_slider_part p4"><span><?=$price4?></span></div>
									<div class="bx_ui_slider_part p5"><span><?=$price5?></span></div>

									<div class="bx_ui_slider_pricebar_VD" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
									<div class="bx_ui_slider_pricebar_VN" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
									<div class="bx_ui_slider_pricebar_V"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
									<div class="bx_ui_slider_range" id="drag_tracker_<?=$key?>"  style="left: 0%; right: 0%;">
										<a class="bx_ui_slider_handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
										<a class="bx_ui_slider_handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
									</div>
								</div>
								<div style="opacity: 0;height: 1px;"></div>
							</div>
						</div>
					</div>*/?>
					<?
					$presicion = 2;
					if (Bitrix\Main\Loader::includeModule("currency"))
					{
						$res = CCurrencyLang::GetFormatDescription($arItem["VALUES"]["MIN"]["CURRENCY"]);
						$presicion = $res['DECIMALS'];
					}
					$arJsParams = array(
						"leftSlider" => 'left_slider_'.$key,
						"rightSlider" => 'right_slider_'.$key,
						"tracker" => "drag_tracker_".$key,
						"trackerWrap" => "drag_track_".$key,
						"minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
						"maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
						"minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
						"maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
						"curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
						"curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
						"fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
						"fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
						"precision" => $presicion,
						"colorUnavailableActive" => 'colorUnavailableActive_'.$key,
						"colorAvailableActive" => 'colorAvailableActive_'.$key,
						"colorAvailableInactive" => 'colorAvailableInactive_'.$key,
					);
					?>
					<script type="text/javascript">
						BX.ready(function(){
							window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
						});
					</script>
				<?endif;
			}

			//not prices
			foreach($arResult["ITEMS"] as $key=>$arItem)
			{
				if(
					empty($arItem["VALUES"])
					|| isset($arItem["PRICE"])
				)
					continue;

				if (
					$arItem["DISPLAY_TYPE"] == "A"
					&& (
						!$arItem["VALUES"]["MIN"]["VALUE"]
						|| !$arItem["VALUES"]["MAX"]["VALUE"]
						|| $arItem["VALUES"]["MIN"]["VALUE"] == $arItem["VALUES"]["MAX"]["VALUE"]
					)
				)
					continue;
				?>
				<hr class="filter_separator">
				<div class="inner_wrap_sidebar<?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?> inner_wrap_sidebar_black<?endif?><?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?> active<?endif?>">
					<span class="bx_filter_container_modef"></span>
					<span class="filter_container_title<?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?> filter_container_title_white<?endif?>" onclick="smartFilter.hideFilterProps(this)"><?=$arItem["NAME"]?></span>
					<div class="bx_filter_block">					
				<?/*<div class="bx_filter_parameters_box <?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?>active<?endif?>">
					<span class="bx_filter_container_modef"></span>
					<div class="bx_filter_parameters_box_title" onclick="smartFilter.hideFilterProps(this)"><?=$arItem["NAME"]?></div>
					<div class="bx_filter_block">
						<div class="bx_filter_parameters_box_container">*/?>
						<?
						$arCur = current($arItem["VALUES"]);
						switch ($arItem["DISPLAY_TYPE"])
						{
							case "A"://NUMBERS_WITH_SLIDER
								?>
								<div class="bx_filter_parameters_box_container_block">
									<div class="bx_filter_input_container">
										<input
											class="min-price"
											type="text"
											name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
											id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
											value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
											size="5"
											onkeyup="smartFilter.keyup(this)"
										/>
									</div>
								</div>
								<div class="bx_filter_parameters_box_container_block">
									<div class="bx_filter_input_container">
										<input
											class="max-price"
											type="text"
											name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
											id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
											value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
											size="5"
											onkeyup="smartFilter.keyup(this)"
											/>
									</div>
								</div>
								<div style="clear: both;"></div>

								<div class="bx_ui_slider_track" id="drag_track_<?=$key?>">
									<?
									$value1 = $arItem["VALUES"]["MIN"]["VALUE"];
									$value2 = $arItem["VALUES"]["MIN"]["VALUE"] + round(($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"])/4);
									$value3 = $arItem["VALUES"]["MIN"]["VALUE"] + round(($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"])/2);
									$value4 = $arItem["VALUES"]["MIN"]["VALUE"] + round((($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"])*3)/4);
									$value5 = $arItem["VALUES"]["MAX"]["VALUE"];
									?>
									<div class="bx_ui_slider_part p1"><span><?=$value1?></span></div>
									<div class="bx_ui_slider_part p2"><span><?=$value2?></span></div>
									<div class="bx_ui_slider_part p3"><span><?=$value3?></span></div>
									<div class="bx_ui_slider_part p4"><span><?=$value4?></span></div>
									<div class="bx_ui_slider_part p5"><span><?=$value5?></span></div>

									<div class="bx_ui_slider_pricebar_VD" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
									<div class="bx_ui_slider_pricebar_VN" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
									<div class="bx_ui_slider_pricebar_V"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
									<div class="bx_ui_slider_range" 	id="drag_tracker_<?=$key?>"  style="left: 0;right: 0;">
										<a class="bx_ui_slider_handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
										<a class="bx_ui_slider_handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
									</div>
								</div>
								<?
								$arJsParams = array(
									"leftSlider" => 'left_slider_'.$key,
									"rightSlider" => 'right_slider_'.$key,
									"tracker" => "drag_tracker_".$key,
									"trackerWrap" => "drag_track_".$key,
									"minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
									"maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
									"minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
									"maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
									"curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
									"curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
									"fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
									"fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
									"precision" => 0,
									"colorUnavailableActive" => 'colorUnavailableActive_'.$key,
									"colorAvailableActive" => 'colorAvailableActive_'.$key,
									"colorAvailableInactive" => 'colorAvailableInactive_'.$key,
								);
								?>
								<script type="text/javascript">
									BX.ready(function(){
										window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
									});
								</script>
								<?
								break;
							case "B"://NUMBERS
								?>
								<div class="bx_filter_parameters_box_container_block"><div class="bx_filter_input_container">
									<input
										class="min-price"
										type="text"
										name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
										id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
										value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
										size="5"
										onkeyup="smartFilter.keyup(this)"
										/>
								</div></div>
								<div class="bx_filter_parameters_box_container_block"><div class="bx_filter_input_container">
									<input
										class="max-price"
										type="text"
										name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
										id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
										value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
										size="5"
										onkeyup="smartFilter.keyup(this)"
										/>
								</div></div>
								<?
								break;
							case "G"://CHECKBOXES_WITH_PICTURES
								?>
								<?foreach ($arItem["VALUES"] as $val => $ar):?>
									<input
										style="display: none"
										type="checkbox"
										name="<?=$ar["CONTROL_NAME"]?>"
										id="<?=$ar["CONTROL_ID"]?>"
										value="<?=$ar["HTML_VALUE"]?>"
										<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
									/>
									<?
									$class = "";
									if ($ar["CHECKED"])
										$class.= " active";
									if ($ar["DISABLED"])
										$class.= " disabled";
									?>
									<label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label dib<?=$class?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'active');">
										<span class="bx_filter_param_btn bx_color_sl">
											<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
											<span class="bx_filter_btn_color_icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
											<?endif?>
										</span>
									</label>
								<?endforeach?>
								<?
								break;
							case "H"://CHECKBOXES_WITH_PICTURES_AND_LABELS
								?>
								<?foreach ($arItem["VALUES"] as $val => $ar):?>
									<input
										style="display: none"
										type="checkbox"
										name="<?=$ar["CONTROL_NAME"]?>"
										id="<?=$ar["CONTROL_ID"]?>"
										value="<?=$ar["HTML_VALUE"]?>"
										<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
									/>
									<?
									$class = "";
									if ($ar["CHECKED"])
										$class.= " active";
									if ($ar["DISABLED"])
										$class.= " disabled";
									?>
									<label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label<?=$class?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'active');">
										<span class="bx_filter_param_btn bx_color_sl">
											<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
												<span class="bx_filter_btn_color_icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
											<?endif?>
										</span>
										<span class="bx_filter_param_text">
											<?=$ar["VALUE"]?>
										</span>
									</label>
								<?endforeach?>
								<?
								break;
							case "P"://DROPDOWN
								$checkedItemExist = false;
								?>
								<div class="bx_filter_select_container">
									<div class="bx_filter_select_block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
										<div class="bx_filter_select_text" data-role="currentOption">
											<?
											foreach ($arItem["VALUES"] as $val => $ar)
											{
												if ($ar["CHECKED"])
												{
													echo $ar["VALUE"];
													$checkedItemExist = true;
												}
											}
											if (!$checkedItemExist)
											{
												echo GetMessage("CT_BCSF_FILTER_ALL");
											}
											?>
										</div>
										<div class="bx_filter_select_arrow"></div>
										<input
											style="display: none"
											type="radio"
											name="<?=$arCur["CONTROL_NAME_ALT"]?>"
											id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
											value=""
										/>
										<?foreach ($arItem["VALUES"] as $val => $ar):?>
											<input
												style="display: none"
												type="radio"
												name="<?=$ar["CONTROL_NAME_ALT"]?>"
												id="<?=$ar["CONTROL_ID"]?>"
												value="<? echo $ar["HTML_VALUE_ALT"] ?>"
												<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
											/>
										<?endforeach?>
										<div class="bx_filter_select_popup" data-role="dropdownContent" style="display: none;">
											<ul>
												<li>
													<label for="<?="all_".$arCur["CONTROL_ID"]?>" class="bx_filter_param_label" data-role="label_<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
														<? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
													</label>
												</li>
											<?
											foreach ($arItem["VALUES"] as $val => $ar):
												$class = "";
												if ($ar["CHECKED"])
													$class.= " selected";
												if ($ar["DISABLED"])
													$class.= " disabled";
											?>
												<li>
													<label for="<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label<?=$class?>" data-role="label_<?=$ar["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')"><?=$ar["VALUE"]?></label>
												</li>
											<?endforeach?>
											</ul>
										</div>
									</div>
								</div>
								<?
								break;
							case "R"://DROPDOWN_WITH_PICTURES_AND_LABELS
								?>
								<div class="bx_filter_select_container">
									<div class="bx_filter_select_block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
										<div class="bx_filter_select_text" data-role="currentOption">
											<?
											$checkedItemExist = false;
											foreach ($arItem["VALUES"] as $val => $ar):
												if ($ar["CHECKED"])
												{
												?>
													<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
														<span class="bx_filter_btn_color_icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
													<?endif?>
													<span class="bx_filter_param_text">
														<?=$ar["VALUE"]?>
													</span>
												<?
													$checkedItemExist = true;
												}
											endforeach;
											if (!$checkedItemExist)
											{
												?><span class="bx_filter_btn_color_icon all"></span> <?
												echo GetMessage("CT_BCSF_FILTER_ALL");
											}
											?>
										</div>
										<div class="bx_filter_select_arrow"></div>
										<input
											style="display: none"
											type="radio"
											name="<?=$arCur["CONTROL_NAME_ALT"]?>"
											id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
											value=""
										/>
										<?foreach ($arItem["VALUES"] as $val => $ar):?>
											<input
												style="display: none"
												type="radio"
												name="<?=$ar["CONTROL_NAME_ALT"]?>"
												id="<?=$ar["CONTROL_ID"]?>"
												value="<?=$ar["HTML_VALUE_ALT"]?>"
												<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
											/>
										<?endforeach?>
										<div class="bx_filter_select_popup" data-role="dropdownContent" style="display: none">
											<ul>
												<li style="border-bottom: 1px solid #e5e5e5;padding-bottom: 5px;margin-bottom: 5px;">
													<label for="<?="all_".$arCur["CONTROL_ID"]?>" class="bx_filter_param_label" data-role="label_<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
														<span class="bx_filter_btn_color_icon all"></span>
														<? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
													</label>
												</li>
											<?
											foreach ($arItem["VALUES"] as $val => $ar):
												$class = "";
												if ($ar["CHECKED"])
													$class.= " selected";
												if ($ar["DISABLED"])
													$class.= " disabled";
											?>
												<li>
													<label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label<?=$class?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')">
														<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
															<span class="bx_filter_btn_color_icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
														<?endif?>
														<span class="bx_filter_param_text">
															<?=$ar["VALUE"]?>
														</span>
													</label>
												</li>
											<?endforeach?>
											</ul>
										</div>
									</div>
								</div>
								<?
								break;
							case "K"://RADIO_BUTTONS
								?>
								<label class="bx_filter_param_label" for="<? echo "all_".$arCur["CONTROL_ID"] ?>">
									<span class="bx_filter_input_checkbox">
										<input
											type="radio"
											value=""
											name="<? echo $arCur["CONTROL_NAME_ALT"] ?>"
											id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
											onclick="smartFilter.click(this)"
										/>
										<span class="bx_filter_param_text"><? echo GetMessage("CT_BCSF_FILTER_ALL"); ?></span>
									</span>
								</label>
								<?foreach($arItem["VALUES"] as $val => $ar):?>
									<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label" for="<? echo $ar["CONTROL_ID"] ?>">
										<span class="bx_filter_input_checkbox <? echo $ar["DISABLED"] ? 'disabled': '' ?>">
											<input
												type="radio"
												value="<? echo $ar["HTML_VALUE_ALT"] ?>"
												name="<? echo $ar["CONTROL_NAME_ALT"] ?>"
												id="<? echo $ar["CONTROL_ID"] ?>"
												<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
												onclick="smartFilter.click(this)"
											/>
											<span class="bx_filter_param_text"><? echo $ar["VALUE"]; ?></span>
										</span>
									</label>
								<?endforeach;?>
								<?
								break;
							default://CHECKBOXES
								?>
								<div class="filter_parameters_container">						
								<?foreach($arItem["VALUES"] as $val => $ar):?>
									<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="filter_param_label <? echo $ar["DISABLED"] ? 'disabled': '' ?>" for="<? echo $ar["CONTROL_ID"] ?>">
										<span class="filter_input_checkbox">
											<input
												type="checkbox"
												value="<? echo $ar["HTML_VALUE"] ?>"
												name="<? echo $ar["CONTROL_NAME"] ?>"
												id="<? echo $ar["CONTROL_ID"] ?>"
												<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
												onclick="smartFilter.click(this)"
											/>
											<span class="filter_param_text"><? echo $ar["VALUE"]; ?></span>
										</span>
									</label>
								<?endforeach;?>
								</div>
						<?
						}
						?>
						<?/*</div>
						<div class="clb"></div>
					</div>
				</div>*/?>
					</div>					
				</div>
			<?
			}
			?>
			</div>
			<?/*<div class="clb"></div>
			<div class="bx_filter_button_box active">
				<div class="bx_filter_block">
					<div class="bx_filter_parameters_box_container">
						<input class="bx_filter_search_button" type="submit" id="set_filter" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>" />
						<input class="bx_filter_search_reset" type="submit" id="del_filter" name="del_filter" value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>" />

						<div class="bx_filter_popup_result <?=$arParams["POPUP_POSITION"]?>" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?> style="display: inline-block;">
							<?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
							<span class="arrow"></span>
							<a href="<?echo $arResult["FILTER_URL"]?>"><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
						</div>
					</div>
				</div>
			</div>*/?>
		</form>
		<?/*<div style="clear: both;"></div>
	</div>
</div>*/?>
<?/*<form name="filter_form" >
				<div class="inner_wrap_title_sidebar">
					<div class="title_sidebar_section">фильтр
				<!--<span class="big_arrow"></span>-->
					</div>
				</div>
				<div class="sidebar_section sidebar_section_filter wrap_sidebar_section">
					<div class="inner_wrap_sidebar">	
						<input class="filter_btn filter_btn_show" type="submit"  name="set_filter" value="Применить фильтр">
						<input class="filter_btn filter_btn_hide" type="submit"  name="del_filter" value="Сбросить">
					</div>	
					<hr class="filter_separator">
					<div class="inner_wrap_sidebar">	
						<span class="filter_container_title" onclick="smartFilter.hideFilterProps(this)">Цена</span>
						<div class="bx_filter_block">
							<div class="filter_container price">						
								<div class="filter_param_area">
									<div class="filter_param_block">
										<div class="input_container">
											<input class="min_price_box price_box" type="text" name="arrFilter_P1_MIN" id="arrFilter_P1_MIN" value="" size="5" onkeyup="smartFilter.keyup(this)"/>
										</div>
									</div>
									<div class="filter_param_block">
										<div class="input_container">
											<input class="max_price_box price_box" type="text" name="arrFilter_P1_MAX" id="arrFilter_P1_MAX" value="" size="5" onkeyup="smartFilter.keyup(this)"/>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="slider_track">
									<div class="pricebar bx_ui_slider_pricebar_VD"></div>
									<div class="pricebar bx_ui_slider_pricebar_VN"></div>
									<div class="pricebar bx_ui_slider_pricebar_V" ></div>
									<div class="slider_range">
										<a class="slider_handle slider_handle_left" ></a>
										<a class="slider_handle slider_handle_right"></a>
									</div>
								</div>
							</div>
						</div>
					</div>	
			<!--<script type="text/javascript">
					BX.ready(function(){
						var trackBare7b1a5c82772e0e055096008cb9883ef = new BX.Iblock.SmartFilter.Horizontal({'leftSlider':'left_slider_e7b1a5c82772e0e055096008cb9883ef','rightSlider':'right_slider_e7b1a5c82772e0e055096008cb9883ef','tracker':'drag_tracker_e7b1a5c82772e0e055096008cb9883ef','trackerWrap':'drag_track_e7b1a5c82772e0e055096008cb9883ef','minInputId':'arrFilter_P1_MIN','maxInputId':'arrFilter_P1_MAX','minPrice':'749.00','maxPrice':'849.00','curMinPrice':'','curMaxPrice':'','precision':'2'});
					});
			</script>-->
					<div class="inner_wrap_sidebar inner_wrap_sidebar_black">
						<span class="filter_container_title  filter_container_title_white" onclick="smartFilter.hideFilterProps(this)">Статус</span>
						<div class="bx_filter_block">
							<div class="filter_parameters_container">
								<label data-role="label_param1_1" class="filter_param_label " for="param1_1">
									<span class="filter_input_checkbox">
										<input type="checkbox" name="param1_1" id="param1_1" >
										<span class="filter_param_text">Акции</span>
									</span>
								</label>	
								<label data-role="label_param1_2" class="filter_param_label " for="param1_2">
									<span class="filter_input_checkbox">
										<input type="checkbox" name="param1_2" id="param1_2" >
										<span class="filter_param_text">Хиты</span>
									</span>
								</label>
								<label data-role="label_param1_3" class="filter_param_label " for="param1_3">
									<span class="filter_input_checkbox">
										<input type="checkbox" name="param1_3" id="param1_3" >
										<span class="filter_param_text">Новинки</span>
									</span>
								</label>							
							</div>						
						</div>					
					</div>
					<div class="inner_wrap_sidebar">
						<span class="filter_container_title" onclick="smartFilter.hideFilterProps(this)">Стили</span>
						<!--<div class="bx_filter_block" onclick="smartFilter.hideFilterProps(this)">
							<div class="filter_parameters_container">
								<label data-role="label_param2_1" class="filter_param_label " for="param2_1">
									<span class="filter_input_checkbox">
										<input type="checkbox" name="param2_1" id="param2_1" >
										<span class="filter_param_text">Акции</span>
									</span>
								</label>	
								<label data-role="label_param2_2" class="filter_param_label " for="param2_2">
									<span class="filter_input_checkbox">
										<input type="checkbox" name="param2_2" id="param2_2" >
										<span class="filter_param_text">Хиты</span>
									</span>
								</label>
								<label data-role="label_param2_3" class="filter_param_label " for="param2_3">
									<span class="filter_input_checkbox">
										<input type="checkbox" name="param2_3" id="param2_3" >
										<span class="filter_param_text">Новинки</span>
									</span>
								</label>							
							</div>						
						</div>-->			
					</div>	
					<hr class="filter_separator">				
					<div class="inner_wrap_sidebar">
						<span class="filter_container_title" onclick="smartFilter.hideFilterProps(this)">Разновидность</span>
						<!--<div class="bx_filter_block">
							<div class="filter_parameters_container">
								<label data-role="label_param2_1" class="filter_param_label " for="param2_1">
									<span class="filter_input_checkbox">
										<input type="checkbox" name="param2_1" id="param2_1" >
										<span class="filter_param_text">Акции</span>
									</span>
								</label>	
								<label data-role="label_param2_2" class="filter_param_label " for="param2_2">
									<span class="filter_input_checkbox">
										<input type="checkbox" name="param2_2" id="param2_2" >
										<span class="filter_param_text">Хиты</span>
									</span>
								</label>
								<label data-role="label_param2_3" class="filter_param_label " for="param2_3">
									<span class="filter_input_checkbox">
										<input type="checkbox" name="param2_3" id="param2_3" >
										<span class="filter_param_text">Новинки</span>
									</span>
								</label>							
							</div>						
						</div>-->			
					</div>	
					<hr class="filter_separator">				
					<div class="inner_wrap_sidebar">
						<span class="filter_container_title" onclick="smartFilter.hideFilterProps(this)">Материал</span>
						<!--<div class="bx_filter_block">
							<div class="filter_parameters_container">
								<label data-role="label_param2_1" class="filter_param_label " for="param2_1">
									<span class="filter_input_checkbox">
										<input type="checkbox" name="param2_1" id="param2_1" >
										<span class="filter_param_text">Акции</span>
									</span>
								</label>	
								<label data-role="label_param2_2" class="filter_param_label " for="param2_2">
									<span class="filter_input_checkbox">
										<input type="checkbox" name="param2_2" id="param2_2" >
										<span class="filter_param_text">Хиты</span>
									</span>
								</label>
								<label data-role="label_param2_3" class="filter_param_label " for="param2_3">
									<span class="filter_input_checkbox">
										<input type="checkbox" name="param2_3" id="param2_3" >
										<span class="filter_param_text">Новинки</span>
									</span>
								</label>							
							</div>						
						</div>-->			
					</div>					
					<hr class="filter_separator">
					<div class="inner_wrap_sidebar">
						<span class="filter_container_title" onclick="smartFilter.hideFilterProps(this)">Фабрики</span>
						<div class="bx_filter_block">
							<div class="filter_parameters_container">
								<label data-role="label_param5_1" class="filter_param_label " for="param5_1">
									<span class="filter_input_checkbox">
										<input type="checkbox" name="param5_1" id="param5_1" >
										<span class="filter_param_text">Zenit cambiamo</span>
									</span>
								</label>	
								<label data-role="label_param5_2" class="filter_param_label " for="param5_2">
									<span class="filter_input_checkbox">
										<input type="checkbox" name="param5_2" id="param5_2" >
										<span class="filter_param_text">Gira iniziale </span>
									</span>
								</label>
								<label data-role="label_param5_3" class="filter_param_label " for="param5_3">
									<span class="filter_input_checkbox">
										<input type="checkbox" name="param5_3" id="param5_3" >
										<span class="filter_param_text">Radiante</span>
									</span>
								</label>
								<label data-role="label_param5_4" class="filter_param_label " for="param5_4">
									<span class="filter_input_checkbox">
										<input type="checkbox" name="param5_4" id="param5_4" >
										<span class="filter_param_text">Questo </span>
									</span>
								</label>	
								<label data-role="label_param5_5" class="filter_param_label " for="param5_5">
									<span class="filter_input_checkbox">
										<input type="checkbox" name="param5_5" id="param5_5" >
										<span class="filter_param_text">Proposito </span>
									</span>
								</label>
								<label data-role="label_param5_6" class="filter_param_label " for="param5_6">
									<span class="filter_input_checkbox">
										<input type="checkbox" name="param5_6" id="param5_6" >
										<span class="filter_param_text">Necessario</span>
									</span>
								</label>							
							</div>						
						</div>					
					</div>
				</div>
			</form>*/?>
<script>
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>');
</script>