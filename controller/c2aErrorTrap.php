<?php

/**
 * @package   Kontor4
 * @copyright KONTOR4, Agentur für neue Medien 2014 <info@kontor4.de>
 * @license   For the full copyright and license information, please view the
 *            license.txt file that was distributed with this source code.
 */

namespace Kontor4;

class c2aErrorTrap
{

    protected $callback;
    protected $errors = array();

    public function __construct($callback) {
        $this->callback = $callback;
    }

    public function call() {
        $result = null;
        set_error_handler(array($this, 'onError'));

        try {
            $args = func_get_args();
            $result = call_user_func_array($this->callback, $args);
        } catch (Exception $ex) {
            restore_error_handler();
            throw $ex;
        }

        restore_error_handler();
        return $result;
    }

    public function onError($errno, $errstr, $errfile, $errline) {
        $this->errors[] = array($errno, $errstr, $errfile, $errline);
    }

    public function ok() {
        return count($this->errors) === 0;
    }

    public function errors() {
        return $this->errors;
    }
}
