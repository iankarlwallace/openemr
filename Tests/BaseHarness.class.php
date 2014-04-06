<?php
/* Copyright © 2010 by Andrew Moore */
/* Licensing information appears at the end of this file. */

class BaseHarness extends PHPUnit_Framework_TestCase
{

  public static function setUpBeforeClass()
  {
    global $ignoreAuth;
    global $fake_register_globals;
    global $sanitize_all_escapes;

    $_SESSION['site_id']   = 'default';
    $_SESSION['authUser']  = 'testopenemr';
    $_SESSION['authGroup'] = 'testgroup';

    $_SERVER['REQUEST_URI'] = '/';
    $_SERVER['SERVER_NAME'] = 'localhost';
    $_SERVER['HTTP_HOST']   = 'localhost';
    $_SERVER['DOCUMENT_ROOT'] = dirname(__FILE__);

    // No audit logging on tests
    $GLOBALS['enable_auditlog'] = 0;
    $ignoreAuth = TRUE;
    $fake_register_globals=false;
    $sanitize_all_escapes=true;

    require_once(dirname(__FILE__) . '/../interface/globals.php');
  }

  public static function tearDownAfterClass()
  {
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
