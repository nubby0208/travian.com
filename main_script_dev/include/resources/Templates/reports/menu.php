<a type="button" title="<?=T("inGame", "Select this tab as fav");?>" id="tabFavorButton" class="icon contentTitleButton  buttonFramed green withIcon rectangle" 
onclick="Travian.api('favourite-tab', {data: {name: 'reports',number: '<?=$vars['selectedTab'];?>'},success: function(data) {if (data.success) { jQuery('.favor').removeClass('favorActive');jQuery('.favor.favorKey<?=$vars['selectedTab'];?>').addClass('favorActive');}}});return false;" useicon="">
<img src="/img/x.gif" class="&nbsp;" alt="" data-cmp-info="9"></a>

<div class="contentNavi subNavi tabFavorWrapper">
	<button type="button" class="scrollFrom" disabled="disabled"></button>
    <div class="scrollingContainer">
		<div class="content favor <?=$vars['favorTabId']==0 ? "favorActive" : ''; ?> favorKey0" > 
			<a id="<?=$button_id = get_button_id();?>" href="reports.php?t=0" class="tabItem <?=$vars['selectedTab'] == 0  ? 'active' : 'normal'; ?>"> 
				<?=T("Reports", "Tabs.All");?>
				<img src="img/x.gif" class="favorIcon" alt="<?=T("inGame", "This tab is selected as your fav tab");?>"/> 
			</a> 
		</div>
		<script type="text/javascript">
		if (jQuery('#<?=$button_id;?>')){
			jQuery('#<?=$button_id;?>').click(
				function (event){
					jQuery(window).trigger('tabClicked', [this,{
						"class": "<?=$vars['selectedTab'] == 0 ? 'active' : 'normal';?>", 
						"title": false, 
						"target": false, 
						"id": "<?=$button_id;?>", 
						"href": "reports.php?t=0", 
						"onclick": false, 
						"enabled": true, 
						"text": "<?=T("Reports", "Tabs.All");?>", 
						"dialog": false, 
						"plusDialog": false, 
						"goldclubDialog": false, 
						"containerId": "", 
						"buttonIdentifier": "<?=$button_id;?>"
						}]);
					});
				}
		</script>
		<div class="content favor <?=$vars['favorTabId']==1 ? "favorActive" : ''; ?> favorKey1" > 
			<a id="<?=$button_id = get_button_id();?>" href="reports.php?t=1" class="tabItem <?=$vars['selectedTab'] == 1 ? 'active' : 'normal'; ?>" > 
				<?=T("Reports", "Tabs.Attacks");?>
				<img src="img/x.gif" class="favorIcon" alt="<?=T("Global", "This tab is set as favourite"); ?>"/> 
			</a> 
		</div>
		<script type="text/javascript">if (jQuery('#<?=$button_id;?>')){jQuery('#<?=$button_id;?>').click(function (event){jQuery(window).trigger('tabClicked', [this,{"class": "<?=$vars['selectedTab'] == 1 ? 'active' : 'normal';?>", "title": false, "target": false, "id": "<?=$button_id;?>", "href": "reports.php?t=1", "onclick": false, "enabled": true, "text": "<?=T("Reports", "Tabs.Attacks");?>", "dialog": false, "plusDialog": false, "goldclubDialog": false, "containerId": "", "buttonIdentifier": "<?=$button_id;?>"}]);});}</script> 
		
		<div class="content favor <?=$vars['favorTabId']==2 ? "favorActive" : ''; ?> favorKey2" > 
			<a id="<?=$button_id = get_button_id();?>" href="reports.php?t=2" class="tabItem <?=$vars['selectedTab'] == 2 ? 'active' : 'normal'; ?>" > 
				<?=T("Reports", "Tabs.Defense");?>
				<img src="img/x.gif" class="favorIcon" alt="<?=T("Global", "This tab is set as favourite"); ?>"/> 
			</a> 
		</div>
		<script type="text/javascript">if (jQuery('#<?=$button_id;?>')){jQuery('#<?=$button_id;?>').click(function (event){jQuery(window).trigger('tabClicked', [this,{"class": "<?=$vars['selectedTab'] == 2 ? 'active' : 'normal';?>", "title": false, "target": false, "id": "<?=$button_id;?>", "href": "reports.php?t=2", "onclick": false, "enabled": true, "text": "<?=T("Reports", "Tabs.Defense");?>", "dialog": false, "plusDialog": false, "goldclubDialog": false, "containerId": "", "buttonIdentifier": "<?=$button_id;?>"}]);});}</script> 
		
		<div class="content favor <?=$vars['favorTabId']==3 ? "favorActive" : ''; ?> favorKey3" > 
			<a id="<?=$button_id = get_button_id();?>" href="reports.php?t=3" class="tabItem <?=$vars['selectedTab'] == 3 ? 'active' : 'normal'; ?>" > 
				<?=T("Reports", "Tabs.Spy");?>
				<img src="img/x.gif" class="favorIcon" alt="<?=T("Global", "This tab is set as favourite"); ?>"/> 
			</a> 
		</div>
		<script type="text/javascript">if (jQuery('#<?=$button_id;?>')){jQuery('#<?=$button_id;?>').click(function (event){jQuery(window).trigger('tabClicked', [this,{"class": "<?=$vars['selectedTab'] == 3 ? 'active' : 'normal';?>", "title": false, "target": false, "id": "<?=$button_id;?>", "href": "reports.php?t=3", "onclick": false, "enabled": true, "text": "<?=T("Reports", "Tabs.Spy");?>", "dialog": false, "plusDialog": false, "goldclubDialog": false, "containerId": "", "buttonIdentifier": "<?=$button_id;?>"}]);});}</script> 
		
		<div class="content favor <?=$vars['favorTabId']==4 ? "favorActive" : ''; ?> favorKey4" > 
			<a id="<?=$button_id = get_button_id();?>" href="reports.php?t=4" class="tabItem <?=$vars['selectedTab'] == 4 ? 'active' : 'normal'; ?>" > 
				<?=T("Reports", "Tabs.Other");?>
				<img src="img/x.gif" class="favorIcon" alt="<?=T("Global", "This tab is set as favourite"); ?>"/> 
			</a> 
		</div>
		<script type="text/javascript">if (jQuery('#<?=$button_id;?>')){jQuery('#<?=$button_id;?>').click(function (event){jQuery(window).trigger('tabClicked', [this,{"class": "<?=$vars['selectedTab'] == 4 ? 'active' : 'normal';?>", "title": false, "target": false, "id": "<?=$button_id;?>", "href": "reports.php?t=4", "onclick": false, "enabled": true, "text": "<?=T("Reports", "Tabs.Other");?>", "dialog": false, "plusDialog": false, "goldclubDialog": false, "containerId": "", "buttonIdentifier": "<?=$button_id;?>"}]);});}</script> 
		
		<div class="content favor <?=$vars['favorTabId']==5 ? "favorActive" : ''; ?> favorKey5"> 
			<a id="<?=$vars['Archive'];?>" href="<?=$vars['goldClub'] ? 'reports.php?t=5' : '#';?>" class="tabItem <?=$vars['goldClub'] ? '' : 'gold';?> <?=$vars['selectedTab'] == 5 ? 'active' : 'normal'; ?>" > 
				<?=T("Reports", "Tabs.Archive");?>
				<img src="img/x.gif" class="favorIcon" alt="<?=T("Global", "This tab is set as favourite"); ?>"/> 
			</a> 
		</div>
		<?php if($vars['goldClub']):?>
		<script type="text/javascript">if (jQuery('#<?=$vars['Archive'];?>')){jQuery('#<?=$vars['Archive'];?>').click(function (event){jQuery(window).trigger('tabClicked', [this,{"class": "<?=$vars['selectedTab'] == 5 ? 'active' : 'normal';?>", "title": "<?= T("Reports", "Tabs.Archive");?>", "target": false, "id": "<?=$vars['Archive'];?>", "href": "reports.php?t=5", "onclick": false, "enabled": true, "text": "<?=T("Reports", "Tabs.Archive");?>", "dialog": false, "plusDialog": false, "goldclubDialog": false, "containerId": "", "buttonIdentifier": "<?=$vars['Archive'];?>"}]);});}</script> 
		<?php else:?>
		<script type="text/javascript">
		jQuery(function() {
		if (jQuery('#<?=$vars['Archive'];?>').length > 0){
			jQuery('#<?=$vars['Archive'];?>').on('click', function (){jQuery(window).trigger('tabClicked', [this,{
			"class": "gold normal", 
			"title": "<?=$vars['ArchiveGoldClubTitle'];?>", 
			"target": false, 
			"id": "<?=$vars['Archive'];?>", 
			"href": "#", 
			"onclick": false, 
			"enabled": true, 
			"text": "<?=T("Reports", "Tabs.Archive");?>", 
			"dialog": false, 
			"plusDialog": false, 
			"goldclubDialog": {
				"featureKey": "messageArchive",
				"infoIcon": "http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer",
				"cssClass":"premiumFeaturePackage premiumFeatureGoldclub paymentShopV4",
				"premiumFeatureDialogVersion":2,
				"version":2,
				"paymentShopVersion":4}, 
			"containerId": "", 
			"buttonIdentifier": "<?=$vars['Archive'];?>"}]);});}
		});</script> 
		<?php endif;?>
		<div class="content favor <?=$vars['favorTabId']==6 ? "favorActive" : ''; ?> favorKey6" > 
			<a id="<?=$button_id = get_button_id();?>" href="reports.php?t=6" class="tabItem <?=$vars['selectedTab'] == 6 ? 'active' : 'normal'; ?>" > 
				<?=T("Reports", "Tabs.Surrounding");?>
				<img src="img/x.gif" class="favorIcon" alt="<?=T("Global", "This tab is set as favourite"); ?>"/> 
			</a> 
		</div>
		<script type="text/javascript">if (jQuery('#<?=$button_id;?>')){jQuery('#<?=$button_id;?>').click(function (event){jQuery(window).trigger('tabClicked', [this,{"class": "<?=$vars['selectedTab'] == 6 ? 'active' : 'normal';?>", "title": false, "target": false, "id": "<?=$button_id;?>", "href": "reports.php?t=6", "onclick": false, "enabled": true, "text": "<?=T("Reports", "Tabs.Surrounding");?>", "dialog": false, "plusDialog": false, "goldclubDialog": false, "containerId": "", "buttonIdentifier": "<?=$button_id;?>"}]);});}</script> 
		
		<div class="content favor <?=$vars['favorTabId']==7 ? "favorActive" : ''; ?> favorKey7" > 
			<a id="<?=$button_id = get_button_id();?>" href="reports.php?t=7" class="tabItem <?=$vars['selectedTab'] == 7 ? 'active' : 'normal'; ?>" > 
				<?=T("Reports", "Management");?>
				<img src="img/x.gif" class="favorIcon" alt="<?=T("Global", "This tab is set as favourite"); ?>"/> 
			</a> 
		</div>
		<script type="text/javascript">if (jQuery('#<?=$button_id;?>')){jQuery('#<?=$button_id;?>').click(function (event){jQuery(window).trigger('tabClicked', [this,{"class": "<?=$vars['selectedTab'] == 7 ? 'active' : 'normal';?>", "title": false, "target": false, "id": "<?=$button_id;?>", "href": "reports.php?t=7", "onclick": false, "enabled": true, "text": "<?=T("Reports", "Management");?>", "dialog": false, "plusDialog": false, "goldclubDialog": false, "containerId": "", "buttonIdentifier": "<?=$button_id;?>"}]);});}</script> 
		</div>
	<button type="button" class="scrollTo" disabled="disabled"></button>
</div>

<script type="text/javascript" data-cmp-info="6">
	jQuery(function() {
		Travian.Game.TabScrollNavigation();
	});
</script>
<script data-cmp-info="6">
	function reportsFormSelectAll(checkbox) {
		jQuery('#reportsForm').find('input[type=checkbox]').each(function (_, element) {
			element.checked = checkbox.checked;
		}, checkbox);
	}
</script>