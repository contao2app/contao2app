<?php

/**
 * @package   Kontor4
 * @copyright KONTOR4, Agentur für neue Medien 2014 <info@kontor4.de>
 * @license   For the full copyright and license information, please view the
 *            license.txt file that was distributed with this source code.
 */

$GLOBALS['TL_DCA']['tl_page']['fields']['published']['eval'] = array_merge(
    $GLOBALS['TL_DCA']['tl_page']['fields']['published']['eval'], array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_page']['palettes']['regular'] = str_replace(',published,', ',published,inAppPublished,', $GLOBALS['TL_DCA']['tl_page']['palettes']['regular']);

$GLOBALS['TL_DCA']['tl_page']['palettes']['regular'] = str_replace(',description;', ',description,thumb;', $GLOBALS['TL_DCA']['tl_page']['palettes']['regular']);

$GLOBALS['TL_DCA']['tl_page']['fields'] = array_merge(
    $GLOBALS['TL_DCA']['tl_page']['fields'], array(
        'thumb' => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['thumb'],
            'inputType' => 'fileTree',
            'eval'      => array('filesOnly'=>true, 'fieldType'=>'radio', 'tl_class'=>'clr'),
            'sql'       => "binary(16) NULL",
        )
    )
);

$GLOBALS['TL_DCA']['tl_page']['fields'] = array_merge(
    $GLOBALS['TL_DCA']['tl_page']['fields'], array(
        'inAppPublished' => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['inAppPublished'],
            'inputType' => 'checkbox',
            'eval'      => array('tl_class' => 'w50'),
            'sql'       => "char(1) NOT NULL default ''"
        )
    )
);
