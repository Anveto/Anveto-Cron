<?php
/**
 *
 * @author     Anveto <dev@anveto.com>
 * @copyright  Copyright (c) Anveto AB - Markus Tenghamn 2015
 * @version    $Id$
 * @link       http://anveto.com/
 * 
 * MIT License
 * 
 * Copyright (c) 2017 Anveto - Markus Tenghamn
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * How to use:
 *
 * This file should be placed in the whmcs root folder and called by a cron job
 *
 */

define("CLIENTAREA",true);

require("init.php");

class Anveto_Cron {

    private $anvetofiles = array("modules/addons/anveto_currency_rates/anveto_currency_rates.php");

    function __construct() {

    }

    public function run()
    {
        foreach ($this->anvetofiles as $af) {
            if (file_exists(__DIR__.'/'.$af)) {
                include_once(__DIR__.'/'.$af);
                if (class_exists("Anveto_Currency_Rates")) {
                    $anvetocurrencyrates = new Anveto_Currency_Rates();
                    $anvetocurrencyrates->cron();
                }
            }
        }
    }

}
$anvetocron = new Anveto_Cron();
$anvetocron->run();

?>