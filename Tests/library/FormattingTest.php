<?php
/* Copyright © 2010 by Andrew Moore <amoore@cpan.org>     */
/* Licensing information appears at the end of this file. */
/* Tests added by Ian Wallace to cover entire file.       */

require_once('Tests/BaseHarness.class.php');
require_once('library/formatting.inc.php');

class FormattingTest extends BaseHarness {

  /**
   * @dataProvider dataOeFormatShortDateData
   */
  public function testOeFormatShortDate( $oeShortDate, $dateDisplayFormat, $expected ) {
  	$GLOBALS['date_display_format'] = $dateDisplayFormat;
    $actual = oeFormatShortDate($oeShortDate);
    $this->assertEquals( $expected, $actual, "'$oeShortDate' converts to '$actual' but expected '$expected'");
  }

  public static function dataOeFormatShortDateData() {
    // Function assumes that all dates are in yyyy-mm-dd format to start
    // display format 1 => mm/dd/yyyy
    // display format 2 => dd/mm/yyyy
    // function assumes that the input is 10 char long, if not just returns what was passed
    return array( array('2000-01-01',1,'01/01/2000'),
                  array('1901-12-31',1,'12/31/1901'),
                  array('2999-06-50',1,'06/50/2999'),
                  array('50939-06-31',1,'50939-06-31'),
                  array('2000-01-01',2,'01/01/2000'),
                  array('1901-12-31',2,'31/12/1901'),
                  array('2999-06-50',2,'50/06/2999'),
                  array('50939-06-31',2,'50939-06-31'),
                  );
  }

  /**
   * @dataProvider dataOeFormatMoney
   */
  public function testOeFormatMoney( $amount, $expected ) {
    $GLOBALS['currency_decimals']       = '2';
    $GLOBALS['currency_dec_point']      = '.';
    $GLOBALS['currency_thousands_sep']  = ',';
    $actual = oeFormatMoney($amount);
    $this->assertEquals( $expected, $actual, "'$amount' converts to '$actual' but expected '$expected'" );
  }

  public static function dataOeFormatMoney() {
    return array( array(0,          '0.00'),
                  array(1,          '1.00'),
                  array(11,         '11.00'),
                  array('12.3',     '12.30'),
                  array('12.34',    '12.34'),
                  array('12.344',   '12.34'), // round down
                  array('12.345',   '12.35'), // round up
                  array('123.45',   '123.45'),
                  array('1234.56',  '1,234.56'),
                  array('12345.67', '12,345.67'),
                  );
  }

  /**
   * @dataProvider dataOeFormatTime
   */
  public function testOeFormatTime( $oeTime, $timeFormat, $expected ) {
  	$GLOBALS['time_display_format'] = $timeFormat;
    $actual = oeFormatTime($oeTime);
    $mytime = strtotime($oeTime);
    $this->assertEquals( $expected, $actual, "TimeFormat [$timeFormat] strtotime '$mytime' expected '$expected' but recv'd '$actual'");
  }

  public static function dataOeFormatTime () {
  	return array(
        // 24 hour tests
        array('00:00:00',0,'00:00'),
        array('13:00:15',0,'13:00'),
        array('01:15 PM',0,'13:15'),
        array('11:59:59 pM',0,'23:59'),
        // 12 hour tests
        array('00:00',1,'12:00 am'),
        array('14:59',1,'2:59 pm'),
        array('23:59:59',1,'11:59 pm'),
        array('09:00:01',1,'9:00 am'),
        // For formats out of range just return what you recv'd
        array('zz:gg:9504',55,'zz:gg:9504'),
        array('17:30:00 PST',3,'17:30:00 PST')
    );
  }

  /**
   * @dataProvider dataOeFormatSDFT
   *
   * This test relies on the fact that we set the date.timezone to UTC in the
   * phpunit.xml file.  Otherwise the days are off by either one day forward or
   * backward due to the timezone shifts.
   */
  public function testOeFormatSDFT( $oeTime, $dateFormat, $expected ) {
    $GLOBALS['date_display_format'] = $dateFormat;
    $actual = oeFormatSDFT($oeTime);
    $this->assertEquals( $expected, $actual, "FormatSDFT ['$dateFormat'] expected '$expected' but recv'd '$actual'");
  }

  public static function dataOeFormatSDFT () {
  	return array (
        array (172802,0,'1970-01-03'),
        array (1578009600,0,'2020-01-03'),
        array (1270947250,0,'2010-04-11'),
        array (172802,1,'01/03/1970'),
        array (1578009600,1,'01/03/2020'),
        array (1270947250,1,'04/11/2010'),
        array (172802,2,'03/01/1970'),
        array (1578009600,2,'03/01/2020'),
        array (1270947250,2,'11/04/2010'),
    );
  }

  /**
   * @dataProvider dataOeFormatPatientNote
   */
  public function testOeFormatPatientNote ( $patientNote, $dateFormat, $expected) {
    $GLOBALS['date_display_format'] = $dateFormat;
    $actual = oeFormatPatientNote($patientNote);
    $this->assertEquals( $expected, $actual, "FormatPatientNote ['$dateFormat'] expect '$expected' but recv'd '$actual'");
  }

  public static function dataOeFormatPatientNote () {
  	return array(
        array('1950-01-15 My patient arrived with pain.'.PHP_EOL.'1965-03-15 Patient in for refill of meds.'.PHP_EOL,1,
              '01/15/1950 My patient arrived with pain.'.PHP_EOL.'03/15/1965 Patient in for refill of meds.'.PHP_EOL),
        array('1986-06-16 Pt acute viral illness.'.PHP_EOL.'1995-08-32 Arrived with family for discussions.'.PHP_EOL,2,
              '16/06/1986 Pt acute viral illness.'.PHP_EOL.'32/08/1995 Arrived with family for discussions.'.PHP_EOL),
        array('1950-03-10 Zero'.PHP_EOL.'1951-04-11 One'.PHP_EOL.'1952-05-12 Two'.PHP_EOL.'1953-06-13 Three'.PHP_EOL,3,
              '1950-03-10 Zero'.PHP_EOL.'1951-04-11 One'.PHP_EOL.'1952-05-12 Two'.PHP_EOL.'1953-06-13 Three'.PHP_EOL),
    );
  }

  public function testOeFormatClientID() {
  	$id = "ABC123DEF456";
    $actual = oeFormatClientID($id);
    $this->assertEquals( $id, $actual, "Expected '$id' but recieved '$actual'");
  }

  /**
   * Function to return formatting, if dateFormat is not supported, just return
   * nothing (rather than raising exception)
   *
   * @dataProvider dataDateFormatRead
   */
  public function testDateFormatRead($dateFormat, $expected) {
    $GLOBALS['date_display_format'] = $dateFormat;
    $actual = DateFormatRead();
    $this->assertEquals($expected, $actual, "Passed => $dateFormat returning '$actual' but expected '$expected'");
  }

  public static function dataDateFormatRead() {
  	return array(
        array(0,'%Y-%m-%d'),
        array(1,'%m/%d/%Y'),
        array(2,'%d/%m/%Y'),
        array(3,''),
        array('bogus-value','%Y-%m-%d')
    );
  }

  /**
   * @dataProvider dataDateToYYYYMMDD
   */
  public function testDateToYYYYMMDD($dataDate, $dateFormat, $expected) {
    $GLOBALS['date_display_format'] = $dateFormat;
    $actual = DateToYYYYMMDD($dataDate);
    $this->assertEquals($expected, $actual, "Date format '$dateFormat' with date '$dataDate' converts to '$actual' but expected '$expected'" );
  }

  public static function dataDateToYYYYMMDD () {
  	return array(
        array('',0,''),
        array('1901-01-31',0,'1901-01-31'),
        array('10/05/1950',1,'1950-10-05'),
        array('25/03/1985',2,'1985-03-25'),
        array('12/34/5678',1,'5678-12-34'),
        array('98/76/5432',2,'5432-76-98'),
        array('01/02/1903',3,''),
        // string values eval to dateFormat of 0
        array('01/01/2001','bogus-value','01/01/2001'),
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
