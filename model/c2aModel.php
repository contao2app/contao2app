<?php

/**
 * @package   Kontor4
 * @copyright KONTOR4, Agentur für neue Medien 2014 <info@kontor4.de>
 * @license   For the full copyright and license information, please view the
 *            license.txt file that was distributed with this source code.
 */

namespace Kontor4;

class c2aModel extends \Model {

    protected static $strTable = 'tl_c2a_settings';

    /**
     * @override \Model::findByPk()
     *
     * @param  $id
     * @param  $arrOptions
     * @return Database Object
     */
    public static function findByPk($id, array $arrOptions=array()) {
        $query = "SELECT * FROM ".static::$strTable." WHERE id = '" . $id . "' ";
        return \Database::getInstance()->query($query)->fetchAssoc();
    }
}
