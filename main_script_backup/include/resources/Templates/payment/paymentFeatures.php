<div class="contentBorder infoArea">
    <div class="contentBorder-tl"></div>
    <div class="contentBorder-tr"></div>
    <div class="contentBorder-tc"></div>
    <div class="contentBorder-ml"></div>
    <div class="contentBorder-mr"></div>
    <div class="contentBorder-mc"></div>
    <div class="contentBorder-bl"></div>
    <div class="contentBorder-br"></div>
    <div class="contentBorder-bc"></div>
    <div class="contentBorder-contents cf">
        <?php
        use Core\Config;
        use Core\Helper\TimezoneHelper;
        use Core\Session;
        use Core\Village;
        use Game\GoldHelper;
        use Model\TrainingModel;
        function buildFeature($featureName, $coins, $wwInAvailable, $delivery)
        {
            $featureName = explode("_", $featureName);
            if (sizeof($featureName) == 2) {
                $percent = $featureName[1];
            }
            $featureName = $featureName[0];
            $isMoreProtection = substr($featureName, 0, 14) == 'moreProtection';
            $HTML = '<div class="feature featureBooking ">';
            $HTML .= '<input type="hidden" class="premiumFeatureName hide" name="featureName" value="' . $featureName . '">';
            $HTML .= '<div class="featureContent">';
            $end = null;
            if ($featureName == 'fasterTraining') {
                $end .= getEnd(Session::getInstance()->get("fasterTraining"));
            } else if ($featureName == 'atkBonus') {
                $end .= getEnd(Session::getInstance()->get("atkBonusExpireTime"));
            } else if ($featureName == 'defBonus') {
                $end .= getEnd(Session::getInstance()->get("defBonusExpireTime"));
            }
            if ($isMoreProtection) {
                $featureNameForTranslation = 'moreProtection';
                $featureNameDescForTranslation = 'moreProtectionDesc';
            } else {
                $featureNameForTranslation = $featureName;
                $featureNameDescForTranslation = $featureName . 'Desc';
            }
            $HTML .= '<h3 class="featureTitle">' . (isset($percent) ? sprintf(T("PaymentWizard", $featureNameForTranslation), $percent) : T("PaymentWizard", $featureNameForTranslation)) . $end . '</h3>';
            $HTML .= '<div class="featureRemainingTime featureSubtitle subtitle"><span class="">' . T("PaymentWizard", $featureNameDescForTranslation) . '</span></div>';
            $HTML .= '<div class="featureButton">' . (new GoldHelper())->renderBuyButton($featureName, $coins, $wwInAvailable) . '</div>';
            if ($isMoreProtection || in_array($featureName, ['fasterTraining', 'atkBonus', 'defBonus'])) {
                $HTML .= '<div class="featureDuration featureRenewal featureButtonSubtitle subtitle">' . T("PaymentWizard", "Bonus duration") . ': <span class="bold">' . ($delivery == 0 ? T("PaymentWizard", "Immediately") : $delivery) . '</span>  ' . ($delivery == 0 ? '' : T("PaymentWizard", "hour")) . '  </div>';
            } else {
                $HTML .= '<div class="featureDuration featureRenewal featureButtonSubtitle subtitle">' . T("PaymentWizard", "delivery") . ': <span class="bold">' . ($delivery == 0 ? T("PaymentWizard", "Immediately") : $delivery) . '</span>  ' . ($delivery == 0 ? '' : T("PaymentWizard", "Minutes")) . '  </div>';
            }
            $HTML .= '</div>';
            $HTML .= '</div>';
            return $HTML;
        }

        function buildAnimalFeature($featureName, $units, $coins, $wwInAvailable, $delivery)
        {
            $HTML = '<div class="feature featureBooking " style="height: 85px">';
            $HTML .= '<input type="hidden" class="premiumFeatureName hide" name="featureName" value="' . $featureName . '">';
            $HTML .= '<div class="featureContent">';
            $HTML .= '<table style="width: 80%; border: 0"><tbody><tr style="border: 0;">';
            for ($i = 0; $i <= 4; ++$i) {
                if ($units[$i] <= 0) {
                    $HTML .= '<td style="border: 0; height: 20%;"></td>';
                    continue;
                }
                $HTML .= '<td style="border: 0; height: 20%; font-size:11px"><img class="unit u' . ($i + 30 + 1) . '" src="img/x.gif"><br />' . number_format_x($units[$i]) . '</td>';
            }
            $HTML .= '</tr><tr style="border: 0;">';
            for ($i = 5; $i <= 9; ++$i) {
                if ($units[$i] <= 0) {
                    $HTML .= '<td style="border: 0; height: 20%;"></td>';
                    continue;
                }
                $HTML .= '<td style="border: 0; font-size:11px"><img class="unit u' . ($i + 30 + 1) . '" src="img/x.gif"><br />' . number_format_x($units[$i]) . '</td>';
            }
            $HTML .= '</tr></tbody></table>';
            $HTML .= '<div class="featureButton">' . (new GoldHelper())->renderBuyButton($featureName, $coins, $wwInAvailable) . '</div>';
            $HTML .= '<div class="featureDuration featureRenewal featureButtonSubtitle subtitle">' . T("PaymentWizard", "delivery") . ': <span class="bold">' . ($delivery == 0 ? T("PaymentWizard", "Immediately") : $delivery) . '</span>  ' . ($delivery == 0 ? '' : T("PaymentWizard", "Minutes")) . '</div>';
            $HTML .= '</div>';
            $HTML .= '</div>';
            return $HTML;
        }

        function buildResourcesFeature($featureName, $units, $coins, $wwInAvailable, $delivery)
        {
            $HTML = '<div class="feature featureBooking " style="height: 58px">';
            $HTML .= '<input type="hidden" class="premiumFeatureName hide" name="featureName" value="' . $featureName . '">';
            $HTML .= '<div class="featureContent">';
            $HTML .= '<table style="width: 80%; border: 0"><tbody><tr style="border: 0;">';
            for ($i = 0; $i <= 1; ++$i) {
                $HTML .= '<td style="border: 0; height: 20%;"><div class="inlineIcon resources"><i class="r'.($i+1).'"></i>&nbsp;<span class="value ">' . number_format_x($units[$i]) . '</span></div></td>';
            }
            $HTML .= '</tr><tr style="border: 0;">';
            for ($i = 2; $i <= 3; ++$i) {
                $HTML .= '<td style="border: 0; height: 20%;"><div class="inlineIcon resources"><i class="r'.($i + 1).'"></i>&nbsp;<span class="value ">' . number_format_x($units[$i]) . '</span></div></td>';
            }
            $HTML .= '</tr></tbody></table>';
            $HTML .= '<div class="featureButton">' . (new GoldHelper())->renderBuyButton($featureName, $coins, $wwInAvailable) . '</div>';
            $HTML .= '<div class="featureDuration featureRenewal featureButtonSubtitle subtitle">' . T("PaymentWizard", "delivery") . ': <span class="bold">' . ($delivery == 0 ? T("PaymentWizard", "Immediately") : $delivery) . '</span>  ' . ($delivery == 0 ? '' : T("PaymentWizard", "Minutes")) . '</div>';
            $HTML .= '</div>';
            $HTML .= '</div>';
            return $HTML;
        }

        function getEnd($time, $autoExtend = false)
        {
            if ($time < time()) {
                return '';
            }
            if (($time - time()) > 86400) {
                $hldDays = round(($time - time()) / 86400);
                return '<span class=""> (' . T("PaymentWizard", "Days remaining") . ' ' . $hldDays . ' ' . T("PaymentWizard", "until") . ' ' . TimezoneHelper::date("H:i:s", $time) . ')</span>';
            } else {
                return '<span class="bonusEndsSoon"> (' . sprintf(T("PaymentWizard", "EndsAtX"), TimezoneHelper::date("H:i:s", $time)) . ')</span>';
            }
        }

        function buildTroopsFeature($featureName, $units, $coins, $wwInAvailable, $delivery)
        {
            $HTML = '<div class="feature featureBooking " style="height: 85px">';
            $HTML .= '<input type="hidden" class="premiumFeatureName hide" name="featureName" value="' . $featureName . '">';
            $HTML .= '<div class="featureContent">';
            $HTML .= '<table style="width: 80%; border: 0"><tbody><tr style="border: 0;">';
            $race = Session::getInstance()->getRace();
            for ($i = 0; $i <= 3; ++$i) {
                $HTML .= '<td style="border: 0; height: 20%; font-size:11px"><img class="unit u' . nrToUnitId(1 + $i, $race) . '" src="img/x.gif"><br />' . number_format_x($units[$i]) . '</td>';
            }
            $HTML .= '</tr><tr style="border: 0; font-size:11px">';
            for ($i = 4; $i <= 7; ++$i) {
                $HTML .= '<td style="border: 0; font-size:11px"><img class="unit u' . nrToUnitId(1 + $i, $race) . '" src="img/x.gif"><br />' . number_format_x($units[$i]) . '</td>';
            }
            $HTML .= '</tr></tbody></table>';
            $HTML .= '<div class="featureButton">' . (new GoldHelper())->renderBuyButton($featureName, $coins, $wwInAvailable) . '</div>';
            $HTML .= '<div class="featureDuration featureRenewal featureButtonSubtitle subtitle">' . T("PaymentWizard", "delivery") . ': <span class="bold">' . ($delivery == 0 ? T("PaymentWizard", "Immediately") : $delivery) . '</span>  ' . ($delivery == 0 ? '' : T("PaymentWizard", "Minutes")) . '  </div>';
            $HTML .= '</div>';
            $HTML .= '</div>';

            return $HTML;
        }

        $config = Config::getInstance();
        $step = 0;

        $order = []; ?>
        <?php if ($vars['enabledFeatures']['general']):$step++;
            $order['generalOptions'] = $step; ?>
            <a href="#"
               onclick="jQuery('.paymentWizardMenu').addClass('hide');jQuery('.buyGoldInfoStep').removeClass('active');jQuery('.buyGoldInfoStep#<?=$step; ?>').addClass('active');jQuery('.paymentWizardMenu#generalOptions').removeClass('hide');">
                <div
                        class="buyGoldInfoStep <?=$step == 1 ? 'active' : ''; ?>"
                        id="<?=$step; ?>">
                    <div
                            class="buyGoldInfoStepNumber"><?=$step; ?></div>
                    <div
                            class="buyGoldInfoStepLabel"><?=T("PaymentWizard", "General"); ?>
                        :
                    </div>
                    <div
                            class="buyGoldInfoStepContent"><?=T("PaymentWizard", "GeneralOptions"); ?></div>
                </div>
            </a>
        <?php endif; ?>
        <?php if ($vars['enabledFeatures']['buyTroops']):$step++;
            $order['buyTroops'] = $step; ?>
            <a href="#"
               onclick="jQuery('.paymentWizardMenu').addClass('hide');jQuery('.buyGoldInfoStep').removeClass('active');jQuery('.buyGoldInfoStep#<?=$step; ?>').addClass('active');jQuery('.paymentWizardMenu#buyTroops').removeClass('hide');">
                <div
                        class="buyGoldInfoStep <?=$step == 1 ? 'active' : ''; ?>"
                        id="<?=$step; ?>">
                    <div
                            class="buyGoldInfoStepNumber"><?=$step; ?></div>
                    <div
                            class="buyGoldInfoStepLabel"><?=T("PaymentWizard", "Troops"); ?>
                        :
                    </div>
                    <div
                            class="buyGoldInfoStepContent"><?=T("PaymentWizard", "buyTroops"); ?></div>
                </div>
            </a>
        <?php endif; ?>
        <?php if ($vars['enabledFeatures']['buyResources']):$step++;
            $order['buyResources'] = $step; ?>
            <a href="#"
               onclick="jQuery('.paymentWizardMenu').addClass('hide');jQuery('.buyGoldInfoStep').removeClass('active');jQuery('.buyGoldInfoStep#<?=$step; ?>').addClass('active');jQuery('.paymentWizardMenu#buyResources').removeClass('hide');">
                <div
                        class="buyGoldInfoStep <?=$step == 1 ? 'active' : ''; ?>"
                        id="<?=$step; ?>">
                    <div
                            class="buyGoldInfoStepNumber"><?=$step; ?></div>
                    <div
                            class="buyGoldInfoStepLabel"><?=T("PaymentWizard", "Troops"); ?>
                        :
                    </div>
                    <div
                            class="buyGoldInfoStepContent"><?=T("PaymentWizard", "buyResources"); ?></div>
                </div>
            </a>
        <?php endif; ?>
        <?php if ($vars['enabledFeatures']['buyAnimal']):$step++;
            $order['buyAnimal'] = $step; ?>
            <a href="#"
               onclick="jQuery('.paymentWizardMenu').addClass('hide');jQuery('.buyGoldInfoStep').removeClass('active');jQuery('.buyGoldInfoStep#<?=$step; ?>').addClass('active');jQuery('.paymentWizardMenu#buyAnimal').removeClass('hide');">
                <div
                        class="buyGoldInfoStep <?=$step == 1 ? 'active' : ''; ?>"
                        id="<?=$step; ?>">
                    <div
                            class="buyGoldInfoStepNumber"><?=$step; ?></div>
                    <div
                            class="buyGoldInfoStepLabel"><?=T("PaymentWizard", "Troops"); ?>
                        :
                    </div>
                    <div
                            class="buyGoldInfoStepContent"><?=T("PaymentWizard", "buyAnimal"); ?></div>
                </div>
            </a>
        <?php endif; ?>
        <?php if ($vars['enabledFeatures']['moreProtection']):$step++;
            $order['moreProtection'] = $step; ?>
            <a href="#"
               onclick="jQuery('.paymentWizardMenu').addClass('hide');jQuery('.buyGoldInfoStep').removeClass('active');jQuery('.buyGoldInfoStep#<?=$step; ?>').addClass('active');jQuery('.paymentWizardMenu#moreProtection').removeClass('hide');">
                <div
                        class="buyGoldInfoStep <?=$step == 1 ? 'active' : ''; ?>"
                        id="<?=$step; ?>">
                    <div
                            class="buyGoldInfoStepNumber"><?=$step; ?></div>
                    <div
                            class="buyGoldInfoStepLabel"><?=T("PaymentWizard", "Protection"); ?>:
                    </div>
                    <div
                            class="buyGoldInfoStepContent"><?=T("PaymentWizard", "Protection Packages"); ?></div>
                </div>
            </a>
        <?php endif; ?>
        <?php if ($vars['enabledFeatures']['extraPower']):$step++;
            $order['power'] = $step; ?>
            <a href="#"
               onclick="jQuery('.paymentWizardMenu').addClass('hide');jQuery('.buyGoldInfoStep').removeClass('active');jQuery('.buyGoldInfoStep#<?=$step; ?>').addClass('active');jQuery('.paymentWizardMenu#power').removeClass('hide');">
                <div
                        class="buyGoldInfoStep <?=$step == 1 ? 'active' : ''; ?>"
                        id="<?=$step; ?>">
                    <div
                            class="buyGoldInfoStepNumber"><?=$step; ?></div>
                    <div
                            class="buyGoldInfoStepLabel"><?=T("PaymentWizard", "Power"); ?></div>
                    <div
                            class="buyGoldInfoStepContent"><?=T("PaymentWizard", "Attack/Defense Bonus"); ?></div>
                </div>
            </a>
        <?php endif; ?>
        <script type="text/javascript">
            function productPurchased(data) {
                    var dialog = new Travian.Dialog.Dialog({preventFormSubmit: true});
                if (data.type === 'animal') {
                    dialog.setContent('<?=T("PaymentWizard", "Animals purchased");?>');
                } else if (data.type === 'troops') {
                    dialog.setContent('<?=T("PaymentWizard", "Troops purchased");?>');
                } else {
                    dialog.setContent('<?=T("PaymentWizard", "Resources purchased!");?>');
                }
                dialog.show();
                jQuery(".accountBalance span")[0].html(data.newGold);
            }
        </script>
    </div>
</div>
<div class="contentBorder contentArea">
    <div class="contentBorder-tl"></div>
    <div class="contentBorder-tr"></div>
    <div class="contentBorder-tc"></div>
    <div class="contentBorder-ml"></div>
    <div class="contentBorder-mr"></div>
    <div class="contentBorder-mc"></div>
    <div class="contentBorder-bl"></div>
    <div class="contentBorder-br"></div>
    <div class="contentBorder-bc"></div>
    <div class="contentBorder-contents cf">
        <div class="paymentPopupDialogWrapper">
            <?php if ($vars['enabledFeatures']['general']):$step++; ?>
                <div
                        class="paymentWizardMenu <?=$order['generalOptions'] == 1 ? '' : 'hide'; ?>"
                        id="generalOptions">
                    <?php if ($config->extraSettings->generalOptions->upgradeAllResourcesTo20->enabled): ?>
                        <?=buildFeature('upgradeAllResourcesTo20', (Village::getInstance()->isCapital() ? $config->extraSettings->generalOptions->upgradeAllResourcesTo20->coinsCapital : $config->extraSettings->generalOptions->upgradeAllResourcesTo20->coinsNoNCapital), false, 0); ?>
                    <?php endif; ?>
                    <?php if (Village::getInstance()->isCapital() && $config->extraSettings->generalOptions->upgradeAllResourcesTo30->enabled): ?>
                        <?=buildFeature('upgradeAllResourcesTo30', $config->extraSettings->generalOptions->upgradeAllResourcesTo30->coins, false, 0); ?>
                    <?php endif; ?>
                    <?php if ($config->extraSettings->generalOptions->rallyPointTo20->enabled): ?>
                        <?=buildFeature('rallyPointTo20', $config->extraSettings->generalOptions->rallyPointTo20->coins, false, 0); ?>
                    <?php endif; ?>
                    <?php if ($config->extraSettings->generalOptions->oneHourOfProduction->enabled): ?>
                        <?=buildFeature('oneHourOfProduction', $config->extraSettings->generalOptions->oneHourOfProduction->coins, true, 0); ?>
                    <?php endif; ?>
                    <?php if ($config->extraSettings->generalOptions->increaseStorage->enabled): ?>
                        <?=buildFeature('increaseStorage', $config->extraSettings->generalOptions->increaseStorage->coins, false, 0); ?>
                    <?php endif; ?>
                    <?php if ($config->extraSettings->generalOptions->finishTraining->enabled): ?>
                        <?=buildFeature('finishTraining', (new TrainingModel())->calculatePriceForInstantTraining(Village::getInstance()->getKid()), false, 0); ?>
                    <?php endif; ?>
                    <?php if ($config->extraSettings->generalOptions->fasterTraining->enabled): ?>
                        <?=buildFeature('fasterTraining_' . $config->extraSettings->generalOptions->fasterTraining->percent, $config->extraSettings->generalOptions->fasterTraining->coins, false, $config->extraSettings->generalOptions->fasterTraining->duration); ?>
                    <?php endif; ?>
                    <?php if ($config->extraSettings->generalOptions->cancelTrainingQueue->enabled): ?>
                        <?=buildFeature('cancelTrainingQueue', $config->extraSettings->generalOptions->cancelTrainingQueue->coins, false, 0); ?>
                    <?php endif; ?>
                    <?php if ($config->extraSettings->generalOptions->smithyUpgradeAllToMax->enabled): ?>
                        <?=buildFeature('smithyUpgradeAllToMax', $config->extraSettings->generalOptions->smithyUpgradeAllToMax->coins, false, 0); ?>
                    <?php endif; ?>
                    <?php if ($config->extraSettings->generalOptions->academyResearchAll->enabled): ?>
                        <?=buildFeature('academyResearchAll', $config->extraSettings->generalOptions->academyResearchAll->coins, false, 0); ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php if ($vars['enabledFeatures']['buyAnimal']):$step++; ?>
                <div
                        class="paymentWizardMenu <?=$order['buyAnimal'] == 1 ? '' : 'hide'; ?>"
                        id="buyAnimal">
                    <?php
                    foreach ($config->extraSettings->buyAnimal['packages'] as $index => $package) {
                        echo buildAnimalFeature('buyAnimal' . $index, $package['units'], $package['coins'], true, $package['delivery']);
                    }
                    if ($config->extraSettings->buyAnimal['buyInterval'] > 0) {
                        $buyInterval = $config->extraSettings->buyAnimal['buyInterval'];
                        $timeUnit = TimezoneHelper::getIntervalUnit($buyInterval);
                        echo '<h5 class="warning">' . sprintf(T("PaymentWizard", "You can buy animals every %s %s"), $timeUnit['time'], $timeUnit['unit']) . '</h5>';
                    }
                    ?>
                </div>
            <?php endif; ?>
            <?php if ($vars['enabledFeatures']['buyResources']):$step++; ?>
                <div
                        class="paymentWizardMenu <?=$order['buyResources'] == 1 ? '' : 'hide'; ?>"
                        id="buyResources">
                    <?php
                    foreach ($config->extraSettings->buyResources['packages'] as $index => $package) {
                        echo buildResourcesFeature('buyResources' . $index, $package['resources'], $package['coins'], true, 0);
                    }
                    if ($config->extraSettings->buyResources['buyInterval'] > 0) {
                        $buyInterval = $config->extraSettings->buyResources['buyInterval'];
                        $timeUnit = TimezoneHelper::getIntervalUnit($buyInterval);
                        echo '<h5 class="warning">' . sprintf(T("PaymentWizard", "You can buy resources every %s %s"), $timeUnit['time'], $timeUnit['unit']) . '</h5>';
                    }
                    ?>
                </div>
            <?php endif; ?>
            <?php if ($vars['enabledFeatures']['buyTroops']):$step++; ?>
                <div class="paymentWizardMenu <?=$order['buyTroops'] == 1 ? '' : 'hide'; ?>" id="buyTroops">
                    <?php
                    foreach ($config->extraSettings->buyTroops['packages'][Session::getInstance()->getRace()] as $index => $package) {
                        echo buildTroopsFeature('buyTroops' . $index, $package['units'], $package['coins'], true, 0);
                    }
                    if ($config->extraSettings->buyTroops['buyInterval'] > 0) {
                        $buyInterval = $config->extraSettings->buyTroops['buyInterval'];
                        $timeUnit = TimezoneHelper::getIntervalUnit($buyInterval);
                        echo '<h5 class="warning">' . sprintf(T("PaymentWizard", "You can buy troops every %s %s"), $timeUnit['time'], $timeUnit['unit']) . '</h5>';
                    }
                    ?>
                </div>
            <?php endif; ?>
            <?php if ($vars['enabledFeatures']['extraPower']):$step++; ?>
                <div class="paymentWizardMenu <?=$order['power'] == 1 ? '' : 'hide'; ?>" id="power">
                    <?php if ($config->extraSettings->power->atkBonus->enabled): ?>
                        <?=buildFeature('atkBonus_' . $config->extraSettings->power->atkBonus->percent, $config->extraSettings->power->atkBonus->coins, true, $config->extraSettings->power->atkBonus->duration); ?>
                    <?php endif; ?>
                    <?php if ($config->extraSettings->power->atkBonus->enabled): ?>
                        <?=buildFeature('defBonus_' . $config->extraSettings->power->defBonus->percent, $config->extraSettings->power->defBonus->coins, true, $config->extraSettings->power->defBonus->duration); ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php if ($vars['enabledFeatures']['moreProtection']):$step++; ?>
                <div class="paymentWizardMenu <?=$order['moreProtection'] == 1 ? '' : 'hide'; ?>"
                     id="moreProtection">
                    <?php
                    if (Session::getInstance()->hasProtection()) {
                        echo '<h5 class="round">' . sprintf(T("PaymentWizard", "You have %s hour(s) of protection left"), secondsToString(Session::getInstance()->protectionTill() - time())) . '</h5>';
                    } else {
                        echo '<h5 class="round">' . T("PaymentWizard", "You have no protection left") . '</h5>';
                    }
                    ?>
                    <br/>
                    <?php
                    foreach ($config->extraSettings->moreProtection->packages as $index => $package) {
                        if (!$package['enabled']) continue;
                        echo buildFeature('moreProtection' . $index, $package['coins'], false, $package['duration']);
                    }
                    echo '<h5 class="warning">' . sprintf(T("PaymentWizard", "You can buy %s hour(s) of protection per day"), $config->extraSettings->moreProtection->maxPerDay) . '</h5>';
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
