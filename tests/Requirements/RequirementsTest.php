<?php
/**
 * @author JKetelaar
 */

namespace Requirements;

class RequirementsTest extends \PHPUnit_Framework_TestCase {
    public function testDefinitionsExist() {
        $this->assertTrue(defined('DATA_DIR'));
    }

    public function testDefinitionLocationsExist() {
        $this->assertTrue(file_exists(DATA_DIR));
    }
}