<?php
/* Copyright © 2010 by Ian Wallace iankarlwallace at gmail dot com */
/* Licensing information appears at the end of this file.          */

require_once ('Tests/BaseHarness.class.php');

class DateFunctionsTest extends BaseHarness {

  /**
   * @dataProvider dataDateFormat
   */
  public function testDateFormat($langChoice,$dow,$date,$expected) {
    $_SESSION['language_choice'] = $langChoice;
    $actual = dateformat($date, $dow);
    $this->assertEquals($expected, $actual, "For '$langChoice' sent '$date' expected '$expected' but recv'd '$actual'");
  }

  public static function dataDateFormat() {
    return array(array(1,FALSE,1388880000,'January 5, 2014'),
                array(1,TRUE,1388880000,'Sunday, January 5, 2014'),
                array(1,FALSE,1388966400,'January 6, 2014'),
                array(1,TRUE,1388966400,'Monday, January 6, 2014'),
                array(1,FALSE,1389052800,'January 7, 2014'),
                array(1,TRUE,1389052800,'Tuesday, January 7, 2014'),
                array(1,FALSE,1389139200,'January 8, 2014'),
                array(1,TRUE,1389139200,'Wednesday, January 8, 2014'),
                array(1,FALSE,1389225600,'January 9, 2014'),
                array(1,TRUE,1389225600,'Thursday, January 9, 2014'),
                array(1,FALSE,1389312000,'January 10, 2014'),
                array(1,TRUE,1389312000,'Friday, January 10, 2014'),
                array(1,FALSE,1389398400,'January 11, 2014'),
                array(1,TRUE,1389398400,'Saturday, January 11, 2014'),
    );
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
