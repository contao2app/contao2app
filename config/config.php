<?php

/**
 * @package   Kontor4
 * @copyright KONTOR4, Agentur für neue Medien 2014 <info@kontor4.de>
 * @license   For the full copyright and license information, please view the
 *            license.txt file that was distributed with this source code.
 */

$GLOBALS['BE_MOD']['contao2app']['howto'] = array(
    'callback'  => 'Kontor4\\c2aHowTo',
    'icon'   => 'system/modules/y-contao2app/assets/images/contao2app.gif',
);

$GLOBALS['BE_MOD']['contao2app']['c2a'] = array(
    'tables' => array('tl_c2a_settings'),
    'icon'   => 'system/modules/y-contao2app/assets/images/contao2app.gif',
);

$GLOBALS['BE_MOD']['contao2app']['push'] = array(
    'callback'  => 'c2aPush',
    'icon'   => 'system/modules/y-contao2app/assets/images/contao2app.gif',
);

$GLOBALS['BE_MOD']['contao2app']['emu'] = array(
    'callback'  => 'c2aEmulator',
    'icon'   => 'system/modules/y-contao2app/assets/images/contao2app.gif',
);

array_insert($GLOBALS['FE_MOD']['application'], 0, array
(
    'c2a' => 'c2aFrontend'
));
