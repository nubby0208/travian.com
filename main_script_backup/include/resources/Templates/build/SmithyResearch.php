<div class="research">
    <div class="bigUnitSection">
        <a href="#"
           onclick="return Travian.Game.iPopup(<?=$vars['unitId']; ?>,1);">
            <img
                class="unitSection u<?=$vars['unitId']; ?>Section"
                src="img/x.gif"
                alt="<?=T("Troops", $vars['unitId'].'.title'); ?>"
                title="<?=T("Troops", $vars['unitId'].'.title'); ?>"/>
        </a> <a href="#" class="zoom"
                onclick="return Travian.Game.unitZoom(<?=$vars['unitId']; ?>);">
            <img
                class="zoom" src="img/x.gif" alt="zoom in"
                title="<?=T("inGame", "zoomIn"); ?>"/>
        </a>
    </div>
    <div class="information">
        <div class="title">
            <a href="#"
               onclick="return Travian.Game.iPopup(<?=$vars['unitId']; ?>,1);"><img
                    class="unit u<?=$vars['unitId']; ?>" src="img/x.gif"
                    alt="<?=T("Troops", $vars['unitId'].'.title'); ?>"
                    title="<?=T(
                        "Troops", $vars['unitId'].'.title'
                    ); ?>"/></a> <a
                href="#"
                onclick="return Travian.Game.iPopup(<?=$vars['unitId']; ?>,1);"><?=T(
                    "Troops", $vars['unitId'].'.title'
                ); ?></a> <span
                class="level"><?=T(
                    "Buildings", "level"
                ); ?> <?=$vars['lvl']; ?></span>
        </div>
        <?php if (!isset($vars['isMaxLvl']) or $vars['isMaxLvl'] == false): ?>
            <div class="inlineIconList resourceWrapper">
                <div class="inlineIcon resource"><i class="r1Big"></i><span
                            class="value value"><?= $vars['cost'][0]; ?></span></div>
                <div class="inlineIcon resource"><i class="r2Big"></i><span
                            class="value value"><?= $vars['cost'][1]; ?></span></div>
                <div class="inlineIcon resource"><i class="r3Big"></i><span
                            class="value value"><?= $vars['cost'][2]; ?></span></div>
                <div class="inlineIcon resource"><i class="r4Big"></i><span
                            class="value value"><?= $vars['cost'][3]; ?></span></div>
            </div>
            <br/>
        <?php endif; ?>
        <div class="cta">
            <?php if (!isset($vars['isMaxLvl']) or $vars['isMaxLvl'] == false): ?>
                <div class="inlineIcon duration"><i class="clock_medium"></i><span class="value ">&nbsp;<?= secondsToString($vars['duration']); ?></span></div>
                <?= $vars['NPCButton']; ?>
            <?php endif;?>
            <?= $vars['contractLink']; ?>
        </div>
    </div>
    <div class="clear"></div>
</div>