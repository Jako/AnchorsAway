<?php
/**
 * Abstract plugin
 *
 * @package anchorsaway
 * @subpackage plugin
 */

namespace TreehillStudio\AnchorsAway\Plugins;

use modX;
use AnchorsAway;

/**
 * Class Plugin
 */
abstract class Plugin
{
    /** @var modX $modx */
    protected $modx;
    /** @var AnchorsAway $anchorsaway */
    protected $anchorsaway;
    /** @var array $scriptProperties */
    protected $scriptProperties;

    /**
     * Plugin constructor.
     *
     * @param $modx
     * @param $scriptProperties
     */
    public function __construct($modx, &$scriptProperties)
    {
        $this->scriptProperties = &$scriptProperties;
        $this->modx = &$modx;
        $corePath = $this->modx->getOption('anchorsaway.core_path', null, $this->modx->getOption('core_path') . 'components/anchorsaway/');
        $this->anchorsaway = $this->modx->getService('anchorsaway', 'AnchorsAway', $corePath . 'model/anchorsaway/', [
            'core_path' => $corePath
        ]);
    }

    /**
     * Run the plugin event.
     */
    public function run()
    {
        $init = $this->init();
        if ($init !== true) {
            return;
        }

        $this->process();
    }

    /**
     * Initialize the plugin event.
     *
     * @return bool
     */
    public function init(): bool
    {
        return true;
    }

    /**
     * Process the plugin event code.
     *
     * @return mixed
     */
    abstract public function process();
}