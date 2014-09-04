<?php

/**
 * @package   Kontor4
 * @copyright KONTOR4, Agentur für neue Medien 2014 <info@kontor4.de>
 * @license   For the full copyright and license information, please view the
 *            license.txt file that was distributed with this source code.
 */

$GLOBALS['TL_DCA']['tl_article']['fields']['published']['eval'] = array_merge(
    $GLOBALS['TL_DCA']['tl_article']['fields']['published']['eval'], array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_article']['fields']['title'] = array_merge(
    $GLOBALS['TL_DCA']['tl_article']['fields']['title'], array('wizard' => array(array('wizard', 'pushWizard')))
);

$GLOBALS['TL_DCA']['tl_article']['palettes']['default'] = str_replace(',published,', ',published,inAppPublished;', $GLOBALS['TL_DCA']['tl_article']['palettes']['default']);


$GLOBALS['TL_DCA']['tl_article']['fields'] = array_merge(
    $GLOBALS['TL_DCA']['tl_article']['fields'], array(
        'inAppPublished' => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_c2a_settings']['articleInAppPublished'],
            'inputType' => 'checkbox',
            'eval'      => array('tl_class' => 'w50'),
            'sql'       => "char(1) NOT NULL default ''"
        ),
    )
);

class wizard extends Backend {

    public function pushWizard(DataContainer $dc){
        return ' <a href="contao/main.php?do=push&amp;pushId='.$dc->id.'&amp;pushTable=' . $dc->table . '&amp;popup=1&amp;nb=1&amp;rt=' . REQUEST_TOKEN . '" title="Rufen Sie den Push-Wizard auf." style="padding-left:3px" onclick="Backend.openModalIframe({\'width\':765,\'title\':\'Neuigkeiten pushen\',\'url\':this.href});return false">' . Image::getHtml('system/modules/y-contao2app/assets/images/pushbutton.png', $GLOBALS['TL_LANG']['tl_content']['editalias'][0], 'style="vertical-align:top"') . '</a>';
    }
}
