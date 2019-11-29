<?php

namespace App\Classes;

use App\Models\Character;
use App\Models\Story;

class Sheet
{
    protected $caracteristics = [];

    public function __construct($mixed)
    {

        if (get_class($mixed) === Story::class) {

            foreach ($mixed->sheet_config as $name => $value) {
                $this->caracteristics[$name] = $value;
            }
        }

        if (get_class($mixed) === Character::class) {

            foreach ($mixed->sheet as $name => $value) {

                $this->caracteristics[$name] = $value;
            }
        }
    }

    public function add(string $caracteristic, int $quantity)
    {
        $this->caracteristics[$caracteristic] += $quantity;
    }

    public function get(string $caracteristic)
    {
        return $this->caracteristics[$caracteristic];
    }

    public function getArray()
    {
        return $this->caracteristics;
    }
}
