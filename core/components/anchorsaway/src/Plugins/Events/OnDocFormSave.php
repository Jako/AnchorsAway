<?php
/**
 * @package anchorsaway
 * @subpackage plugin
 */

namespace TreehillStudio\AnchorsAway\Plugins\Events;

use modResource;
use TreehillStudio\AnchorsAway\Plugins\Plugin;

class OnDocFormSave extends Plugin
{
    public function process()
    {
        /** @var modResource $resource */
        $resource = $this->scriptProperties['resource'];

        $generateUrl = $resource->get('generate_url');
        $generateUrl = ($generateUrl === 'true' || $generateUrl === true || $generateUrl === '1' || $generateUrl === 1);
        $resource->setProperty('generate_url', $generateUrl ? '1' : '0', 'anchorsaway');

        $resource->save();
    }
}
