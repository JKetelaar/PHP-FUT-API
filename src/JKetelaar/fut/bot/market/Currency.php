<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\market;

class Currency {

    const TAG = 'currencies';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $funds;

    /**
     * @var string
     */
    private $finalFunds;

    /**
     * Currency constructor.
     *
     * @param string $name
     * @param string $funds
     * @param string $finalFunds
     */
    public function __construct($name, $funds, $finalFunds) {
        $this->name       = $name;
        $this->funds      = $funds;
        $this->finalFunds = $finalFunds;
    }

    /**
     * @return string
     */
    public function getFunds() {
        return $this->funds;
    }

    /**
     * @return string
     */
    public function getFinalFunds() {
        return $this->finalFunds;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }
}