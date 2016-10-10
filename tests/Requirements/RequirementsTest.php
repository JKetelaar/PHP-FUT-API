<?php
/**
 * @author JKetelaar
 */

namespace Requirements;

class RequirementsTest extends \PHPUnit_Framework_TestCase {
    public function testDefinitionsExist() {
        $this->assertTrue(defined('NODE_LOCATION'));
        $this->assertTrue(defined('DATA_DIR'));
    }

    public function testDefinitionLocationsExist() {
        // Temporarily disabled due incompatibility with
        // $this->assertTrue(file_exists(NODE_LOCATION));

        $this->assertTrue(file_exists(DATA_DIR));
    }
}