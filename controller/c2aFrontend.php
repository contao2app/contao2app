<?php

/**
 * @package   Kontor4
 * @copyright KONTOR4, Agentur für neue Medien 2014 <info@kontor4.de>
 * @license   For the full copyright and license information, please view the
 *            license.txt file that was distributed with this source code.
 */

namespace Kontor4;

class c2aFrontend extends \Module
{

    protected $strTemplate = '';
    protected $c2aVersion = "0.7.9.1";
    protected $settings;
    protected $request = array();
    protected $lang_de = array(
        'Menu' => 'Menü',
        'Please wait...' => 'Bitte warten…',
        'The data are updated' => 'Die Daten werden aktualisiert',
        'More' => 'Mehr',
        'all-day' => 'ganztägig',
        'Tip' => 'Hinweis',
        'This feed has been deleted' => 'Dieser Feed wurde gelöscht',
        'The event has been removed from the calendar.' => 'Die Veranstaltung wurde aus dem Kalender entfernt.',
        'The event was added to the calendar.' => 'Die Veranstaltung wurde dem Kalender hinzugefügt.',
        'Today' => 'Heute',
        'Yesterday' => 'Gestern',
        'The day before yesterday' => 'Vorgestern',
        'This week' => 'Diese Woche',
        'Last week' => 'Letzte Woche',
        'The week before last' => 'Vorletzte Woche',
        'Last month' => 'Letzter Monat',
        'This month' => 'Dieser Monat',
        'Second last month' => 'Vorletzter Monat',
        'Before two months' => 'Vorvorletzter Monat',
        'This year' => 'Dieses Jahr',
        'Last year' => 'Letztes Jahr',
        'Older than last year' => 'Älter als letztes Jahr',
        'Tomorrow' => 'Morgen',
        'The day after tomorrow' => 'Übermorgen',
        'Next week' => 'Nächste Woche',
        'The week after next' => 'Übernächste Woche',
        'Next month' => 'Nächster Monat',
        'Over the next month' => 'Übernächster Monat',
        'Over two months' => 'Überübernächster Monat',
        'Next year' => 'Nächstes Jahr',
        'Later next year' => 'Später als Nächstes Jahr',
        'Cancel' => 'Abbrechen',
        'Finished' => 'Fertig',
        'Comment' => 'Kommentar',
        'Show' => 'Anzeigen',
        'Comments' => 'Kommentare',
        'required' => 'erforderlich',
        'Name' => 'Name',
        'The e-mail address is not correct' => 'Die E-Mail-Adresse ist nicht korrekt',
        'Please enter your name.' => 'Bitte gib deinen Namen an.',
        'Please enter your comment.' => 'Bitte gib deinen Kommentar an.',
        'Comments are being loaded ...' => 'Kommentare werden geladen...',
        'Clock' => 'Uhr',
        'Welcome to' => 'Willkommen bei',
        'There was an error.' => 'Es ist ein Fehler aufgetreten.',
        'Redeem' => 'Einlösen',
        'Add event to calendar' => 'Veranstaltung zum Kalender hinzufügen',
        'Add to calendar' => "Zum Kalender hinzufügen",
        'Remove event from calendar' => "Veranstaltung vom Kalender entfernen",
        'from' => "von",
        'to' => 'bis',
        'starting at' => 'ab',
        'Reply' => 'Antwort',
        'You have disabled the location services for the app. You can turn them back on in the privacy settings of your device.'=>'Sie haben die Ortungsdienste für die App deaktiviert. Sie können diese in den Einstellungen des Geräts wieder aktivieren.',
        'Login'=>'Anmelden',
        'Logout'=>'Abmelden',
        'Username' => 'Benutzername',
        'Password' => 'Passwort',
        'The input is incomplete' => 'Die Eingabe ist unvollständig',
        'Thanks' => 'Danke',
        'No set up email account.' => 'Kein E-Mail Account eingerichtet.',
        "No set up twitter account." => "Du hast noch keinen Twitter Account auf dem Gerät eingerichtet. Dieser ist für das Sharing notwendig. Bitte gehe zu den Einstellungen -> Twitter und gib Deine Anmeldedaten ein.",
        'Copy link' => 'Link kopieren',
        'Open in Safari' => 'In Safari öffnen',
        'Notifications' => 'Benachrichtigungen',
        'Select which categories to receive push-notifications from:' => 'Wählen Sie die Kategorien, aus der Sie Push-Benachrichtigungen erhalten möchten:',
        'Recent content could not be accessed. Please connect your device to the internet and try again.'=>'Aktuelle Inhalte können gerade leider nicht geladen werden. Bitte überprüfen Sie Ihre Internetverbindung.',
        'No set up facebook account.'=>'Du hast noch keinen Facebook Account auf dem Gerät eingerichtet. Dieser ist für das Sharing notwendig. Bitte gehe zu Einstellungen -> Facebook und gib Deine Anmeldedaten ein.',
        'Settings'=>'Einstellungen',
        'You have not yet set up your Facebook account on this device, which is necessary for sharing. Please go to your iOS Settings > Facebook and enter your login data.'=>'Du hast noch keinen Facebook Account auf dem Gerät eingerichtet. Dieser ist für das Sharing notwendig. Bitte gehe zu Einstellungen -> Facebook und gib Deine Anmeldedaten ein.',
        'You have not yet set up your Twitter account on this device, which is necessary for sharing. Please go to your iOS Settings > Twitter and enter your login data.'=>'Du hast noch keinen Twitter Account auf dem Gerät eingerichtet. Dieser ist für das Sharing notwendig. Bitte gehe zu Einstellungen -> Twitter und gib Deine Anmeldedaten ein.'
    );

    protected function compile() {

        if ($this->appsettings && $this->pagesettings) {

            $this->loadSettings();
            $controller = \Input::get('ynaa');

            if (\Input::get($this->request['action']) == 'add' ) {
                $string = serialize($_POST);
                $this->log("POST: ".$string, "CONTAO2APP", "CONTAO2APP");
                $string = serialize($_GET);
                $this->log("GET: ".$string, "CONTAO2APP", "CONTAO2APP");
                $string = serialize($_REQUEST);
                $this->log("REQUEST: ".$string, "CONTAO2APP", "CONTAO2APP");
            }

            if ($controller) {
                header('Content-Type: application/json');

                $this->log(\Environment::get('request'), "Contao2App::log()", "CONTAO2APP");

                switch ($controller) {
                    case 'settings':
                        echo json_encode($this->settingsController());
                        break;
                    case 'homepresets':
                        echo json_encode( $this->homepresetsController());
                        break;
                    case 'teaser':
                        echo json_encode($this->teaserController());
                        break;
                    case 'categories':
                        echo json_encode($this->categoriesController());
                        break;
                    case 'articles':
                        echo json_encode($this->articlesController());
                        break;
                    case 'article':
                        echo json_encode($this->articleController());
                        break;
                    case 'events':
                        echo json_encode($this->eventsController());
                        break;
                    case 'event':
                        echo json_encode($this->eventController());
                        break;
                    case 'yna_settings':
                        echo json_encode($this->ynaSettingsController());
                        break;
                    case 'comments':
                        echo json_encode($this->commentsController());
                        break;
                    case 'ibeacon':
                        echo json_encode($this->iBeaconController());
                        break;
                    case 'content':
                        header('Content-Type: text/html');
                        echo $this->contentController();
                        break;
                    case '':
                        echo json_encode(array('error' => $this->errorcode(11)));
                        break;
                    default:
                        echo json_encode(array('error' => $this->errorcode()));
                        break;
                }
                exit;
            }

        } else {
            header('Content-Type: application/json');
            echo json_encode(array('error' => $this->errorcode()));
            exit;
        }
    } // compile

    protected function loadSettings() {

        $prefix = \Input::get('nh_prefix');

        if (isset($prefix) && $prefix != "") {
            $prefix .= '_';
        } else {
            $prefix = "";
        }

        $this->request = array(
            'id'          => $prefix . 'id',
            'option'      => $prefix . 'option',
            'ts'          => $prefix . 'ts',
            'sorttype'    => $prefix . 'sorttype',
            'post_id'     => $prefix . 'post_id',
            'post_ts'     => $prefix . 'post_ts',
            'limit'       => $prefix . 'limit',
            'offset'      => $prefix . 'offset',
            'n'           => $prefix . 'n',
            'action'      => $prefix . 'action',
            'key'         => $prefix . 'key',
            'comment'     => $prefix . 'comment',
            'name'        => $prefix . 'name',
            'email'       => $prefix . 'email',
            'comment_id'  => $prefix . 'comment_id',
            'type'        => $prefix . 'type',

            'lang'        => $prefix . 'lang',
            'b'           => $prefix . 'b',
            'h'           => $prefix . 'h',
            'pl'          => $prefix . 'pl',
            'av'          => $prefix . 'av',
            'd'           => $prefix . 'd',

            'tab'         => $prefix . 'tab',
            'cat_include' => $prefix . 'cat_include',
            'meta'        => $prefix . 'meta',
        );

        $this->settings = c2aModel::findByPk($this->appsettings);

        $this->settings['page'] = \PageModel::findPublishedById($this->pagesettings);

        if (!$this->settings['min-img-size-for-resize']) {
            $this->settings['min-img-size-for-resize'] = 100;
        }

        if ($this->settings['logo']) {
            $this->settings['logo'] = $this->getFilePath($this->settings['logo']);
        }

        if ($this->settings['external']) {
            $order = unserialize($this->settings['orderExt']);
            $paths = "";

            foreach ($order as $key => $value) {
                $path  = $this->getFilePath($value);
                $paths .= '<link href="' . $path . '" rel="stylesheet" type="text/css">';
            }
            $this->settings['external'] = $paths;
        }

        $res = \PageModel::findByinAppPublished(1);
        $this->settings['menu'] = $this->checkMenuPagesForContent($res);

        if (count($this->settings['menu']) == 0) {
            header('Content-Type: application/json');
            echo json_encode(array('error' => $this->errorcode(14)));exit;
        }

        $this->settings['homepresets']['items'] = $this->getHomepresetItemsFromMenuItems();

        if (count($this->settings['homepresets']['items']) == 0) {
            header('Content-Type: application/json');
            echo json_encode(array('error' => $this->errorcode(23)));exit;
        }

        if ($this->settings['teaserSelection']) {
            $teaserArray = unserialize($this->settings['teaserSelection']);
            $tmpArr = array();

            if ($teaserArray[0]['teaser'] != "" && isset($teaserArray[0]['teaser'])) {

                foreach ($teaserArray as $key => $value) {
                    if ($value != 0 && $value != "") {
                        $tmpArr[] = $value['teaser'];
                    }
                }
            }

            $this->settings['teaser'] = $tmpArr;
        }

        $this->settings['tstamp'] = $this->checkTimestamp($this->settings['tstamp']);
    } // loadSettings

    protected function checkTimestamp($tstamp = 0) {

        foreach ($this->settings['menu'] as $key => $value) {
            if ($tstamp < $value['tstamp']) {
                $tstamp = $value['tstamp'];
            }
        }

        $queryPage = "SELECT max(tstamp) as ts from tl_page ";
        $arrTsPage = \Database::getInstance()->query($queryPage)->fetchRow();    
        $tsPage = $arrTsPage[0];

        if ($tstamp < $tsPage) {
            $tstamp = $tsPage;
        }

        $queryArticle = "   SELECT    max(a.tstamp)
                            FROM      tl_article a
                            LEFT JOIN tl_page p
                            ON        p.id = a.pid
                            WHERE     a.inAppPublished = 1";

        $arrTsArticle = \Database::getInstance()->query($queryArticle)->fetchRow();
        $tsArticle = $arrTsArticle[0];

        if ($tstamp < $tsArticle) {
            $tstamp = $tsArticle;
        }

        $queryNews = "  SELECT    max(a.tstamp)
                        FROM      tl_news a
                        LEFT JOIN tl_news_archive p
                        ON        p.id = a.pid";

        $arrTsNews = \Database::getInstance()->query($queryNews)->fetchRow();
		$tsNews = $arrTsNews[0];

        if ($tstamp < $tsNews) {
            $tstamp = $tsNews;
        }

        $queryEvents = "SELECT      max(a.tstamp)
                        FROM        tl_calendar_events a
                        LEFT JOIN   tl_calendar p
                        ON          p.id = a.pid";
        $arrTsEvents = \Database::getInstance()->query($queryEvents)->fetchRow();
		$tsEvents = $arrTsEvents[0];

        if ($tstamp < $tsEvents) {
            $tstamp = $tsEvents;
        }

        return $tstamp;
    } // checkTimestamp

    protected function checkMenuPagesForContent($items) {
        $retArr = array();
        $tmpArr = array();
        $time = time();

        foreach ($items as $item) {
            $img = "";

            if ($item->thumb) {
                $img = $this->getFilePath($item->thumb);
            }

            $query = "SELECT id, pid, title, tstamp
                      FROM   `tl_article`
                      WHERE  pid = '{$item->id}'
                      AND    inAppPublished = 1
                      AND    (start = '' OR start < {$time})
                      AND    (stop  = '' OR stop  > {$time})
                      AND    published = 1 " ;

            $resArticles = \Database::getInstance()->query($query)->fetchAllAssoc();

            foreach ($resArticles as $article) {
                $queryContent = "SELECT id, pid, type
                                 FROM   `tl_content`
                                 WHERE  pid = '{$article['id']}'
                                 AND    (invisible != 1
                                 AND    (start = '' OR start < {$time})
                                 AND    (stop = '' OR stop > {$time}))";

                $resContent = \Database::getInstance()->query($queryContent);

                if ($resContent->numRows) {
                    if (!array_key_exists($article['pid'], $tmpArr) ) {
                        $tmpArr[$article['pid']] = array(
                            'title'  => htmlspecialchars_decode($item->title),
                            'id'     => $resContent->pid,
                            'type'   => 'article',
                            'thumb'  => $img,
                            'tstamp' => $item->tstamp,
                        );
                    }
                }
            }
        }

        foreach ($tmpArr as $key => $value) {
            $retArr[] = $value;
        }

        if ($this->settings['eventManager']) {

            $result = \CalendarModel::findByPk($this->settings['calendar']);
            $thumb = "";

            if ($result->thumb) {
                $thumb = $this->getFilePath($result->thumb);
            }

            $retArr[] = array(
                'title'  => "Events",
                'id'     => "-1",
                'type'   => 'events',
                'thumb'  => $thumb,
                'tstamp' => $result->tstamp,
            );
        }

        if ($this->settings['newsManager']) {
            $result = \NewsArchiveModel::findByPk($this->settings['news']);
            $thumb  = "";

            $this->settings['news_moderate'] = $result->moderate;

            if ($result->thumb) {
                $thumb = $this->getFilePath($result->thumb);
            }

            $retArr[] = array(
                'title'  => "News",
                'id'     => "-98",
                'type'   => 'cat',
                'thumb'  => $thumb,
                'tstamp' => $result->tstamp,
            );
        }
        return $retArr;
    } // checkMenuPagesForContent

    protected function getHomepresetItemsFromMenuItems() {
        $tmpItemArray = array();
        $i = 0;

        foreach($this->settings['menu'] as $key => $value) {
            $tmpItemArray[$key] = array (
                'img'         => $value['thumb'],
                'title'       => $value['title'],
                'allowRemove' => 0,
                'id'          => $value['id'],
                'type'        => $value['type'],
                'tstamp'      => $value['tstamp'],
                'id2'         => ++$i,
            );
        }
        return $tmpItemArray;
    } // getHomepresetItemsFromMenuItems

    protected function settingsController() {

        $getTs = \Input::get($this->request['ts']);
        $ts = (isset($getTs) && $getTs != null) ? $getTs : 0;

        $returnarray['error']          = $this->errorcode(0);
        $returnarray['url']            = \Environment::get('base');
        $returnarray['plugin_version'] = $this->c2aVersion;
        $returnarray['version']        = "Contao " . VERSION . "." . BUILD;
        $returnarray['charset']        = "UTF-8";
        $returnarray['html_type']      = "text/html";

        if ($ts < $this->settings['tstamp']) {

            $returnarray['sort']           = 1;
            $returnarray['homescreentype'] = 0;
            $returnarray['sorttype']       = 'recent';

            if ($this->settings['uuid']) {
                $ibeacon = $this->iBeaconController();
                $returnarray['ibeacon'] = $ibeacon['ibeacon'];
            }

            $ts = $this->settings['tstamp'];
            $this->settings['sort'] = ($this->settings['sort']) ? 1 : 0;

            if ($this->settings['sprache'] == "Deutsch") {
                $returnarray['lang'] = "de";
                $returnarray['lang_array'] = $this->lang_de;
            } else {
                $returnarray['lang'] = "en";

                foreach($this->lang_de as $key => $value) {
                    $lang_en[$key] = $key;
                }

                $returnarray['lang_array'] = $lang_en;
            }

            $returnarray['changes']           = 1;
            $returnarray['color-01']          = ($this->settings['primaerfarbe'])       ? "#" . $this->settings['primaerfarbe']         : "";
            $returnarray['color-02']          = ($this->settings['sekundaerfarbe'])     ? "#" . $this->settings['sekundaerfarbe']       : "";
            $returnarray['color-navbar']      = ($this->settings['navigationFarbe'])    ? "#" . $this->settings['navigationFarbe']      : "";
            $returnarray['color-menu']        = ($this->settings['menuFarbe'])          ? "#" . $this->settings['menuFarbe']            : "";
            $returnarray['color-text']        = ($this->settings['farbeFliesstext'])    ? "#" . $this->settings['farbeFliesstext']      : "";
            $returnarray['color-headline']    = ($this->settings['farbeUeberschrift1']) ? "#" . $this->settings['farbeUeberschrift1']   : "";
            $returnarray['color-subheadline'] = ($this->settings['farbeUeberschrift2']) ? "#" . $this->settings['farbeUeberschrift2']   : "";

            $returnarray['logoUrl'] = ($this->settings['logo']) ? $this->settings['logo'] : "";

            $returnarray['hasCategories']   = 1;
            $returnarray['menuIsSectioned'] = 0;
            $returnarray['categories']      = 1;
            $returnarray['allowreorder']    = 1;
            $returnarray['comments'] = ($this->settings['kommentareErlauben']) ? $this->settings['kommentareErlauben'] : 0;

            $returnarray['style'] = '<style type="text/css">body { color:#' . $this->settings['farbeFliesstext'] . '; }' . html_entity_decode($this->settings['cssStyle']) . '</style>';

            if ($this->settings['menu']) {
                $returnarray['menu'] = $this->getMenuPages($this->settings['menu']);
            } else {
                $returnarray['menu']['error'] = $this->errorcode(14);
            }

        } else {
            $returnarray['changes'] = 0;
        }

        $returnarray['timestamp'] = $this->checkTimestamp($ts);
        return array('settings' => $returnarray);
    } // settingsController

    protected function iBeaconController() {

        if (!$this->settings['uuid']) {
            $returnarray['error'] = $this->errorcode(33);
        } else {
            $returnarray['uuid'] = $this->settings['uuid'];

            if ($this->settings['welcome']) {
                $returnarray['welcome'] = $this->settings['welcome'];
            }

            if ($this->settings['silent']) {
                $returnarray['silent'] = $this->settings['silent'];
            }

            $returnarray['identifier'] = 'Beacon1';
            $returnarray['content'][] = array();
        }

        return (array('ibeacon' => $returnarray));
    } // iBeaconController

    protected function getMenuPages($arrMenuPageId) {
        $tmpMenuArray = array();
        $i = 0;

        foreach($arrMenuPageId as $key => $value) {
            $tmpMenuArray[$key]['pos']     = ++$i;
            $tmpMenuArray[$key]['type']         = $value['type'];
            $tmpMenuArray[$key]['id']           = $value['id'];
            $tmpMenuArray[$key]['title']        = $value['title'];
            $tmpMenuArray[$key]['ts']           = $value['tstamp'];
            $tmpMenuArray[$key]['item_id']      = $value['id'];
            $tmpMenuArray[$key]['article_type'] = $value['type'];
        }
        return $tmpMenuArray;
    } // getMenuPages

    protected function homepresetsController() {
        $returnarray['error'] = $this->errorcode(0);

        $getTs = \Input::get($this->request['ts']);
        $ts = (isset($getTs)) ? $getTs : 0;

        if ($this->settings['homepresets']['items']) {
            $returnarray['changes'] = 0;

            if ($ts < $this->settings['tstamp']) {
                $returnarray['changes'] = 1;
                $ts = $this->settings['tstamp'];
            }

            if(is_array($this->settings['homepresets']['items']) && count($this->settings['homepresets']['items']) > 0) {
                $returnarray['items'] = $this->getHomepresetsItems($this->settings['homepresets']['items']);
            } else {
                $returnarray['error'] = $this->errorcode(23);
            }

            if (!isset($returnarray['items'])) {
                $returnarray['error'] = $this->errorcode(23);
            }

        } else {
            $returnarray['error'] = $this->errorcode(23);
        }

        $returnarray['timestamp'] = $ts;
        return array('homepresets' => $returnarray);
    } // homepresetsController

    protected function getHomepresetsItems($arrHomepresetsItems) {
        $categories   = array();
        $tmpItemArray = array();
        $items        = array();
        $i            = 0;

        foreach ($arrHomepresetsItems as $key => $value) {
            $img               = '';
            $showSubcategories = 0;

            switch ($value['type']) {
                case 'cat':
                    $items = $this->articlesController($value['id'], 1);
                    break;

                case 'events':
                    $event = $this->eventsController(1);

                    if ($event){
                        $items = array("articles" => array("items" => array(0 => array(
                            'id'                => $event['events']['items'][0]['id'],
                            'timestamp'         => $event['events']['items'][0]['timestamp'],
                            'publish_timestamp' => $event['events']['items'][0]['publish_timestamp'],
                        ))));
                        $img = $value['img'];
                    }
                    break;

                default:
                    $img = ($value['img']) ? $value['img'] : "";
                    $items = array("articles" => array("items" => array(0 => array(
                        'id'                => $value['id'],
                        'timestamp'         => $value['tstamp'],
                        'publish_timestamp' => $value['tstamp'],
                    ))));
                    $value['type'] = "article";
                    break;
            }
            $img = (!$img) ? $value['img'] : $img;

            $tmpItemArray[$key] = array(
                'pos'               => ++$i,
                'type'              => $value['type'],
                'allowRemove'       => 0,
                'id'                => $value['id'],
                'cat_id'            => (int)$value['id'],
                'title'             => $value['title'],
                'img'               => $img,
                'post_id'           => $value['id'],
                'timestamp'         => ($items['articles']['items'][0]['timestamp']) ? (int)$items['articles']['items'][0]['timestamp'] : 0,
                'publish_timestamp' => ($items['articles']['items'][0]['publish_timestamp']) ? (int)$items['articles']['items'][0]['publish_timestamp'] : 0,
                'showsubcategories' => $showSubcategories,
                'url'               => ($items['articles']['items'][0]['url']) ? $items['articles']['items'][0]['url'] : "",
                'article_type'      => $value['type']
            );
        }

        return $tmpItemArray;
    } // getHomepresetsItems

    protected function teaserController() {
        $returnarray['error'] = $this->errorcode(0);

        $getTs = \Input::get($this->request['ts']);
        $ts = (isset($getTs)) ? $getTs : 0;

        if ($this->settings['teaser']) {
            $returnarray['changes'] = 0;

            if ($ts < $this->settings['tstamp']) {
                $returnarray['changes'] = 1;
                $ts = $this->settings['tstamp'];
            }

            if ( is_array($this->settings['teaser']) && count($this->settings['teaser']) > 0 ) {

                $returnarray['items'] = $this->getTeaserItems($this->settings['teaser']);

            } else {
                $returnarray['error'] = $this->errorcode(18);
            }

            if (!isset($returnarray['items'])) {
                $returnarray['error'] = $this->errorcode(18);
            }
        } else {
            $returnarray['error'] = $this->errorcode(18);
        }

        $returnarray['timestamp'] = $ts;

        if ($returnarray['changes'] == 0 && isset($returnarray['items'])) {
            unset($returnarray['items']);
        }

        return array('teaser' => $returnarray);
    } // teaserController

    protected function getTeaserItems($arrTeaserItems) {

        $tmpItemArray = array();
        $i = 0;
        foreach ($arrTeaserItems as $key => $value) {
            $explodedTeaser = explode(":::", $value);
            $teaserItem     = $this->getTeaserDetail($explodedTeaser);

            if ($teaserItem) {

                if ( $teaserItem['tstamp'] > $ts) {
                    $ts = $teaserItem['tstamp'];
                }

                $tmpItemArray[$key] = array(
                    'pos'          => ++$i,
                    'apectFill'    => 1,
                    'type'         => $teaserItem['type'],
                    'id'           => $teaserItem['pid'],
                    'title'        => htmlspecialchars_decode($teaserItem['title']),
                    'thumb'        => $teaserItem['thumb'],
                    'cat_id'       => "",
                    'post_ts'      => $teaserItem['tstamp'],
                    'article_type' => $teaserItem['article_type']
                );
            }
        }

        return $tmpItemArray;
    } // getTeaserItems

    protected function getTeaserDetail($explode) {
        $retArr       = array();
        $thumb        = "";
        $title        = "";
        $type         = "";
        $article_type = "";
        $tstamp       = 0;

        $query = "SELECT * FROM `{$explode[0]}` WHERE `id` = '" . $explode[1] . "' ";
        $articleRes = \Database::getInstance()->query($query)->fetchAssoc();

        switch ($explode[0]) {
            case 'tl_article':

                $pageTitle = \PageModel::findPublishedById($articleRes['pid']);

                if ($pageTitle->thumb) {
                    $thumb = $this->getFilePath($pageTitle->thumb);
                }

                $title        = strip_tags($articleRes['teaser']);
                $type         = "post";
                $article_type = "post";

                $result = \ContentModel::findPublishedByPidAndTable($explode[1], $explode[0]);

                if ($result) {
                    foreach ($result as $key => $value) {
                        $tstamp = ($value->tstamp > $retArr['tstamp']) ? $value->tstamp : $retArr['tstamp'];
                    }
                }
                break;

            case 'tl_news':
                $title = $articleRes['headline'];

                if ($articleRes['singleSRC']) {
                    $thumb = $this->getFilePath($articleRes['singleSRC']);
                }

                $type         = "post";
                $article_type = "news";
                $tstamp       = $articleRes['tstamp'];
                break;

            case 'tl_calendar_events':
                $title = strip_tags($articleRes['title']);

                if ($articleRes['singleSRC']) {
                    $thumb = $this->getFilePath($articleRes['singleSRC']);
                }

                $type         = "event";
                $article_type = "event";
                $tstamp       = $articleRes['tstamp'];
                break;
        }

        $retArr['thumb']        = $thumb;
        $retArr['pid']          = $explode[1];
        $retArr['title']        = $title;
        $retArr['type']         = $type;
        $retArr['article_type'] = $article_type;
        $retArr['tstamp']       = $tstamp;

        return $retArr;
    } // getTeaserDetail

    protected function categoriesController() {

        $returnarray['error']   = $this->errorcode(0);
        $returnarray['changes'] = 0;

        $getTs = \Input::get($this->request['ts']);
        $ts    = (isset($getTs)) ? $getTs : 0;

        $categories = $this->settings['menu'];
        $i          = 0;
        $cat        = array();

        if ($categories) {
            $assCats = array();

            foreach ($categories as $category ) {
                if ($category['type'] == "cat") {
                    $cat[] = array(
                        'pos'               => ++$i,
                        'type'              => $category['type'],
                        'article_type'      => $category['article_type'],
                        'id'                => $category['id'],
                        'parent_id'         => 0,
                        'title'             => htmlspecialchars_decode($category['title']),
                        'post_img'          => "",
                        'img'               => $category['thumb'],
                        'post_id'           => "", //$category['id'],
                        'post_ts'           => $category['tstamp'],
                        'allowRemove'       => 0,
                        'itemdirekt'        => 1,
                        'showsubcategories' => 0,
                        'showoverviewposts' => 0
                    );
                }
            }

            if ($cat && count($cat) > 0) {
                $i = 0;
                foreach($cat as $k => $v) {
                    $returnarray['items'][] = $v;
                    $assCats[$k] = $v;
                    $assCats[$k] = array(
                        'showsubcategories' => 0,
                        'showoverviewposts' => 0,
                        'img'               => $v['thumb'],
                        'pos'               => ++$i,
                        'type'              => 'cat',
                        'id'                => $v['id'],
                        'parent_id'         => $v['parent_id'],
                        'title'             => htmlspecialchars_decode($v['title']),
                        'post_img'          => $v['img'],
                        'post_id'           => $v['post_id'],
                        'post_ts'           => $v['post_ts'],
                        'allowRemove'       => 0,
                        'itemdirekt'        => 1,
                        'use_cat_img'       => 0
                    );
                }
            }

        } else {
            $returnarray['error'] = $this->errorcode(20);
        }

        if ($this->settings['eventManager']) {
            $result = \CalendarModel::findByPk($this->settings['calendar']);
            $thumb  = "";

            if ($result->thumb) {
                $thumb = $this->getFilePath($result->thumb);
            }

            $items = $this->getEvent();

            if ($items[0]) {
                if ($ts <= $result->tstamp) {
                    $returnarray['changes'] = 1;
                    $ts = $result->tstamp;
                }

                $returnarray['items'][] = array(
                    'pos'         => ++$i,
                    'type'        => 'events',
                    'id'          => "-1",
                    'title'       => $result->title,
                    'img'         => $thumb,
                    'post_id'     => "",
                    'post_ts'     => $items[0]['timestamp'],
                    'allowRemove' => 0
                );

                $assCats[-1] = array(
                    'pos'         => ++$i,
                    'type'        => 'events',
                    'id'          => "-1",
                    'title'       => $result->title,
                    'img'         => $thumb,
                    'post_img'    => $thumb,
                    'post_id'     => "",
                    'post_ts'     => $items[0]['timestamp'],
                    'allowRemove' => 0
                );
            }
        }

        $returnarray['ass_cats'] = $assCats;
        return array('categories' => $returnarray);
    } // categoriesController

    protected function articleController() {

        $id = \Input::get($this->request['id']);

        if (isset($id)) {
            $cid                  = \Input::get($this->request['id']);
            $type                 = \Input::get('type');
            $returnarray['error'] = $this->errorcode(0);

            $post  = $this->getContentFromArticle($cid, $type);
            $getTs = \Input::get($this->request['ts']);
            $ts    = (isset($getTs)) ? $getTs : 0;

            if ($post) {
                $returnarray['id'] = (int) $post['pid'];
                $returnarray['error']['postid'] = (int) $post['pid'];

                $returnarray['timestamp'] = (int) $post['tstamp'];

                if ($ts < $post['tstamp']) {
                    $ts = $post['tstamp'];

                    $returnarray['title'] = str_replace(array("\\r", "\\n", "\r", "\n"), '', trim(html_entity_decode(strip_tags($post['title']), ENT_NOQUOTES, 'UTF-8')));

                    $content = $this->getAppContent($post['content']);
                    $content = $this->generateHtmlHead($content);

                    $returnarray['changes']   = 1;
                    $returnarray['type']      = "post";
                    $returnarray['format']    = 'html';
                    $returnarray['post_date'] = (int) $post['tstamp'];

                    $returnarray['sharelink']      = $post['sharelink'];
                    $returnarray['comment_status'] = $post['commentStatus'];
                    $returnarray['comments_count'] = $post['commentCount'];

                    $returnarray['img']   = array('src' => $post['img']['thumb'] );
                    $returnarray['thumb'] = array( $post['img']['thumb'] );

                    $returnarray['location'] = 0;

                } else {
                    $returnarray['changes'] = 0;
                }
            } else {
                $returnarray['error'] = $this->errorcode(17);
                $returnarray['id'] = \Input::get($this->request['id']);
            }
        } else {
            $returnarray['error'] = $this->errorcode(15);
        }
        return (array('article' => $returnarray));
    } // articleController

    protected function generateHtmlHead($content) {

        $this->settings['cssStyle'] = preg_replace(
            '/[\x00-\x1F\x80-\xFF]/',
            '',
            $this->settings['cssStyle']
        );

        $content = str_replace(
            '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">',
            '<!doctype html>',
            $content
        );

        $content = str_replace(
            '<!doctype html>',
            '<!doctype html>'."\n",
            $content
        );

        if (strpos($content, '<html><head><meta charset="utf-8"></head>')) {
            $content = str_replace(
                '<html><head><meta charset="utf-8"></head>',
                '<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><meta name="viewport" content="width=device-width"><link href="http://necolas.github.io/normalize.css/3.0.1/normalize.css" rel="stylesheet" type="text/css"><style type="text/css">'
                . $this->settings['cssStyle'] . ' body{color:#'
                . $this->settings['farbeFliesstext'] . ';}</style></head>',
                $content
            );

        } elseif (strpos($content, '<html>')) {
            $content = str_replace(
                '<html>',
                '<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><meta name="viewport" content="width=device-width"><link href="http://necolas.github.io/normalize.css/3.0.1/normalize.css" rel="stylesheet" type="text/css"><style type="text/css">'
                . $this->settings['cssStyle'] . ' body{color:#'
                . $this->settings['farbeFliesstext'] . ';}</style></head>',
                $content
            );

        } else {

            $content = '<!doctype html><html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><meta name="viewport" content="width=device-width"><link href="http://necolas.github.io/normalize.css/3.0.1/normalize.css" rel="stylesheet" type="text/css"><style type="text/css">'
                . $this->settings['cssStyle'] . ' body{color:#'
                . $this->settings['farbeFliesstext'] . ';}</style></head><body>'
                . $content . '</body></html>';
        }

        if ($this->settings['external']) {
            $content = str_replace(
                '<link href="http://necolas.github.io/normalize.css/3.0.1/normalize.css" rel="stylesheet" type="text/css">',
                $this->settings['external'],
                $content
            );
        }

        return $content;
    } // generateCss

    protected function contentController() {

        $articleId = \Input::get($this->request['id']);
        $type      = \Input::get('type');

        $obj       = $this->getContentFromArticle($articleId, $type);
        $content   = $this->getAppContent($obj['content']);
        $content   = $this->generateHtmlHead($content);

        return $content;
    } // contentController

    protected function getContentFromArticle($id, $type = "") {
        $tmpContent = "";
        $thumb      = "";
        $sharelink  = "";
        $retArr     = array();
        $time       = time();
        $base       = \Environment::get('base');
        $table      = "";

        if ($type == 'news') {
            $table = "tl_news";
        } else if ($table == 'event') {
            $table = "tl_calendar_events";
        } else {
            $table = "tl_article";
        }

        $openComment  = ($type == 'news') ? "open" : "closed" ;
        $commentCount = 0;
        $result       = "";

        $query = "SELECT * FROM `{$table}` WHERE `id` = '" . $id . "' ";
        $articleRes = \Database::getInstance()->query($query)->fetchAssoc();

        if ($type == "news") {
            switch ($articleRes['source']) {
                case 'external':
                    $sharelink = $articleRes['url'];
                    break;

                case 'article':
                    $sharelink = $base . \Controller::replaceInsertTags("{{article_url::" . $articleRes['articleId'] . "}}");
                    break;

                case 'internal':
                    $sharelink = $base . \Controller::replaceInsertTags("{{link_url::" . $articleRes['jumpTo'] . "}}");
                    break;

                default:
                    $sharelink = $base . \Controller::replaceInsertTags("{{news_url::" . $articleRes['id'] . "}}");
                    break;
            }
            $newsModel = \NewsModel::findPublishedByParentAndIdOrAlias($id, array(0 => $articleRes['pid']));
            $result = $this->parseNews($newsModel);

        } else if ($type == "event") {
            $objEvent    = \CalendarEventsModel::findPublishedByParentAndIdOrAlias($id, array($this->settings['calendar']));
            $objTemplate = new \FrontendTemplate("event_full");
            $objTemplate->setData($objEvent->row());

            $objTemplate->date          = $date;
            $objTemplate->start         = $intStartTime;
            $objTemplate->end           = $intEndTime;
            $objTemplate->class         = ($objEvent->cssClass != '') ? ' ' . $objEvent->cssClass : '';
            $objTemplate->recurring     = $recurring;
            $objTemplate->until         = $until;
            $objTemplate->locationLabel = $GLOBALS['TL_LANG']['MSC']['location'];

            $objTemplate->details = '';
            $objElement = \ContentModel::findPublishedByPidAndTable($objEvent->id, 'tl_calendar_events');

            if ($objElement !== null) {
                while ($objElement->next()) {
                    $objTemplate->details .= $this->getContentElement($objElement->id);
                }
            }

            $objTemplate->addImage = false;
            if ($objEvent->addImage && $objEvent->singleSRC != '') {
                $objModel = \FilesModel::findByUuid($objEvent->singleSRC);

                if (is_file(TL_ROOT . '/' . $objModel->path)) {
                    $arrEvent = $objEvent->row();
                    $arrEvent['singleSRC'] = $objModel->path;

                    $this->addImageToTemplate($objTemplate, $arrEvent);
                }
            }

            $objTemplate->enclosure = array();

            if ($objEvent->addEnclosure) {
                $this->addEnclosuresToTemplate($objTemplate, $objEvent->row());
            }

            $result = $objTemplate->parse();
        } else {
            $result = \ArticleModel::findByIdOrAliasAndPid($id, $articleRes['pid']);
        }

        $sharelink = ($sharelink == "") ? $base . \Controller::replaceInsertTags("{{link_url::" . $articleRes['pid'] . "}}") : $sharelink;

        if ($result != "") {

            if ($type != "news" && $type != "event") {
                $pageTitleRes = \Controller::getPageDetails($articleRes['pid']);
                $objArticle = new \ModuleArticle($result);
                $tmpContent = $objArticle->generate(true);
            } else {
                $tmpContent = $result;
            }

            $tmpContent = \Controller::replaceInsertTags($tmpContent);
            $tmpContent = str_replace('src="files/', 'src="' . $base . 'files/', $tmpContent);
            $tmpContent = str_replace('src="assets/', 'src="' . $base . 'assets/', $tmpContent);
            $tmpContent = str_replace('href="index.php/', 'href="' . $base . 'index.php/', $tmpContent);

            if ($pageTitleRes->thumb) {
                $thumb = $this->getFilePath($pageTitleRes->thumb);
            }

            if ($openComment == "open") {
                $commentCount = \CommentsModel::countPublishedBySourceAndParent("tl_news", $id);
            }

            $retArr['tstamp']        = time();
            $retArr['img']['src']    = "";
            $retArr['img']['thumb']  = $thumb;
            $retArr['pid']           = $id;
            $retArr['title']         = ($type != "news") ? $pageTitleRes->title : $articleRes['headline'];
            $retArr['commentStatus'] = $openComment;
            $retArr['commentCount']  = $commentCount;
            $retArr['sharelink']     = $sharelink;

            $tmpContent        = str_replace(']]>', ']]&gt;', $tmpContent);
            $tmpContent        = str_replace("\r\n", '\n', $tmpContent);
            $retArr['content'] = preg_replace('/[\x00-\x1F\x80-\x9F]/u', '', $tmpContent);
        } else {
            $retArr = false;
        }

        return $retArr;
    } // getContentFromArticle

    protected function parseNews($objArticle) {
        global $objPage;
        $objTemplate               = new \FrontendTemplate($this->news_template);
        $objTemplate->linkHeadline = $objArticle->subheadline;
        $objTemplate->text         = '';

        if ($objArticle->teaser != '') {
            $objTemplate->teaser = \String::toHtml5($objArticle->teaser);
            $objTemplate->teaser = \String::encodeEmail($objTemplate->teaser);
        }

        $objElement = \ContentModel::findPublishedByPidAndTable($objArticle->id, 'tl_news');

        if ($objElement !== null) {
            while ($objElement->next()) {
                $objTemplate->text .= $this->getContentElement($objElement->id);
            }
        }

        $retVal = "";
        $retVal = $objTemplate->parse();
        $retVal = str_replace('<p class="more"></p>', $objTemplate->text, $retVal);

        return $retVal;
    } // parseNews

    protected function eventsController($lim = 0) {
        $getLimit = \Input::get($this->request['limit']);

        if ($lim != 0) {
            $limit = $lim;
        } else if (isset($getLimit)) {
            $limit = $getLimit;
        } else {
            $limit = 9999;
        }

        $postId = \Input::get($this->request['post_id']);
        $postTs = \Input::get($this->request['post_ts']);

        if (isset($postId) && isset($postTs)) {
            $break    = false;
            $events   = $this->getEvent();
            $tmpEvent = array();

            foreach ($events as $key => $value) {
                if ($value['timestamp'] > $tmpEvent['timestamp']) {
                    $tmpEvent = $value;
                }
            }
            if ($tmpEvent) {
                $break = true;
                if ($tmpEvent['timestamp'] > $postTs) {
                    $ts                     = $tmpEvent['timestamp'];
                    $returnarray['changes'] = 0;
                    $returnarray['items'][] = $tmpEvent;
                } else {
                    $ts = $postTs;
                }
            } else {
                $break                  = true;
                $returnarray['error']   = $this->errorcode(22);
                $ts                     = time();
                $returnarray['items'][] = array();
            }
            if ($break) {
                $returnarray['timestamp']         = $ts;
                $returnarray['items'][0]['img']   = $this->getEventThumb();
                $returnarray['items'][0]['thumb'] = $this->getEventThumb();
                return array('events' => $returnarray);
            }
        }

        $ts        = (\Input::get('ts')) ? \Input::get('ts') : 0;
        $ts_string = ($ts) ? date('Y-m-d H:i:s', $ts) : date('0000-00-00 00:00:00');
        $events    = $this->getEvent();

        if ($events) {
            $returnarray['items']   = $events;
            $returnarray['changes'] = 1;
            $ts = $events[0]['timestamp'];
        } else {
            $returnarray['error'] = $this->errorcode(22);
        }

        $returnarray['timestamp'] = $ts;
        return array('events' => $returnarray);
    } // eventsController

    protected function getEventThumb() {
        $result = \CalendarModel::findByPk($this->settings['calendar']);
        if ($result->thumb) {
            return $this->getFilePath($result->thumb);
        } else {
            return "";
        }
    } // getEventThumb

    protected function eventController() {

        $getId = \Input::get($this->request['id']);

        if (isset($getId)) {
            $getTs = \Input::get($this->request['ts']);
            $ts    = (isset($getTs)) ? $getTs : 0;

            $returnarray['changes'] = 0;
            $event = $this->getEvent($getId);

            if ($event) {
                if ($ts < $event['timestamp']) {
                    $ts = $event['timestamp'];
                    $returnarray['changes'] = 1;
                }

                $returnarray['error'] = $this->errorcode(0);
                $returnarray['id']    = $event['id'];

                $tmpArr = array(
                    'title'             => htmlspecialchars_decode($event['title']),
                    'post_date'         => $event['publish_timestamp'],
                    'timestamp'         => $event['timestamp'],
                    'post_date'         => $event['post_date'],
                    'type'              => 'event',
                    'thumb'             => $event['thumb'],
                    'publish_timestamp' => $event['publish_timestamp'],
                    'event_id'          => $event['event_id'],
                    'subtitle'          => $event['subtitle'],
                    'start_date'        => $event['start_date'],
                    'end_date'          => $event['end_date'],
                    'start_time'        => $event['start_time'],
                    'end_time'          => $event['end_time'],
                    'start_ts'          => $event['start_ts'],
                    'end_ts'            => $event['end_ts'],
                    'day'               => $event['day'],
                    'swd'               => $event['swd'],
                    'ewd'               => $event['ewd'],
                    'sharelink'         => $event['sharelink'],
                    'images'            => array(0 => $event['thumb']),
                    'location'          => $event['location'],
                    'town'              => $event['town'],
                    'city'              => $event['city'],
                    'country'           => $event['country'],
                    'zip'               => $event['zip'],
                    'address'           => $event['address'],
                    'street'            => $event['street'],
                    'region'            => $event['region'],
                    'province'          => $event['province'],
                    'extra'             => $event['extra'],
                    'lat'               => $event['lat'],
                    'lng'               => $event['lng'],
                    'short_text'        => ''
                );

                $returnarray = array_merge($returnarray, $tmpArr);

            } else {
                $returnarray['error']   = $this->errorcode(22);
                $ts                     = time();
                $returnarray['items'][] = array();
            }
        } else {
            $returnarray['error'] = $this->errorcode(15);
        }

        return array('event' => $returnarray);
    } // eventController

    protected function getEvent($id = false) {
        $tmpArr = array();
        $i      = 0;
        $id     = ($id) ? ($id) : (\Input::get($this->request['id'])) ? \Input::get($this->request['id']) : false;

        if ($id) {
            $result = \CalendarEventsModel::findPublishedByParentAndIdOrAlias($id, array($this->settings['calendar']));
        } else {
            list($start, $end, $empty) = $this->getDatesFromFormat($this->settings['eventFormat']);
            $result = \CalendarEventsModel::findCurrentByPid($this->settings['calendar'], $start, $end);
        }

        if ($result) {
            if ($result instanceof \Model\Collection) {
                while ($result->next()) {
                    $tmpArr[] = $this->fillEventArray($result, ++$i);
                }
            } else {
                $tmpArr = $this->fillEventArray($result, 1);
            }
        } else {
            $tmpArr = false;
        }
        return $tmpArr;
    } // getEvent

    protected function fillEventArray($result, $pos) {

        $weekdays = array(
            0 => 'Sonntag',
            1 => 'Montag',
            2 => 'Dienstag',
            3 => 'Mittwoch',
            4 => 'Donnerstag',
            5 => 'Freitag',
            6 => 'Samstag',
        );

        $startDate = date("d.m.Y", $result->startDate);
        $startTime = ($result->addTime) ? date("H:i", $result->startTime) : date("H:i", $result->startDate);
        $endDate   = ($result->endDate) ? date("d.m.Y", $result->endDate) : $startDate;
        $endTime   = ($result->addTime) ? date("H:i", $result->endTime)   : $startTime;
        $allDay    = "";

        if ($startDate == $endDate) {
            $allDay = 1;
            if ($startTime != "00:00" && $endTime != "00:00") {
                $allDay = 0;
            }
        } else {
            $allDay = 0;
            if ($startTime == $endTime) {
                $allDay = 1;
            }
        }

        $geoInfo = $this->getGeoInfo($result->strasse, $result->plz, $result->ort);
        $thumb   = "";

        if ($result->singleSRC && $result->addImage) {
            $thumb = $this->getFilePath($result->singleSRC);
        }

        $tmpArr = array(
            'pos'               => $pos,
            'id'                => $result->id,
            'title'             => htmlspecialchars_decode($result->title),
            'post_date'         => $result->tstamp,
            'timestamp'         => $result->tstamp,
            'type'              => "event",
            'thumb'             => $thumb,
            'publish_timestamp' => $result->tstamp,
            'event_id'          => $result->id,
            'subtitle'          => "",
            'start_date'        => $startDate,
            'end_date'          => $endDate,
            'start_time'        => $startTime,
            'end_time'          => $endTime,
            'start_ts'          => $result->startDate,
            'end_ts'            => ($result->endDate) ? $result->endDate : $result->startDate,
            'day'               => $allDay,
            'swd'               => $weekdays[date('w', $result->startDate)],
            'ewd'               => ($result->endDate) ? $weekdays[date('w', $result->endDate)] : $weekdays[date('w', $result->startDate)],
            'img'               => $thumb,
            'location'          => ($result->location) ? $result->location : null,
            'town'              => ($result->ort) ? $result->ort : null,
            'city'              => ($result->ort) ? $result->ort : null,
            'country'           => ($result->land && $result->ort) ? strtoupper($result->land) : null,
            'zip'               => ($result->plz) ? $result->plz : null,
            'plz'               => ($result->plz) ? $result->plz : null,
            'address'           => ($result->strasse) ? $result->strasse : null,
            'street'            => ($result->strasse) ? $result->strasse : null,
            'region'            => ($geoInfo['region']) ? $geoInfo['region'] : null,
            'province'          => ($geoInfo['region']) ? $geoInfo['region'] : null,
            'extra'             => "",
            'lat'               => ($geoInfo['lat']) ? $geoInfo['lat'] : 0,
            'lng'               => ($geoInfo['lng']) ? $geoInfo['lng'] : 0,
            'short_text'        => htmlspecialchars_decode($result->teaser),
            'sharelink'         => \Environment::get('base') . \Controller::replaceInsertTags("{{event_url::" . $result->id . "}}"),
        );
        return $tmpArr;
    } // fillEventArray

    protected function getDatesFromFormat($strFormat) {
        switch ($strFormat) {
            case 'next_7':
                $objToday = new \Date();
                return array($objToday->dayBegin, (strtotime('+7 days', $objToday->dayBegin) - 1), $GLOBALS['TL_LANG']['MSC']['cal_empty']);
                break;

            case 'next_14':
                $objToday = new \Date();
                return array($objToday->dayBegin, (strtotime('+14 days', $objToday->dayBegin) - 1), $GLOBALS['TL_LANG']['MSC']['cal_empty']);
                break;

            case 'next_30':
                $objToday = new \Date();
                return array($objToday->dayBegin, (strtotime('+1 month', $objToday->dayBegin) - 1), $GLOBALS['TL_LANG']['MSC']['cal_empty']);
                break;

            case 'next_90':
                $objToday = new \Date();
                return array($objToday->dayBegin, (strtotime('+3 months', $objToday->dayBegin) - 1), $GLOBALS['TL_LANG']['MSC']['cal_empty']);
                break;

            case 'next_180':
                $objToday = new \Date();
                return array($objToday->dayBegin, (strtotime('+6 months', $objToday->dayBegin) - 1), $GLOBALS['TL_LANG']['MSC']['cal_empty']);
                break;

            case 'next_365':
                $objToday = new \Date();
                return array($objToday->dayBegin, (strtotime('+1 year', $objToday->dayBegin) - 1), $GLOBALS['TL_LANG']['MSC']['cal_empty']);
                break;

            case 'next_two':
                $objToday = new \Date();
                return array($objToday->dayBegin, (strtotime('+2 years', $objToday->dayBegin) - 1), $GLOBALS['TL_LANG']['MSC']['cal_empty']);
                break;

            case 'next_cur_month':
                $objToday = new \Date();
                return array($objToday->dayBegin, $objToday->monthEnd, $GLOBALS['TL_LANG']['MSC']['cal_empty']);
                break;

            case 'next_cur_year':
                $objToday = new \Date();
                return array($objToday->dayBegin, $objToday->yearEnd, $GLOBALS['TL_LANG']['MSC']['cal_empty']);
                break;

            case 'next_next_month':
                $objToday = new \Date();
                return array(($objToday->monthEnd + 1), strtotime('+1 month', $objToday->monthEnd), $GLOBALS['TL_LANG']['MSC']['cal_empty']);
                break;

            case 'next_next_year':
                $objToday = new \Date();
                return array(($objToday->yearEnd + 1), strtotime('+1 year', $objToday->yearEnd), $GLOBALS['TL_LANG']['MSC']['cal_empty']);
                break;

            case 'next_all': // 2038-01-01 00:00:00
                $objToday = new \Date();
                return array($objToday->dayBegin, 2145913200, $GLOBALS['TL_LANG']['MSC']['cal_empty']);
                break;
        }
    } // getDatesFromFormat

    protected function articlesController($id = 0, $lim = 0) {
        $getId       = \Input::get($this->request['id']);
        $postId      = \Input::get($this->request['post_id']);
        $postTs      = \Input::get($this->request['post_ts']);
        $getLimit    = \Input::get($this->request['limit']);
        $getOption   = \Input::get($this->request['option']);
        $getSorttype = \Input::get($this->request['sorttype']);

        $returnarray['error'] = $this->errorcode(0);

        if ($getId || $id) {
            $returnarray['changes'] = 0;

            if ($id) {
                $cid = $id;
                $limit = ($lim) ? $lim : 999;
            } else {
                $cid = $getId;
                $limit = (isset($getLimit)) ? $getLimit : 999;
            }

            if (!$postIds) {
                if ($cid != "-98") {
                    $postIds = $this->getContentIds($cid);
                } else {
                    $postIds = $this->getNewsItems();
                }
            }

            if ($postIds) {
                $returnarray['error'] = $this->errorcode(0);
                $i = 0;

                foreach ($postIds as $pid) {
                    if (isset($limit) && count($returnarray['items']) >= $limit) {
                        break;
                    }

                    $ts = ($ts < $pid['tstamp']) ? $pid['tstamp'] : 0;

                    if ($ts < $pid['tstamp']) {
                        $ts = $pid['tstamp'];
                        $returnarray['changes'] = 1;
                    }

                    $returnarray['items'][] = array(
                        'pos'               => ++$i,
                        'id'                => (int)$pid['id'],
                        'title'             => html_entity_decode($pid['title']),
                        'timestamp'         => (int) $pid['tstamp'],
                        'type'              => ($pid['type']) ? $pid['type'] : "post",
                        'thumb'             => $pid['thumb'],
                        'publish_timestamp' => (int)$pid['tstamp'],
                        'url'               => "",
                        'article_type'      => $pid['type'],
                        'post_date'         => (int)$pid['tstamp'],
                    );
                }

                if (!($returnarray['items'])) {
                    $returnarray['error'] = $this->errorcode(19);
                    $ts = time();
                }

            } else {
                $returnarray['error'] = $this->errorcode(16);
                $ts = time() ;
            }

            $returnarray['timestamp'] = $ts;
        } else {
            $returnarray['error'] = $this->errorcode(15);
        }

        return array('articles' => $returnarray);
    } // articlesController

    protected function getContentIds($id) {
        $tmpArray = array();
        $img = "";

        if ($id == "-1") {
            $result = \CalendarModel::findByPk($this->settings['calendar']);

            if ($result->thumb) {
                $img = $this->getFilePath($result->thumb);
            }

            $tmpArray[0]['title']  = $result->title;
            $tmpArray[0]['tstamp'] = $result->tstamp;
            $tmpArray[0]['thumb']  = $img;
            $tmpArray[0]['id']     = $id;
            $tmpArray[0]['type']   = "events";

        } else {
            $res = \ContentModel::findPublishedByPidAndTable($id, "tl_article");
            $tmpArray = array();

            if (count($res) > 0) {
                $article = \ArticleModel::findByPk($id);
                $page    = \PageModel::findByPk($article->pid);

                if ($page->thumb) {
                    $img = $this->getFilePath($page->thumb);
                }

                while ($res->next()) {
                    $headline = unserialize($res->headline);
                    $tmpArray[] = array(
                        "id"     => $res->id,
                        "tstamp" => $res->tstamp,
                        'title'  => ($headline['value'] && $headline['value'] != "")  ? $headline['value'] : null,
                        'thumb'  => $img,
                        "type"   => "post",
                    );
                }
            }
        }
        return $tmpArray;
    } // getContentIds

    protected function getNewsItems() {
        $tmpArr = array();
        $news = \NewsModel::findPublishedByPids(array($this->settings['news']));

        while ($news->next()) {
            $tmpArr[] = array(
                'title'  => $news->headline,
                'tstamp' => $news->time,
                'id'     => $news->id,
                'type'   => 'news',
                'thumb'  => ($news->singleSRC && $news->addImage) ? $this->getFilePath($news->singleSRC) : null
            );
        }
        return $tmpArr;
    } // getNewsItems

    protected function getAppContent($html) {
        $libxml_previous_state = libxml_use_internal_errors(true);

        $dom = new \DOMDocument();
        $caller = new \c2aErrorTrap( array($dom, 'loadHTML') );

        $caller->call($html);

        if (!$caller->ok()) {
          $html = '<!doctype html><html><head><meta charset="utf-8"></head><body>' . $html . '</body></html>';
        } else {
            $dom->validateOnParse = true;
            $dom->loadHTML('<?xml encoding="UTF-8">' . $html);
            $dom->preserveWhiteSpace = false;

            foreach ($dom->childNodes as $item) {
                if ($item->nodeType == XML_PI_NODE) {
                    $dom->removeChild($item);
                }
            }

            $dom->encoding = 'UTF-8';
            $imgElements  = $dom->getElementsByTagName("img");

            foreach ($imgElements as $imgElement) {
                if (ini_get('allow_url_fopen')) {
                    if ($this->settings['min-img-size-for-resize']) {
                        $src = $imgElement->getAttribute('src');
                        list($w, $h) = getimagesize($src);

                        if ($w && $w < $this->settings['min-img-size-for-resize']) {
                            continue;
                        }
                    }
                }

                if ($imgElement->hasAttribute('width')) {
                    $imgElement->removeAttribute('width');
                }

                $imgElement->setAttribute('width', '100%');

                if ($imgElement->hasAttribute('height')) {
                    $imgElement->removeAttribute('height');
                }

                if ($imgElement->parentNode->nodeName != 'a') {

                    $clone = $imgElement->cloneNode(false);

                    $newEdiv = $dom->createElement('div');
                    $newEdiv->appendChild($clone);

                    $imgElement->parentNode->replaceChild($newEdiv, $imgElement);
                }
            }

            $iframeElements = $dom->getElementsByTagName("iframe");

            foreach ($iframeElements as $iframeElement) {
                $src = $iframeElement->getAttribute('src');

                if (substr($src, 0, 2) == '//') {
                    $iframeElement->setAttribute('src', 'http:' . $src);
                }
            }

            $divElements  = $dom->getElementsByTagName("div");

            foreach ($divElements as $divElement) {
                if ($divElement->hasAttribute('style')) {
                    $divElement->removeAttribute('style');
                }
            }

            $html    = $dom->saveHTML();
            $html    = nl2br($html);
            $htmlsup = substr($html, 0, strpos($html, '<body>'));
            $htmlsup = str_replace('<br />', '', $htmlsup);
            $html    = substr($html, strpos($html, '<body>'), -7);
            $html    = $htmlsup . $html;
        }

        return $html;
    } // getAppContent

    protected function commentsController() {
        $returnarray['error']   = $this->errorcode(0);
        $returnarray['changes'] = 1;

        $getTs             = \Input::get($this->request['ts']);
        $getId             = \Input::get($this->request['id']);
        $returnarray['ts'] = (isset($getTs)) ? $getTs : 0;

        if (isset($getId)) {

           if (\Input::get($this->request['action']) == 'add' ) {

                $comment = $_REQUEST[$this->request['comment']];
                $name    = $_REQUEST[$this->request['name']];
                $email   = $_REQUEST[$this->request['email']];
                $key     = $_REQUEST[$this->request['key']];

                if( (!$comment || $comment == "") || !$name || !$email ) {
                   $returnarray['error'] = $this->errorcode(30);
                }  elseif (!\Validator::isEmail($email) ) {
                    $returnarray['error'] = $this->errorcode(31);
                } else {
                    $ts        = time();

                    $arrInsert = array(
                        'tstamp'    => $ts,
                        'source'    => 'tl_news',
                        'parent'    => $getId,
                        'date'      => $ts,
                        'name'      => $name,
                        'email'     => $email,
                        'comment'   => trim($comment),
                        'published' => ($this->settings['news_moderate'] == 1) ? 0 : 1,
                        'ip'        => \Environment::get('remote_addr'),
                    );

                    $objComment = new \CommentsModel();
                    $objComment->setRow($arrInsert)->save();

                    if ($objComment->id) {

                        $strComment = $_REQUEST[$this->request['comment']];
                        $strComment = strip_tags($strComment);
                        $strComment = \String::decodeEntities($strComment);
                        $strComment = str_replace(array('[&]', '[lt]', '[gt]'), array('&', '<', '>'), $strComment);

                        $objTemplate          = new \FrontendTemplate('kommentar_email');
                        $objTemplate->name    = $arrInsert['name'] . ' (' . $arrInsert['email'] . ')';
                        $objTemplate->comment = $strComment;
                        $objTemplate->edit    = \Idna::decode(\Environment::get('base')) . 'contao/main.php?do=comments&act=edit&id=' . $objComment->id;

                        $objEmail           = new \Email();
                        $objEmail->from     = $GLOBALS['TL_ADMIN_EMAIL'];
                        $objEmail->fromName = $GLOBALS['TL_ADMIN_NAME'];
                        $objEmail->subject  = sprintf($GLOBALS['TL_LANG']['MSC']['com_subject'], \Idna::decode(\Environment::get('host')));
                        $objEmail->text     = $objTemplate->parse();

                        if ($GLOBALS['TL_ADMIN_EMAIL'] != '') {
                            $objEmail->sendTo($GLOBALS['TL_ADMIN_EMAIL']);
                        }

                        $returnarray['error']      = $this->errorcode(0);
                        $returnarray['ts']         = $ts;
                        $returnarray['comment_id'] = $objComment->id;
                        $returnarray['changes']    = 1;
                        $returnarray['status']     = ($this->settings['news_moderate'] == 1) ? 'Kommentar wird geprüft.' : "Kommentar veröffentlicht.";

                    } else {
                        $returnarray['error'] = $this->errorcode(31);
                    }
                }

            } else {
                $post = $this->getComment($getId);

                if ( $post['commentStatus'] == 'open') {
                    $returnarray['comment_status'] = $post['commentStatus'];
                    $returnarray['comments_count'] = $post['commentsCount'];
                    $returnarray['REQUEST_TOKEN']  = REQUEST_TOKEN;

                    if ($post['commentsCount'] > 0) {
                        $pos = 0;

                        foreach ($post['items'] as $comment) {
                            $tempArray              = array();
                            $tempArray['pos']       = ++$pos;
                            $tempArray['id']        = $comment->id;
                            $tempArray['text']      = strip_tags($comment->comment);
                            $tempArray['timestamp'] = (int)$comment->date;

                            if ($tempArray['timestamp'] > $returnarray['ts']) {
                                $returnarray['ts']      = $tempArray['timestamp'];
                                $returnarray['changes'] = 1;
                            }

                            $tempArray['datum']           = date('d.m.Y, H:i', $tempArray['timestamp']);
                            $tempArray['author']['name']  = $comment->name;
                            $tempArray['author']['id']    = "0";
                            $tempArray['author']['email'] = $comment->email;
                            $tempArray['author']['img']   = "";

                            if ($comment->addReply) {
                                $objUser = \UserModel::findByPk($comment->author);

                                $tempArray['subitems'] = array(array(
                                    'pos'       => 1,
                                    'id'        => 1,
                                    'parent_id' => $comment->id,
                                    'text'      => strip_tags($comment->reply),
                                    'timestamp' => (int)$comment->tstamp,
                                    'datum'     => date('d.m.Y, H:i', $comment->tstamp),
                                    'author'    => array(
                                        'name'  => $objUser->name,
                                        'id'    => $objUser->id,
                                        'email' => $objUser->email,
                                        'img'   => "",
                                    )),
                                );
                            }
                            $returnarray['items'][] = $tempArray;
                        }

                        if ($returnarray['changes'] != 1) {
                            unset($returnarray['items']);
                        }
                    }
                } else {
                    $returnarray['error'] = $this->errorcode(29);
                }
            }
        } else {
            $returnarray['error'] = $this->errorcode(15);
        }

        return (array('comments' => $returnarray));
    } // commentsController

    protected function getComment($id) {
        $tmpArr = array();
        $news   = \NewsModel::findByPk($id);

        if ($news->noComments) {
            $tmpArr['commentStatus'] = "closed";
        } else {
            $result = \CommentsModel::findPublishedBySourceAndParent("tl_news", $id);
            $tmpArr['commentStatus'] = "open";
            $tmpArr['commentsCount'] = count($result);

            if (count($result) > 0) {
                while ($result->next()) {
                    $tmpArr['items'] = $result;
                }
            }
        }

        return $tmpArr;
    } // getComment

    protected function ynaSettingsController() {
        return array('yna_settings' => array(
            'error' => $this->errorcode(10),
            'bloginfo' => array(
                'name' => $this->settings['page']->title,
                'language' => $this->settings['page']->language,
        )));
    } // ynaSettingsController

    protected function errorcode($er = 10) {
        $errorarray['url'] = \Environment::get('base') . \Environment::get('request');

        switch ($er) {
            case 0:
                $errorarray['error_code']    = 0;
                $errorarray['error_message'] = 'No Error';
                break;
            case 11:
                $errorarray['error_code']    = 11;
                $errorarray['error_message'] = 'Unknown controller';
                break;
            case 12:
                $errorarray['error_code']    = 12;
                $errorarray['error_message'] = 'No settings saved';
                break;
            case 13:
                $errorarray['error_code']    = 13;
                $errorarray['error_message'] = 'Setting is empty';
                break;
            case 14:
                $errorarray['error_code']    = 14;
                $errorarray['error_message'] = 'Menu is empty';
                break;
            case 15:
                $errorarray['error_code']    = 15;
                $errorarray['error_message'] = 'No ID';
                break;
            case 16:
                $errorarray['error_code']    = 16;
                $errorarray['error_message'] = 'No items for this category';
                break;
            case 17:
                $errorarray['error_code']    = 17;
                $errorarray['error_message'] = 'No item whith this ID';
                break;
            case 18:
                $errorarray['error_code']    = 18;
                $errorarray['error_message'] = 'No teaser set';
                break;
            case 19:
                $errorarray['error_code']    = 19;
                $errorarray['error_message'] = 'No app items for this category';
                break;
            case 20:
                $errorarray['error_code']    = 20;
                $errorarray['error_message'] = 'No categories';
                break;
            case 21:
                $errorarray['error_code']    = 21;
                $errorarray['error_message'] = 'No Items in Categories';
                break;
            case 22:
                $errorarray['error_code']    = 22;
                $errorarray['error_message'] = 'No events';
                break;
            case 23:
                $errorarray['error_code']    = 23;
                $errorarray['error_message'] = 'No homepreset';
                break;
            case 24:
                $errorarray['error_code']    = 24;
                $errorarray['error_message'] = 'Unknown social network';
                break;
            case 25:
                $errorarray['error_code']    = 25;
                $errorarray['error_message'] = 'Facebook IDs required';
                break;
            case 26:
                $errorarray['error_code']    = 26;
                $errorarray['error_message'] = 'No Facebook SDK';
                break;
            case 27:
                $errorarray['error_code']    = 27;
                $errorarray['error_message'] = 'Facebook Error';
                break;
            case 28:
                $errorarray['error_code']    = 28;
                $errorarray['error_message'] = 'Facebook query empty';
                break;
            case 29:
                $errorarray['error_code']    = 29;
                $errorarray['error_message'] = 'Comments closed';
                break;
            case 30:
                $errorarray['error_code']    = 30;
                $errorarray['error_message'] = 'Missed required value';
                break;
            case 31:
                $errorarray['error_code']    = 31;
                $errorarray['error_message'] = 'email invalid';
                break;
            case 32:
                $errorarray['error_code']    = 32;
                $errorarray['error_message'] = 'key already exists';
                break;
            case 33:
                $errorarray['error_code']    = 33;
                $errorarray['error_message'] = 'No UUID';
                break;
            case 34:
                $errorarray['error_code']    = 34;
                $errorarray['error_message'] = 'No location activ';
                break;
            case 35:
                $errorarray['error_code']    = 35;
                $errorarray['error_message'] = 'This category is now inactive for the app';
                break;
            case 36:
                $errorarray['error_code']    = 36;
                $errorarray['error_message'] = 'No more items';
                break;
            default:
                $errorarray['error_code']    = 10;
                $errorarray['error_message'] = 'Unknown Error';
                break;
        }
        return ($errorarray);
    } // errorcode

    protected function getGeoInfo($street, $postal, $city) {

        if (!$street && !$postal && !$city) {
            return false;
        }

        $apiCall  = "http://maps.googleapis.com/maps/api/geocode/json?address=";
        $apiCall .= str_replace( " ", "+", urlencode($street) ) .
        "+" . trim($postal) . "+" .
        str_replace( " ", "+", urlencode($city) ) .
        "&sensor=false";

        $d = file_get_contents($apiCall);
        utf8_decode($d);
        $data = json_decode($d);

        if ($data->status == "OK") {
            $retArr = array(
                'lat'     => $data->results[0]->geometry->location->lat,
                'lng'     => $data->results[0]->geometry->location->lng,
                'region'  => $data->results[0]->address_components[2]->short_name,
                'country' => $data->results[0]->address_components[6]->short_name,
            );
        }
        return $retArr;
    } // getGeoInfo

    protected function getFilePath($file) {
        $uuid    = \String::binToUuid($file);
        $objFile = \FilesModel::findByUuid($uuid);
        return \Environment::get('base') . $objFile->path;
    }
}
