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
      $actual = ob_get_clean();
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
   * @dataProvider dataTestXlGenericWrapper
   */
  public function testXlGenericWrapper($translate,$word,$expected,$mode,$prepend,$append,$language_choice) {
    $_SESSION['language_choice'] = $language_choice;
    
    // mode 'e' echo's to stdout
    if($mode == "e") {
      ob_start();
      xl_generic_wrapper($translate, $word, $mode, $prepend, $append);
      $actual = ob_get_clean();
    } else {
      $actual = xl_generic_wrapper($translate, $word, $mode, $prepend, $append);
    }
    $this->assertEquals($expected, $actual, "Lang [$language_choice] expected [$expected] but recv'd [$actual]");
  }

  /**
   * @dataProvider dataTestXlGenericWrapper
   */
  public function testXlListLabel($translate,$word,$expected,$mode,$prepend,$append,$language_choice) {
    $_SESSION['language_choice'] = $language_choice;
    $GLOBALS['translate_lists'] = $translate;

    // mode 'e' echo's to stdout
    if($mode == "e") {
      ob_start();
      xl_list_label($word, $mode, $prepend, $append);
      $actual = ob_get_clean();
    } else {
      $actual = xl_list_label($word, $mode, $prepend, $append);
    }
    $this->assertEquals($expected, $actual, "Lang [$language_choice] expected [$expected] but recv'd [$actual]");
  }

  /**
   * @dataProvider dataTestXlGenericWrapper
   */
  public function testXlLayoutLabel($translate,$word,$expected,$mode,$prepend,$append,$language_choice) {
    $_SESSION['language_choice'] = $language_choice;
    $GLOBALS['translate_layout'] = $translate;

    // mode 'e' echo's to stdout
    if($mode == "e") {
      ob_start();
      xl_layout_label($word, $mode, $prepend, $append);
      $actual = ob_get_clean();
    } else {
      $actual = xl_layout_label($word, $mode, $prepend, $append);
    }
    $this->assertEquals($expected, $actual, "Lang [$language_choice] expected [$expected] but recv'd [$actual]");
  }

  /**
   * @dataProvider dataTestXlGenericWrapper
   */
  public function testXlGaclGroup($translate,$word,$expected,$mode,$prepend,$append,$language_choice) {
    $_SESSION['language_choice'] = $language_choice;
    $GLOBALS['translate_gacl_groups'] = $translate;

    // mode 'e' echo's to stdout
    if($mode == "e") {
      ob_start();
      xl_gacl_group($word, $mode, $prepend, $append);
      $actual = ob_get_clean();
    } else {
      $actual = xl_gacl_group($word, $mode, $prepend, $append);
    }
    $this->assertEquals($expected, $actual, "Lang [$language_choice] expected [$expected] but recv'd [$actual]");
  }

  /**
   * @dataProvider dataTestXlGenericWrapper
   */
  public function testXlFormTitle($translate,$word,$expected,$mode,$prepend,$append,$language_choice) {
    $_SESSION['language_choice'] = $language_choice;
    $GLOBALS['translate_form_titles'] = $translate;

    // mode 'e' echo's to stdout
    if($mode == "e") {
      ob_start();
      xl_form_title($word, $mode, $prepend, $append);
      $actual = ob_get_clean();
    } else {
      $actual = xl_form_title($word, $mode, $prepend, $append);
    }
    $this->assertEquals($expected, $actual, "Lang [$language_choice] expected [$expected] but recv'd [$actual]");
  }

  /**
   * @dataProvider dataTestXlGenericWrapper
   */
  public function testXlDocumentCategory($translate,$word,$expected,$mode,$prepend,$append,$language_choice) {
    $_SESSION['language_choice'] = $language_choice;
    $GLOBALS['translate_document_categories'] = $translate;

    // mode 'e' echo's to stdout
    if($mode == "e") {
      ob_start();
      xl_document_category($word, $mode, $prepend, $append);
      $actual = ob_get_clean();
    } else {
      $actual = xl_document_category($word, $mode, $prepend, $append);
    }
    $this->assertEquals($expected, $actual, "Lang [$language_choice] expected [$expected] but recv'd [$actual]");
  }

  /**
   * @dataProvider dataTestXlGenericWrapper
   */
  public function testXlApptCategory($translate,$word,$expected,$mode,$prepend,$append,$language_choice) {
    $_SESSION['language_choice'] = $language_choice;
    $GLOBALS['translate_appt_categories'] = $translate;

    // mode 'e' echo's to stdout
    if($mode == "e") {
      ob_start();
      xl_appt_category($word, $mode, $prepend, $append);
      $actual = ob_get_clean();
    } else {
      $actual = xl_appt_category($word, $mode, $prepend, $append);
    }
    $this->assertEquals($expected, $actual, "Lang [$language_choice] expected [$expected] but recv'd [$actual]");
  }

  public static function dataTestXlGenericWrapper() {
    return array(
      array(TRUE,'Cell Phone Number','Cell Phone Number','r','','','1'),
      array(TRUE,'Cell Phone Number','Mobiltelefonnummer','r','','','2'),
      array(TRUE,'Cell Phone Number','Teléfono Móvil','r','','','3'),
      array(TRUE,'Cell Phone Number','Mobiel nummer','r','','','6'),
      array(TRUE,'Cell Phone Number','Cell Phone Number','e','','','1'),
      array(TRUE,'Cell Phone Number','Mobiltelefonnummer','e','','','2'),
      array(TRUE,'Cell Phone Number','Teléfono Móvil','e','','','3'),
      array(TRUE,'Cell Phone Number','Mobiel nummer','e','','','6'),
      array(FALSE,'Cell Phone Number','Cell Phone Number','r','','','1'),
      array(FALSE,'Cell Phone Number','Cell Phone Number','r','','','2'),
      array(FALSE,'Cell Phone Number','Cell Phone Number','r','','','3'),
      array(FALSE,'Cell Phone Number','Cell Phone Number','r','','','6'),
      array(FALSE,'Cell Phone Number','Cell Phone Number','e','','','1'),
      array(FALSE,'Cell Phone Number','Cell Phone Number','e','','','2'),
      array(FALSE,'Cell Phone Number','Cell Phone Number','e','','','3'),
      array(FALSE,'Cell Phone Number','Cell Phone Number','e','','','6'),
    );
  }

  /**
   * Multibyte safe string padding
   * @dataProvider dataTestMbStrpad
   */
  public function testMbStrpad($input, $expected, $length, $pad, $type, $charset = 'UTF-8') {
      $actual = mb_strpad($input, $length, $pad, $type, $charset);
      $this->assertEquals($expected, $actual, "MB String [$input] padded and returned [$actual] but expected [$expected]");
  }

  public static function dataTestMbStrpad() {
    return array(
      array('A','A','-1','*',STR_PAD_LEFT),
      array('A','A','-1','*',STR_PAD_RIGHT),
      array('A','A','-1','*',STR_PAD_BOTH),
      array('ﬠ','ﬠ','-1','*',STR_PAD_LEFT),
      array('ﬠ','ﬠ','-1','*',STR_PAD_RIGHT),
      array('ﬠ','ﬠ','-1','*',STR_PAD_BOTH),
      array('A','A','0','*',STR_PAD_LEFT),
      array('A','A','0','*',STR_PAD_RIGHT),
      array('A','A','0','*',STR_PAD_BOTH),
      array('ﬠ','ﬠ','0','*',STR_PAD_LEFT),
      array('ﬠ','ﬠ','0','*',STR_PAD_RIGHT),
      array('ﬠ','ﬠ','0','*',STR_PAD_BOTH),
      array('A','A','1','*',STR_PAD_LEFT),
      array('A','A','1','*',STR_PAD_RIGHT),
      array('A','A','1','*',STR_PAD_BOTH),
      array('ﬠ','ﬠ','1','*',STR_PAD_LEFT),
      array('ﬠ','ﬠ','1','*',STR_PAD_RIGHT),
      array('ﬠ','ﬠ','1','*',STR_PAD_BOTH),
      array('A','**A','3','*',STR_PAD_LEFT),
      array('A','A**','3','*',STR_PAD_RIGHT),
      array('A','*A*','3','*',STR_PAD_BOTH),
      array('ﬠ','**ﬠ','3','*',STR_PAD_LEFT),
      array('ﬠ','ﬠ**','3','*',STR_PAD_RIGHT),
      array('ﬠ','*ﬠ*','3','*',STR_PAD_BOTH),
      array('ﬠ','ﬤﬤﬠ','3','ﬤ',STR_PAD_LEFT),
      array('ﬠ','ﬠﬤﬤ','3','ﬤ',STR_PAD_RIGHT),
      array('ﬠ','ﬤﬠﬤ','3','ﬤ',STR_PAD_BOTH),
      array('ﬠ','ﬤﬤﬤﬠ','4','ﬤ',STR_PAD_LEFT),
      array('ﬠ','ﬠﬤﬤﬤ','4','ﬤ',STR_PAD_RIGHT),
      array('ﬠ','ﬤﬠﬤﬤ','4','ﬤ',STR_PAD_BOTH),
    );
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
