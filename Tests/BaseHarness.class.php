<?php
/* Copyright © 2010 by Andrew Moore */
/* Licensing information appears at the end of this file. */

class BaseHarness extends PHPUnit_Framework_TestCase
{

  /**
   * For tests that use a DB connection we can not backup/restore
   * the GLOBALS['adodb'] -> it stores caching info, etc  that will
   * break tests, just ignore it and let adodb deal with it
   */
  protected $backupGlobalsBlacklist = array(
   'adodb',
  );

  public static function setUpBeforeClass() {
    $_SESSION['site_id']   = 'default';
    $_SESSION['authUser']  = 'testopenemr';
    $_SESSION['authGroup'] = 'testgroup';

    $_SERVER['REQUEST_URI'] = '/';
    $_SERVER['SERVER_NAME'] = 'localhost';
    $_SERVER['HTTP_HOST']   = 'localhost';
    $_SERVER['DOCUMENT_ROOT'] = '/';

    $GLOBALS['enable_auditlog'] = 0;
    $GLOBALS['fake_register_globals'] = FALSE;
    $GLOBALS['sanitize_all_escapes'] = FALSE;

    $ignoreAuth = TRUE;
    $css_header = '/interface/themes/default_style.css';
    $backpic = 'no-backpic.jpg';

    require_once('interface/globals.php');
  }

  public static function tearDownAfterClass() {
    unset($_SESSION['site_id']);
    unset($_SESSION['authUser']);
    unset($_SESSION['authGroup']);

    unset($_SERVER['REQUEST_URI']);
    unset($_SERVER['SERVER_NAME']);
    unset($_SERVER['HTTP_HOST']);
    unset($_SERVER['DOCUMENT_ROOT']);

    unset($GLOBALS['enable_auditlog']);
    unset($GLOBALS['ignoreAuth']);
    unset($GLOBALS['fake_register_globals']);
    unset($GLOBALS['sanitize_all_escapes']);
    unset($GLOBALS['css_header']);
    unset($GLOBALS['backpic']);
  }
}

/*
This file is free software: you can redistribute it and/or modify it under the
terms of the GNU General Public License as publish by the Free Software
Foundation.

This file is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.  See the GNU Gneral Public License for more details.

You should have received a copy of the GNU General Public Licence along with
this file.  If not see <http://www.gnu.org/licenses/>.
*/
?>
