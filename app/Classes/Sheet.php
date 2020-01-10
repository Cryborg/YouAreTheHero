<?php

namespace App\Classes;

use App\Models\Character;
use App\Models\Story;

class Sheet
{
    protected $stats = [];

    public function __construct($mixed)
    {
        if (get_class($mixed) === Story::class) {
            if ($mixed->sheet_config) {
                foreach ($mixed->sheet_config as $name => $value) {
                    $this->stats[$name] = $value;
                }
            }
        }

        if (get_class($mixed) === Character::class) {
            foreach ($mixed->sheet as $name => $value) {
                $this->stats[$name] = $value;
            }
        }
    }

    public function add(string $stat, int $quantity)
    {
        $this->stats[$stat] += $quantity;
    }

    public function get(string $stat)
    {
        return $this->stats[$stat];
    }

    public function getArray()
    {
        return $this->stats;
    }
}
