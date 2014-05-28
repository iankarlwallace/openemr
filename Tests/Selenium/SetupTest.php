<?php
/**
 * Selenium Test Case for setup.php page.  Not completed.
 */
class SetupTest extends PHPUnit_Extensions_SeleniumTestCase {

    protected function setUp() {
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://localhost');
    }

    //public function testInstallSetupPage()
    //{
        // $this->open('http://localhost');
        // $this->assertEquals('OpenEMR Setup Tool', $this->getTitle());

        // Should assert that all directory checks are green color

        //$this->clickAndWait('css=input[type="SUBMIT"]');
        //$this->clickAndWait('css=input[type="SUBMIT"]');
        //$this->type('name=pass','openemr');
        //$this->type('name=rootpass','Lrb4x4bf12');
        //$this->type('name=iuserpass','admin');
        //$this->clickAndWait('css=input[type="SUBMIT"]');
        //$this->clickAndWait('css=input[type="SUBMIT"]');
        //$this->clickAndWait('css=input[type="SUBMIT"]');
        //$this->clickAndWait('css=input[type="SUBMIT"]');
        //$this->clickAndWait('css=input[type="SUBMIT"]');
        //$this->clickAndWait('link="Click here to start *"');
    //}
}

?>
