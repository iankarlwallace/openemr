<?php
/* Copyright © 2010 by Ian Wallace iankarlwallace at gmail dot com */
/* Licensing information appears at the end of this file.          */

require_once ('Tests/BaseHarness.class.php');

class UserIncTest extends BaseHarness {

  /**
   * @dataProvider dataGetUserSetting
   */
  public function testGetUserSetting($label, $user, $expected) {
    $_SESSION['authUserID'] = $user;

		// Find the default value (no user set)
    $default = getUserSetting($label);

		// Find it by passing in the user
		$user1 = getUserSetting($label, $user);
	
		// Find it by passing user in the session
		$user2 = getUserSetting($label);

		// Default setting
		$this->assertEquals($default, $expected, "Expected '$expected' but recv'd '$default' for '$label'");

		// The different methods of findind the setting should return the same
    $this->assertEquals($user1, $user2, "Getting '$label' for User '$user' recv'd '$user1' while passing in user and recv'd '$user2' if set _SESSION['authUserID]'");
  }

  public static function dataGetUserSetting() {
    return array(
                array('gacl_protect',0,0),
								array('gacl_protect',1,1),
								array('pnotes_ps_expand',0,0),
								array('pnotes_ps_expand',1,0),
								array('allergy_ps_expand',0,1),
								array('allergy_ps_expand',1,1),
								array('dont_exist_option',0,0),
								array('dont_exist_option',1,0),
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
