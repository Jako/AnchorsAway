<?php
/**
 * AnchorsAway Plugin
 *
 * @package anchorsaway
 * @subpackage plugin
 *
 * @var modX $modx
 * @var array $scriptProperties
 */

$className = 'TreehillStudio\AnchorsAway\Plugins\Events\\' . $modx->event->name;

$corePath = $modx->getOption('anchorsaway.core_path', null, $modx->getOption('core_path') . 'components/anchorsaway/');
/** @var AnchorsAway $anchorsaway */
$anchorsaway = $modx->getService('anchorsaway', 'AnchorsAway', $corePath . 'model/anchorsaway/', [
    'core_path' => $corePath
]);

if ($anchorsaway) {
    if (class_exists($className)) {
        $handler = new $className($modx, $scriptProperties);
        if (get_class($handler) == $className) {
            $handler->run();
        } else {
            $modx->log(xPDO::LOG_LEVEL_ERROR, $className. ' could not be initialized!', '', 'AnchorsAway Plugin');
        }
    } else {
        $modx->log(xPDO::LOG_LEVEL_ERROR, $className. ' was not found!', '', 'AnchorsAway Plugin');
    }
}

return;