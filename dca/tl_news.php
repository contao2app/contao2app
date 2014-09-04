<?php

/**
 * @package   Kontor4
 * @copyright KONTOR4, Agentur für neue Medien 2014 <info@kontor4.de>
 * @license   For the full copyright and license information, please view the
 *            license.txt file that was distributed with this source code.
 */

$GLOBALS['TL_DCA']['tl_news']['fields']['headline'] = array_merge(
    $GLOBALS['TL_DCA']['tl_news']['fields']['headline'], array('wizard' => array(array('NewsWizard', 'pushWizard')))
);

class NewsWizard extends Backend {

    public function pushWizard(DataContainer $dc){
        // dump($dc->activeRecord);exit;
        return ' <a href="contao/main.php?do=push&amp;pushId='.$dc->id.'&amp;pushTable=' . $dc->table . '&amp;popup=1&amp;nb=1&amp;rt=' . REQUEST_TOKEN . '" title="Rufen Sie den Push-Wizard auf." style="padding-left:3px" onclick="Backend.openModalIframe({\'width\':765,\'title\':\'Neuigkeiten pushen\',\'url\':this.href});return false">' . Image::getHtml('system/modules/y-contao2app/assets/images/pushbutton.png', $GLOBALS['TL_LANG']['tl_content']['editalias'][0], 'style="vertical-align:top"') . '</a>';
    }
}
