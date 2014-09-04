<?php

/**
 * @package   Kontor4
 * @copyright KONTOR4, Agentur für neue Medien 2014 <info@kontor4.de>
 * @license   For the full copyright and license information, please view the
 *            license.txt file that was distributed with this source code.
 */

$GLOBALS['TL_DCA']['tl_module']['palettes']['c2a'] = '
    {title_legend},name,type;
    {app_legend},appsettings,pagesettings;';

$GLOBALS['TL_DCA']['tl_module']['fields']['appsettings'] = array(
    'label'      => &$GLOBALS['TL_LANG']['tl_c2a_settings']['appsettings'],
    'inputType'  => 'select',
    'foreignKey' => 'tl_c2a_settings.title',
    'eval'       => array('includeBlankOption' => true, "chosen" => true),
    'sql'        => "varchar(5) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['pagesettings'] = array(
    'label'            => &$GLOBALS['TL_LANG']['tl_c2a_settings']['pagesettings'],
    'inputType'        => 'select',
    'options_callback' => array('Kontor4\\c2aHelper', 'getRootPages'),
    'eval'             => array('includeBlankOption' => true, "chosen" => true),
    'sql'              => "varchar(5) NOT NULL default ''"
);
