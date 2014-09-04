<?php

/**
 * @package   Kontor4
 * @copyright KONTOR4, Agentur für neue Medien 2014 <info@kontor4.de>
 * @license   For the full copyright and license information, please view the
 *            license.txt file that was distributed with this source code.
 */

namespace Kontor4;

/**
 * Behilfsklasse für dca
 */
class c2aHelper extends \Backend
{

    protected function compile() { }

    public function getRootPages() {
        $query = "SELECT id, title FROM `tl_page` WHERE type = 'root'";
        $res = \Database::getInstance()->query($query)->fetchAllAssoc();
        $retArr = array();

        foreach ($res as $key => $value) {
            $retArr[$value['id']] = $value['title'];
        }

        return $retArr;
    }

    public function getTeaserOptions() {
        $tmpArr = array();

        $articles = $this->getArticles();
        $news = $this->getNews();
        $events = $this->getEvents();

        $result = array_merge($articles, $news, $events);

        return $result;
    }

    protected function getArticles() {

        $arrArticle = array();

        $query = "  SELECT    a.id, a.pid, a.title, a.inColumn, p.title AS parent
                    FROM      tl_article a
                    LEFT JOIN tl_page p
                    ON        p.id=a.pid
                    WHERE     a.inAppPublished = 1
                    ORDER BY  parent, a.sorting";

        $objArticle = $this->Database->execute($query);

        if ($objArticle->numRows) {
            \System::loadLanguageFile('tl_article');

            while ($objArticle->next()) {
                $key = htmlspecialchars($objArticle->parent . ' (ID ' . $objArticle->pid . ')');

                $arrArticle["Artikel"]["tl_article:::".$objArticle->id] = htmlspecialchars($objArticle->title . ' (' . ($GLOBALS['TL_LANG']['tl_article'][$objArticle->inColumn] ?: $objArticle->inColumn) . ', ID ' . $objArticle->id . ')');
            }
        }

        return $arrArticle;
    }

    protected function getNews() {

        $arrNews = array();
        $query = "  SELECT    a.id, a.pid, a.headline, p.title AS parent
                    FROM      tl_news a
                    LEFT JOIN tl_news_archive p
                    ON        p.id = a.pid
                    ORDER BY  parent ";


        $objNews = $this->Database->execute($query);

        if ($objNews->numRows) {

            while ($objNews->next()) {
                $key = htmlspecialchars($objNews->parent . ' (ID ' . $objNews->pid . ')');

                $arrNews["News"]["tl_news:::".$objNews->id] = htmlspecialchars(html_entity_decode($objNews->headline) . ' (ID ' . $objNews->id . ')');
            }
        }

        return $arrNews;
    }

    protected function getEvents() {

        $arrEvents = array();
        $query = "  SELECT     a.id, a.pid, a.title, p.title AS parent
                    FROM       tl_calendar_events a
                    LEFT JOIN tl_calendar p
                    ON         p.id = a.pid
                    ORDER BY   parent ";


        $objEvents = $this->Database->execute($query);

        if ($objEvents->numRows) {

            while ($objEvents->next()) {
                $key = htmlspecialchars($objEvents->parent . ' (ID ' . $objEvents->pid . ')');

                $arrEvents["Events"]["tl_calendar_events:::".$objEvents->id] = htmlspecialchars(html_entity_decode($objEvents->title) . ' (ID ' . $objEvents->id . ')');
            }
        }
        return $arrEvents;
    }
}
