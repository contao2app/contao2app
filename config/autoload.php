<?php

/**
 * @package   Kontor4
 * @copyright KONTOR4, Agentur für neue Medien 2014 <info@kontor4.de>
 * @license   For the full copyright and license information, please view the
 *            license.txt file that was distributed with this source code.
 */

ClassLoader::addNamespaces(array (
    'Kontor4',
));

ClassLoader::addClasses(array (
    'Kontor4\\c2aEmulator'  => 'system/modules/y-contao2app/controller/c2aEmulator.php',
    'Kontor4\\c2aErrorTrap' => 'system/modules/y-contao2app/controller/c2aErrorTrap.php',
    'Kontor4\\c2aFrontend'  => 'system/modules/y-contao2app/controller/c2aFrontend.php',
    'Kontor4\\c2aHelper'    => 'system/modules/y-contao2app/controller/c2aHelper.php',
    'Kontor4\\c2aHowTo'     => 'system/modules/y-contao2app/controller/c2aHowTo.php',
    'Kontor4\\c2aPush'      => 'system/modules/y-contao2app/controller/c2aPush.php',

    'Kontor4\\c2aModel'     => 'system/modules/y-contao2app/model/c2aModel.php',

));

TemplateLoader::addFiles(array (
    'mod_emu'         => 'system/modules/y-contao2app/templates',
    'mod_howto'       => 'system/modules/y-contao2app/templates',
    'mod_push'        => 'system/modules/y-contao2app/templates',
    'mod_frontend'    => 'system/modules/y-contao2app/templates',
    'kommentar_email' => 'system/modules/y-contao2app/templates',
));
