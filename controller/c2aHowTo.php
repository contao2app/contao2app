<?php

/**
 * @package   Kontor4
 * @copyright KONTOR4, Agentur für neue Medien 2014 <info@kontor4.de>
 * @license   For the full copyright and license information, please view the
 *            license.txt file that was distributed with this source code.
 */

namespace Kontor4;

class c2aHowTo extends \BackendModule
{
    protected $strTemplate = 'mod_howto';

    protected function compile() {
        $this->Template->content = '';
        $this->Template->action  = \Environment::get('indexFreeRequest');
        $this->Template->href    = $this->getReferer(true);
        $this->Template->title   = specialchars($GLOBALS['TL_LANG']['MSC']['backBTTitle']);
        $this->Template->button  = $GLOBALS['TL_LANG']['MSC']['backBT'];

        $this->Template->qr = $this->getTheQRCode();
    }

    protected function getTheQRCode() {

        return 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=blappsta://?url=' . substr(\Environment::get('base'), 0, -1) . '&choe=UTF-8" alt="blappsta://?url=' . substr(\Environment::get('base'), 0, -1);
    }
}
