<?php
/**
 * @package anchorsaway
 * @subpackage plugin
 */

namespace TreehillStudio\AnchorsAway\Plugins\Events;

use TreehillStudio\AnchorsAway\Plugins\Plugin;

class OnWebPagePrerender extends Plugin
{
    public function process()
    {
        $resouce = $this->modx->resource;
        if ($resouce->get('id') != $this->modx->config['site_start']) {
            $pattern = '/(href=([\'"]))(#.*?\2)/';
            if ($this->anchorsaway->getOption('debug')) {
                $count = preg_match_all($pattern, $resouce->_output);
                $this->modx->log(\xPDO::LOG_LEVEL_ERROR, $this->modx->lexicon('anchorsaway.log_message', [
                    'count' => $count,
                    'id' => $resouce->get('id')
                ]));
            }
            $requestParameter = $this->modx->request->getParameters();
            if ($resouce->getProperty('generate_url', 'anchorsaway', '1') === '1') {
                $replacement = '$1' . $this->modx->makeUrl($resouce->get('id'), $resouce->get('context_key'), $requestParameter) . '$3';
            } else {
                $replacement = '$1' . str_replace('$', '\$', $this->modx->stripTags($_REQUEST[$this->modx->getOption('request_param_alias')])) . '$3';
            }
            if ($this->anchorsaway->getOption('add_data_anchor')) {
                $replacement .= ' data-anchor=$2$3';
            }
            $resouce->_output = preg_replace($pattern, $replacement, $resouce->_output);
        }
    }
}
