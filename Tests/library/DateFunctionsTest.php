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

  public function testDateFormatNow() {
    $_SESSION['language_choice'] = "1";
    $actual = dateformat();
    $this->assertNotEmpty( $actual, "Expected date formated for NOW but was empty [$actual]");
  }

  public static function dataDateFormat() {
    return array(
                array(1,FALSE,1388534400,'January 1, 2014'),
                array(1,FALSE,1391299200,'February 2, 2014'),
                array(1,FALSE,1393804800,'March 3, 2014'),
                array(1,FALSE,1396569600,'April 4, 2014'),
                array(1,FALSE,1399248000,'May 5, 2014'),
                array(1,FALSE,1402012800,'June 6, 2014'),
                array(1,FALSE,1404691200,'July 7, 2014'),
                array(1,FALSE,1407456000,'August 8, 2014'),
                array(1,FALSE,1410220800,'September 9, 2014'),
                array(1,FALSE,1412899200,'October 10, 2014'),
                array(1,FALSE,1415664000,'November 11, 2014'),
                array(1,FALSE,1418342400,'December 12, 2014'),
                array(1,TRUE,1388880000,'Sunday, January 5, 2014'),
                array(1,TRUE,1388966400,'Monday, January 6, 2014'),
                array(1,TRUE,1389052800,'Tuesday, January 7, 2014'),
                array(1,TRUE,1389139200,'Wednesday, January 8, 2014'),
                array(1,TRUE,1389225600,'Thursday, January 9, 2014'),
                array(1,TRUE,1389312000,'Friday, January 10, 2014'),
                array(1,TRUE,1389398400,'Saturday, January 11, 2014'),
                array(0,FALSE,1388534400,'January 1, 2014'),
                array(2,FALSE,1388534400,'2014 Januari 01'),
                array(3,FALSE,1388534400,'01 Enero 2014'),
                array(4,FALSE,1388534400,'01 Enero 2014'),
                array(5,FALSE,1388534400,'01 Januar 2014'),
                array(6,FALSE,1388534400,'01 Januari 2014'),
                array(7,FALSE,1388534400,'January 1st 2014'),
                array(8,FALSE,1388534400,'Janvier 01, 2014'),
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
