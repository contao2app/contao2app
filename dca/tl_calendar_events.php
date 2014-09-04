<?php

/**
 * @package   Kontor4
 * @copyright KONTOR4, Agentur für neue Medien 2014 <info@kontor4.de>
 * @license   For the full copyright and license information, please view the
 *            license.txt file that was distributed with this source code.
 */

$GLOBALS['TL_DCA']['tl_calendar_events']['palettes']['default'] = str_replace(
    'endDate;',
    'endDate,ignoreDynamic;',
    $GLOBALS['TL_DCA']['tl_calendar_events']['palettes']['default']
);

$GLOBALS['TL_DCA']['tl_calendar_events']['palettes']['default'] = str_replace(
    ",location,",
    ",location,strasse,plz,ort,land,status,",
   $GLOBALS['TL_DCA']['tl_calendar_events']['palettes']['default']
);

$GLOBALS['TL_DCA']['tl_calendar_events']['fields'] = array_merge(
    $GLOBALS['TL_DCA']['tl_calendar_events']['fields'], array(

        'ignoreDynamic' => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['ignoreDynamics'],
            'inputType' => 'checkbox',
            'eval'      => array('tl_class'=>'w50 m12'),
            'sql'       => "char(1) NULL"
        ),

        'strasse'  => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['strasse'],
            'inputType' => 'text',
            'eval'      => array( 'maxlength' => 255, 'tl_class' => 'w50' ),
            'sql'       => "varchar(255) NULL"
        ),

        'plz'  => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['plz'],
            'inputType' => 'text',
            'eval'      => array( 'maxlength' => 10, 'tl_class' => 'w50' ),
            'sql'       => "varchar(10) NULL"
        ),

        'ort'  => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['ort'],
            'inputType' => 'text',
            'eval'      => array( 'maxlength' => 255, 'tl_class' => 'w50' ),
            'sql'       => "varchar(255) NULL"
        ),

        'land'  => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['land'],
            'inputType' => 'select',
            'options'   => \System::getCountries(),
            'default'   => "de",
            'eval'      => array( 'maxlength' => 255, 'chosen' => true, 'tl_class' => 'w50' ),
            'sql'       => "varchar(255) NULL"
        ),
    )
);
