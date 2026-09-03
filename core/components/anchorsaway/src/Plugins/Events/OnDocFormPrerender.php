<?php
/**
 * @package anchorsaway
 * @subpackage plugin
 */

namespace TreehillStudio\AnchorsAway\Plugins\Events;

use modResource;
use TreehillStudio\AnchorsAway\Plugins\Plugin;

class OnDocFormPrerender extends Plugin
{
    public function process()
    {
        $this->modx->controller->addLexiconTopic('anchorsaway:default');

        if ($this->modx->user && $this->modx->user->hasSessionContext('mgr')) {
            $assetsUrl = $this->anchorsaway->getOption('assetsUrl');
            $jsUrl = $this->anchorsaway->getOption('jsUrl') . 'mgr/';
            $jsSourceUrl = $assetsUrl . '../../../source/js/mgr/';

            $this->modx->controller->addLexiconTopic('anchorsaway:default');

            if ($this->anchorsaway->getOption('debug') && ($this->anchorsaway->getOption('assetsUrl') != MODX_ASSETS_URL . 'components/anchorsaway/')) {
                $this->modx->controller->addJavascript($jsSourceUrl . 'anchorsaway.js?v=v' . $this->anchorsaway->version);
                $this->modx->controller->addJavascript($jsSourceUrl . 'helper/combo.js?v=v' . $this->anchorsaway->version);
            } else {
                $this->modx->controller->addJavascript($jsUrl . 'anchorsaway.min.js?v=v' . $this->anchorsaway->version);
            }

            /** @var modResource $resource */
            $resource = $this->modx->controller->resource;
            $generateUrl = $resource->getProperty('generate_url', 'anchorsaway', true);

            $this->modx->controller->addHtml(<<<HTML
<script type="text/javascript">
    var AnchorsAwaySettingLoaded = false;
    MODx.on('ready',function() {
        if (!AnchorsAwaySettingLoaded) {
            var settingsRight = Ext.getCmp('modx-page-settings-right'),
                fld = {
                    xtype: 'anchorsaway-combo-boolean',
                    name: 'generate_url',
                    hiddenName: 'generate_url',
                    fieldLabel: _('anchorsaway.generate_url'),
                    description: _('anchorsaway.generate_url_desc'),
                    value: '$generateUrl',
                    anchor: '100%'
                };
    
            if (settingsRight) {
                settingsRight.add([fld]);
                settingsRight.doLayout();
            }
            AnchorsAwaySettingLoaded = true;
        }
    });
</script>
HTML
            );
        }
    }
}
