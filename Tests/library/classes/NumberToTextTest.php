<?php
/* Copyright © 2010 by Andrew Moore */
/* Licensing information appears at the end of this file. */

require_once('library/classes/NumberToText.class.php');

class NumberToTextTest extends PHPUnit_Framework_TestCase
{

  /**
   * @dataProvider numberToTextConvertCases
   */
  public function testConvert( $number, $currency, $capitalize, $and, $text )
  {
    $ntt = new NumberToText( $number, $currency, $capitalize, $and );
    $this->assertEquals( $text, $ntt->convert(), "'$number' converts to '$text'" );
  }

  public static function numberToTextConvertCases() {
    return array( array( 0, false, false, false, 'zero'),
                  array( 1, false, false, false, 'one'),
                  array( 14000, false, false, false, 'fourteen thousand'),
                  array( 9, false, false, false, 'nine'),
                  array( 99,false, false, false, 'ninety-nine'),
                  array( 100, false, false, false, 'one hundred'),
                  array( 1000, false, false, false, 'one thousand'),
                  array( 1111, false, false, false, 'one thousand one hundred eleven'),
                  array( '00493', false, false, false, 'four hundred ninety-three'),
                  array( -15, false, false, false, 'negative fifteen'),
                  array( '-00500', false, false, false, 'negative five hundred'),
                  array( -1943, false, false, false, 'negative one thousand nine hundred forty-three'),
                  array( 10.54, false, false, false, 'ten point five four'),
                  array( -938.67, false, false, false, 'negative nine hundred thirty-eight point six seven'),
                  array( '1', true, false, false, 'one dollar'),
                  array( '5.03', true, false, false, 'five dollars and three cents'), // INCORRECT AND NEED TO BE FIXED
                  array( '63.01', true, false, false, 'sixty-three dollars and one cent'), // INCORRET AND NEED TO BE FIXED
                  array( 503, false, false, true, 'five hundred and three'), // << INCORRECT HAS EXTRA SPACE "hundred" and "and" both add spaces before
                  array( '1000000000000000000000000000000000000000000000000000000000000000001', false, false, false, 'one thousand vigintillion one'),
                  array( 569392, false, true, false, 'Five Hundred Sixty-nine Thousand Three Hundred Ninety-two'),
                  array( 569392, false, true, true, 'Five Hundred and Sixty-nine Thousand Three Hundred and Ninety-two'),
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
