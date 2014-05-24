<?php
/* Copyright © 2010 by Ian Wallace iankarlwallace at gmail dot com */
/* Licensing information appears at the end of this file.          */

require_once ('Tests/BaseHarness.class.php');

class TranslationIncTest extends BaseHarness {

  /**
   *
   * @dataProvider dataTestXl
   * 
   * Core function that takes constant, mode, prepend, append
   * Looks at $_SESSION['language_choice'] to decide on target language
   * and looks at $GLOBALS['skip_english_translation'] in case you want
   * to skip ranslation altogether (only for lang_id == 1) but will strip
   * comments - anything inbewteen '{{ }}'
   */
  public function testXl($word, $expected, $mode, $prepend, $append, $language_choice, $skip_english_translation) {
    $_SESSION['language_choice'] = $language_choice;
    $GLOBALS['skip_english_translation'] = $skip_english_translation;

    // mode 'e' echo's to stdout
    if($mode == "e") {
      ob_start();
      xl($word, $mode, $prepend, $append);
      $actual = ob_get_contents();
      ob_end_clean();
    } else {
      $actual = xl($word, $mode, $prepend, $append);
    }
    $this->assertEquals($expected, $actual, "Lang [$language_choice] expected [$expected] but recv'd [$actual]");
  }

  public static function dataTestXl() {
    return array(
      array('No Translation {{ Comment }}','No Translation ','r','','',1,TRUE),
      array('No Translation {{ Comment }}','pre-No Translation ','r','pre-','',1,TRUE),
      array('No Translation {{ Comment }}','No Translation -app','r','','-app',1,TRUE),
      array('No Translation {{ Comment }}','pre-No Translation -app','r','pre-','-app',1,TRUE),
      array('No Translation {{ Comment }}','No Translation ','e','','',1,FALSE),
      array('No Translation {{ Comment }}','pre-No Translation ','e','pre-','',1,FALSE),
      array('No Translation {{ Comment }}','No Translation -app','e','','-app',1,FALSE),
      array('No Translation {{ Comment }}','pre-No Translation -app','e','pre-','-app',1,FALSE),
      array("Need for stripping new lines\nand remove all of windows EOF\r\r.", 'Need for stripping new lines and remove all of windows EOF.','r','','',1,FALSE),
      array("Need for stripping new lines\nand remove all of windows EOF\r\r.", 'Need for stripping new lines and remove all of windows EOF.','e','','',1,FALSE),
    );
  }

  /**
   * Wrapper functions that just can xl() under the hood.  Could use a refactoring to reduce duplicated code
   */
  public function testXlListLabel() {
      $this->markTestIncomplete();
  }

  public function testXlLayoutLabel() {
      $this->markTestIncomplete();
  }

  public function testXlGaclGroup() {
      $this->markTestIncomplete();
  }

  public function testXlFormTitle() {
      $this->markTestIncomplete();
  }

  public function testXlDocumentCategory() {
      $this->markTestIncomplete();
  }

  public function testXlApptCategory() {
      $this->markTestIncomplete();
  }


  /**
   * Multibyte safe string padding
   */
  public function testMbStrpad() {
      $this->markTestIncomplete();
  }

  /**
   * This function is really dead but for full coverage call it anyway.
   */
  public function testHtmlHeaderShow() {
    html_header_show();
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
