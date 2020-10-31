<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'         => trans('model.title'),
            'content'       => '<p>' . trans('model.content') . '</p>',
            'is_last'       => false,
            'is_checkpoint' => false,
            'layout'        => 'play1',
        ];
    }
}
