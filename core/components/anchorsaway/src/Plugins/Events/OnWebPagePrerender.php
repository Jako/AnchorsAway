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
        if ($this->modx->resource->get('id') != $this->modx->config['site_start']) {
            $pattern = '/(href=([\'"]))(#.*?\2)/';
            if ($this->anchorsaway->getOption('debug')) {
                $count = preg_match_all($pattern, $this->modx->resource->_output);
                $this->modx->log(\xPDO::LOG_LEVEL_ERROR, $this->modx->lexicon('anchorsaway.log_message', [
                    'count' => $count,
                    'id' => $this->modx->resource->get('id')
                ]));
            }
            $replacement = '$1' . $this->modx->makeUrl($this->modx->resource->get('id')) . '$3';
            if ($this->anchorsaway->getOption('add_data_anchor')) {
                $replacement .= ' data-anchor=$2$3';
            }
            $this->modx->resource->_output = preg_replace($pattern, $replacement, $this->modx->resource->_output);
        }
    }
}
