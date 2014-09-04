<?php

/**
 * @package   Kontor4
 * @copyright KONTOR4, Agentur für neue Medien 2014 <info@kontor4.de>
 * @license   For the full copyright and license information, please view the
 *            license.txt file that was distributed with this source code.
 */


$GLOBALS['TL_DCA']['tl_calendar']['palettes']['default'] = str_replace(
    'jumpTo;',
    'jumpTo,thumb;',
    $GLOBALS['TL_DCA']['tl_calendar']['palettes']['default']
);

$GLOBALS['TL_DCA']['tl_calendar']['fields'] = array_merge(
    $GLOBALS['TL_DCA']['tl_calendar']['fields'], array(

        'thumb' => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['thumb'],
            'inputType' => 'fileTree',
            'eval'      => array('filesOnly'=>true, 'fieldType'=>'radio', 'tl_class'=>'clr'),
            'sql'       => "binary(16) NULL",
        )
    )
);
