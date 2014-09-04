<?php

/**
 * @package   Kontor4
 * @copyright KONTOR4, Agentur für neue Medien 2014 <info@kontor4.de>
 * @license   For the full copyright and license information, please view the
 *            license.txt file that was distributed with this source code.
 */

namespace Kontor4;

class c2aEmulator extends \BackendModule
{

    protected $strTemplate = 'mod_emu';

    protected function compile() {
        $this->Template->content = '';
        $this->Template->action  = \Environment::get('indexFreeRequest');
        $this->Template->href    = $this->getReferer(true);
        $this->Template->title   = specialchars($GLOBALS['TL_LANG']['MSC']['backBTTitle']);
        $this->Template->button  = $GLOBALS['TL_LANG']['MSC']['backBT'];

        $res = \Database::getInstance()->query("SELECT * FROM `tl_module` WHERE type = 'c2a'")->fetchAllAssoc();
        $url = "";

        if ($res) {
            $url = substr(\Environment::get('base'), 0, -1);
        } else {
            $url = "http://demo.contao2app.de";
        }
        $this->Template->url = $url;
    }
}
