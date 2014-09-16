<?php

/**
 * @package   Kontor4
 * @copyright KONTOR4, Agentur für neue Medien 2014 <info@kontor4.de>
 * @license   For the full copyright and license information, please view the
 *            license.txt file that was distributed with this source code.
 */

$GLOBALS['TL_DCA']['tl_c2a_settings'] = array (
    'config' => array (
        'dataContainer'    => 'Table',
        'enableVersioning' => true,
        'sql' => array (
            'keys' => array (
                'id' => 'primary'
            )
        )
    ),

    'list' => array (
        'sorting' => array (
            'mode'   => 2,
            'fields' => array('title'),
            'flag'   => 1
        ),

        'label' => array (
            'fields' => array('title'),
            'format' => '%s'
        ),

        'operations' => array (
            'edit' => array (
                'label' => &$GLOBALS['TL_LANG']['tl_c2a_settings']['edit'],
                'href'  => 'act=edit',
                'icon'  => 'edit.gif'
            ),

            'delete' => array (
                'label'      => &$GLOBALS['TL_LANG']['tl_c2a_settings']['delete'],
                'href'       => 'act=delete',
                'icon'       => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
        )
    ),

    'palettes' => array (
        '__selector__' => array('eventManager', 'newsManager'),
        'default'      => 'title;{logo_legend:hide},logo;{menue_legend:hide},menue;{farbe_legend:hide},primaerfarbe,sekundaerfarbe,navigationFarbe,menuFarbe,farbeFliesstext,farbeUeberschrift1,farbeUeberschrift2,cssStyle,external;{extras_legend:hide},sprache,kommentareErlauben,newsManager,eventManager;{teaser_legend:hide},teaserSelection;{appPushEinstellungen_legend:hide},appSchluessel,pushSchluessel,pushUrl;'
    ),

    'subpalettes' => array (
        'eventManager' => 'calendar,eventFormat',
        'newsManager'  => 'news,newsFormat'
    ),

    'fields' => array (

        'id'     => array (
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),

        'tstamp' => array (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),

        'sorting'   => array (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),

        'title'  => array (
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['title'],
            'inputType' => 'text',
            'sorting'   => true,
            'flag'      => 1,
            'filter'    => true,
            'search'    => true,
            'sql'       => "varchar(255) NOT NULL default ''",
            'eval'      => array (
                'mandatory' => true,
                'maxlength' => 255,
                'unique'    => true,
                'tl_class'  => 'w50'
            ),
        ),

        'logo' => array (
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['logo'],
            'inputType' => 'fileTree',
            'flag'      => 1,
            'sql'       => "binary(16) NULL",
            'eval'      => array (
                'files'     => true,
                'filesOnly' => true,
                'fieldType' => 'radio',
                'tl_class'  => 'long'
            ),
        ),

        'primaerfarbe' => array (
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['primaerfarbe'],
            'inputType' => 'text',
            'eval'      => array('tl_class' => 'w50', 'colorpicker' => true),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),

        'sekundaerfarbe' => array (
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['sekundaerfarbe'],
            'inputType' => 'text',
            'eval'      => array('tl_class' => 'w50', 'colorpicker' => true),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),

        'navigationFarbe' => array (
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['navigationFarbe'],
            'inputType' => 'text',
            'eval'      => array('tl_class' => 'w50', 'colorpicker' => true),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),

        'menuFarbe' => array (
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['menuFarbe'],
            'inputType' => 'text',
            'eval'      => array('tl_class' => 'w50', 'colorpicker' => true),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),

        'farbeFliesstext' => array (
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['farbeFliesstext'],
            'inputType' => 'text',
            'eval'      => array('tl_class' => 'w50', 'colorpicker' => true),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),

        'farbeUeberschrift1' => array (
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['farbeUeberschrift1'],
            'inputType' => 'text',
            'eval'      => array('tl_class' => 'w50', 'colorpicker' => true),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),

        'farbeUeberschrift2' => array (
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['farbeUeberschrift2'],
            'inputType' => 'text',
            'eval'      => array('tl_class' => 'w50', 'colorpicker' => true),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),

        'cssStyle' => array (
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['cssStyle'],
            'inputType' => 'textarea',
            'eval'      => array('allowHtml' => true, 'tl_class' => 'clr'),
            'sql'       => "text NULL"
        ),

        'external' => array (
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['external'],
            'inputType' => 'fileTree',
            'sql'       => "blob NULL",
            'eval'      => array (
                'multiple'   => true,
                'fieldType'  => 'checkbox',
                'orderField' => 'orderExt',
                'filesOnly'  => true,
                'extensions' => 'css'
            ),
        ),

        'orderExt' => array (
            'label' => &$GLOBALS['TL_LANG']['tl_layout']['orderExt'],
            'sql'   => "blob NULL"
        ),

        'sprache' => array (
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['sprache'],
            'inputType' => 'select',
            'options'   => array("Deutsch"),
            'eval'      => array('tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),

        'kommentareErlauben' => array (
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['kommentareErlauben'],
            'inputType' => 'checkbox',
            'eval'      => array('tl_class' => 'w50 m12'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),

        'eventManager' => array (
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['eventManager'],
            'inputType' => 'checkbox',
            'eval'      => array('tl_class' => 'clr long', 'submitOnChange' => true),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),

        'eventFormat' => array (
            'label'            => &$GLOBALS['TL_LANG']['tl_c2a_settings']['eventFormat'],
            'default'          => 'next_all',
            'exclude'          => true,
            'inputType'        => 'select',
            'options_callback' => array('Format', 'getEventFormats'),
            'reference'        => &$GLOBALS['TL_LANG']['tl_c2a_settings'],
            'eval'             => array('tl_class'=>'w50'),
            'sql'              => "varchar(32) NOT NULL default ''"
        ),

        'calendar' => array (
            'label'      => &$GLOBALS['TL_LANG']['tl_c2a_settings']['calendar'],
            'inputType'  => 'select',
            'foreignKey' => "tl_calendar.title",
            'eval'       => array('tl_class' => 'w50', "includeBlankOption"=>true),
            'sql'        => "varchar(255) NOT NULL default ''"
        ),

        'newsManager' => array (
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['newsManager'],
            'inputType' => 'checkbox',
            'eval'      => array('tl_class' => 'clr long', 'submitOnChange' => true),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),

        'news' => array (
            'label'      => &$GLOBALS['TL_LANG']['tl_c2a_settings']['news'],
            'inputType'  => 'select',
            'foreignKey' => "tl_news_archive.title",
            'eval'       => array('tl_class' => 'w50', "includeBlankOption" => true),
            'sql'        => "varchar(255) NOT NULL default ''"
        ),

        'newsFormat' => array(
            'label'            => &$GLOBALS['TL_LANG']['tl_c2a_settings']['newsFormat'],
            'exclude'          => true,
            'inputType'        => 'select',
            'options'          => array(1 =>'Nur hervorgehobene Beiträge anzeigen'),
            'eval'             => array('includeBlankOption' => true, 'tl_class'=>'w50'),
            'sql'              => "varchar(32) NOT NULL default ''"
        ),

        'teaserSelection' => array (
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['teaserSelection'],
            'inputType' => 'multiColumnWizard',
            'sql'       => "blob NOT NULL",
            'eval'      => array (
                'columnFields' => array (
                    'teaser' => array (
                        'label'            => &$GLOBALS['TL_LANG']['tl_c2a_settings']['teaser'],
                        'exclude'          => true,
                        'inputType'        => 'select',
                        'options_callback' => array('Kontor4\c2aHelper', 'getTeaserOptions'),
                        'eval'             => array (
                            'style'              => 'width:350px',
                            'chosen'             => true,
                            'tl_class'           => 'w50',
                            'includeBlankOption' => true,
                        ),
                    ),
                ),
            ),
        ),

        'appSchluessel' => array (
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['appSchluessel'],
            'inputType' => 'text',
            'eval'      => array('tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),

        'pushSchluessel' => array (
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['pushSchluessel'],
            'inputType' => 'text',
            'eval'      => array('tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),

        'pushUrl' => array (
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['pushUrl'],
            'inputType' => 'text',
            'eval'      => array('tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
    )
);

class Format extends \Backend {

    public function getEventFormats(DataContainer $dc) {
        return array(
            'cal_upcoming' => array(
                'next_7', 'next_14', 'next_30', 'next_90', 'next_180', 'next_365', 'next_two', 'next_cur_month', 'next_cur_year', 'next_next_month', 'next_next_year', 'next_all'
            ),
        );
    }
}
