<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prerequisite extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function prerequisiteable()
    {
        return $this->morphTo();
    }

    public static function isFulfilled($condition1, $operator, $condition2)
    {
        switch ($operator)
        {
            case '>=':
                return $condition1 >= $condition2;
                break;
            case '<=':
                return $condition1 <= $condition2;
                break;
            case '=':
                return $condition1 === $condition2;
                break;
            case '>':
                return $condition1 > $condition2;
                break;
            case '<':
                return $condition1 < $condition2;
                break;
        }
    }

    public static function getOperator($value)
    {
        $values = collect([
            'gte' => '>=',
            'lte' => '<=',
            'eq' => '=',
        ]);

        if ($values->has($value)) {
            return $values->get($value);
        }

        return $values->get('gte');
    }
}
