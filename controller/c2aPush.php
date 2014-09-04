<?php

/**
 * @package   Kontor4
 * @copyright KONTOR4, Agentur für neue Medien 2014 <info@kontor4.de>
 * @license   For the full copyright and license information, please view the
 *            license.txt file that was distributed with this source code.
 */

namespace Kontor4;

/**
 * Klasse zum Aufruf der Urbanairship API
 */
class c2aPush extends \BackendModule
{

    protected $strTemplate = 'mod_push';

    protected $appkey;
    protected $pushsecret;
    protected $pushurl;

    protected function compile() {

        $this->import('BackendUser', 'User');

        $this->Template->content = '';
        $this->Template->action  = \Environment::get('indexFreeRequest');
        $this->Template->href    = $this->getReferer(true);
        $this->Template->title   = specialchars($GLOBALS['TL_LANG']['MSC']['backBTTitle']);
        $this->Template->button  = $GLOBALS['TL_LANG']['MSC']['backBT'];

        $pushId = \Input::get('pushId');
        $pushTable = \Input::get('pushTable');

        if (isset($pushId) && $pushId != "" && isset($pushTable) && $pushTable != "") {
            $this->Template->modal = true;
            $this->Template->entries = $this->getEntry($pushId, $pushTable);
        }

        $this->Template->pushSettings = $this->getSettings();
        $this->Template->articles     = $this->getArticles();
        $this->Template->news         = $this->getNews();
        $this->Template->active       = true;

        if (\Input::post('action') == 'push') {

            $this->getSettings(\Input::post('pushSettings'));

            if (!isset($this->appkey) && !isset($this->pushsecret) && !isset($this->pushurl)) {
                $this->Template->status = '<p class="tl_error">Achtung: Keine Push Einstellungen gewählt.</p>';
            } else {
                $status      = "";
                $pushMessage = \Input::post('pushMessage');
                $pushId      = \Input::post('pushId');
                $pushTable   = \Input::post('pushTable');
                $catId       = array();

                if (isset($pushId) && $pushId != "" && isset($pushTable) && $pushTable != "") {
                    $postId = $pushId;
                    if ($pushTable == "tl_article") {
                        $catId = array(0 => 1);
                        $type = 'article';
                    } else if ($pushTable == "tl_news") {
                        $catId = array(0 => "-98");
                        $type = 'news';
                    } else if ($pushTable == "tl_calendar") {
                        $catId = array(0 => "-1");
                        $type = 'events';
                    }
                } else {
                    $postId = \Input::post('pushPost');

                    if (isset($postId['article']) && $postId['article'] != "") {
                        $postId = $postId['article'];
                        $catId = array(0 => 1);
                        $type = 'article';
                    } else if (isset($postId['news']) && $postId['news'] != "") {
                        $postId = $postId['news'];
                        $catId = array(0 => "-98");
                        $type = 'news';
                    } else if (isset($postId['events']) && $postId['events'] != "") {
                        $postId = $postId['events'];
                        $catId = array(0 => "-1");
                        $type = 'events';
                    }
                }

                if (isset($catId)) {
                    $status = $this->pushAction($catId, $postId, $pushMessage, $type);
                }

                $this->log("ID:" . $postId . " - Nachricht: " . $pushMessage, "Contao2App::pushAction", $status);
            }
        }
    }

    protected function getSettings($pushSettings = 0) {
        $tmpSettings;
        $query       = "SELECT * FROM `tl_c2a_settings` ";
        $resSettings = \Database::getInstance()->query($query);

        if ($resSettings->numRows < 1) {
            $this->Template->status = '<p class="tl_error">Achtung: Keine App Settings vorhanden.</p>';
            $this->Template->active = false;
            $tmpSettings            = false;
        } else {
            $tmpSettings = $resSettings->fetchAllAssoc();
        }

        unset($resSettings);

        if ($pushSettings != 0) {
            $query = "SELECT * FROM `tl_c2a_settings` WHERE id = '{$pushSettings}' ";
            $resSettings  = \Database::getInstance()->query($query);

            if ($resSettings->numRows == 1) {
                $this->appkey     = $resSettings->appSchluessel;
                $this->pushsecret = $resSettings->pushSchluessel;
                $this->pushurl    = $resSettings->pushUrl;
            }
        }
        return $tmpSettings;
    }

    protected function getEntry($id, $table) {

        $query = "SELECT * FROM `{$table}` WHERE id = '{$id}' ";
        $obj = \Database::getInstance()->query($query);

        $queryContent = "SELECT count(*) AS count FROM `tl_content` WHERE pid = '{$id}' AND ptable = '{$table}' ";
        $objContent = \Database::getInstance()->query($queryContent);

        if ((!$obj->inAppPublished && $table != "tl_news") || (!$obj->published && $table == "tl_news")) {
            $this->Template->status = '<p class="tl_error">Noch nicht in der App veröffentlicht.</p>';
        } else if ($objContent->count < 1) {
            $this->Template->status = '<p class="tl_error">Keine Inhalte vorhanden-.</p>';
        } else {
            return $obj->fetchAllAssoc();
        }
    }

    protected function getArticles() {

        $arrArticle = array();
        $query = "  SELECT    a.id, a.pid, a.title, a.inColumn, p.title AS parent
                    FROM      tl_article a
                    LEFT JOIN tl_page p
                    ON        p.id = a.pid
                    WHERE     a.inAppPublished = 1
                    ORDER BY  parent, a.sorting";

        $objArticle = $this->Database->execute($query);

        if ($objArticle->numRows) {
            \System::loadLanguageFile('tl_article');

            while ($objArticle->next()) {
                $key = htmlspecialchars($objArticle->parent . ' (ID ' . $objArticle->pid . ')');

                $arrArticle[$key][$objArticle->id] = htmlspecialchars($objArticle->title . ' (' . ($GLOBALS['TL_LANG']['tl_article'][$objArticle->inColumn] ?: $objArticle->inColumn) . ', ID ' . $objArticle->id . ')');
            }
        }

        return $arrArticle;
    }

    protected function getNews() {

        $arrNews = array();
        $query = "  SELECT      a.id, a.pid, a.headline, p.title AS parent
                    FROM        tl_news a
                    LEFT JOIN   tl_news_archive p
                    ON          p.id = a.pid
                    ORDER BY    parent ";

        $objNews = $this->Database->execute($query);

        if ($objNews->numRows) {
            while ($objNews->next()) {
                $key = htmlspecialchars($objNews->parent . ' (ID ' . $objNews->pid . ')');
                $arrNews[$key][$objNews->id] = htmlspecialchars(html_entity_decode($objNews->headline) . ' (ID ' . $objNews->id . ')');
            }
        }

        return $arrNews;
    }

    protected function getEvents() {

        $arrEvents = array();
        $query = "  SELECT      a.id, a.pid, a.title, p.title AS parent
                    FROM        tl_calendar_events a
                    LEFT JOIN   tl_calendar p
                    ON          p.id = a.pid
                    ORDER BY    parent ";


        $objEvents = $this->Database->execute($query);

        if ($objEvents->numRows) {

            while ($objEvents->next()) {
                $key = htmlspecialchars($objEvents->parent . ' (ID ' . $objEvents->pid . ')');

                $arrEvents[$key][$objEvents->id] = htmlspecialchars(html_entity_decode($objEvents->title) . ' (ID ' . $objEvents->id . ')');
            }
        }

        return $arrEvents;
    }

    protected function pushAction($cat, $postId, $pushMessage, $type) {
        $status = "";

        if (is_array($cat) && count($cat) > 0) {

            foreach ($cat as $k => $v) {
                $cat[$k] = (string)($v);
            }

            $tag['tag']  = $cat;
            $tag2['tag'] = array(\Environment::get('base'));

            $iosContent                             = array();
            $iosContent['alert']                    = $pushMessage;
            $iosContent['badge']                    = "+1";
            $iosExtraContent                        = array();
            $iosExtraContent['articleHierarchyIDs'] = array((int) $cat[0], (int) $postId);
            $iosExtraContent['type']                = $type;
            $iosContent['extra']                    = $iosExtraContent;

            $androidContent                             = array();
            $androidContent['alert']                    = $pushMessage;
            $androidExtraContent                        = array();
            $androidExtraContent['articleHierarchyIDs'] = '[' . ((int) $cat[0]) . ',' . ((int) $postid) . ']';
            $androidExtraContent['type']                = $type;
            $androidContent['extra']                    = $androidExtraContent;

            $alertContent            = array();
            $alertContent['ios']     = $iosContent;
            $alertContent['android'] = $androidContent;

            $audience['AND']         = array( $tag2 );
            $push                    = array("audience" => $audience);

            $push['notification']    = $alertContent;
            $push['device_types']    = array('ios', 'android');

            $json                    = json_encode($push);

            $session = curl_init($this->pushurl);

            curl_setopt($session, CURLOPT_USERPWD, $this->appkey . ':' . $this->pushsecret);
            curl_setopt($session, CURLOPT_POST, True);
            curl_setopt($session, CURLOPT_POSTFIELDS, $json);
            curl_setopt($session, CURLOPT_HEADER, False);
            curl_setopt($session, CURLOPT_RETURNTRANSFER, True);
            curl_setopt($session, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Accept: application/vnd.urbanairship+json; version=3;'));

            $content  = curl_exec($session);
            $response = curl_getinfo($session);

            $dumpContent = print_r(json_decode($content, true), true);
            $dumpResponse = print_r($response, true);

            if ($response['http_code'] != '202') {
                $this->Template->status .=  '<p class="tl_error">Server-Antwort:<pre>Content:' . "\n" . $dumpContent . "\n" . 'Response:' . "\n" . $dumpResponse . '</pre></p>';
                $status = TL_ERROR;
            } else {
                $this->Template->status .= '<p class="tl_confirm">Server-Antwort:<pre>Content:' . "\n" . $dumpContent . "\n" . 'Response:' . "\n" . $dumpResponse . '</pre></p>';
                $status = TL_GENERAL;
            }

            curl_close($session);
            // dump($content, $response);exit;
        } else {
            $this->Template->status .= '<p class="tl_error">Feed Error!</p>';
            $status = TL_ERROR;
        }

        return $status;
    }
}
