<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlogPost::class;

    public function configure()
    {
        return $this->afterMaking(function (BlogPost $blogPost) {
            //... do something
        })->afterCreating(function (BlogPost $blogPost) {
            //... do something different
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realTextBetween(20, 80),
            'content' => $this->faker->paragraph(5),
        ];
    }

    public function newTitle()
    {
        return $this->state(function (array $attributes) {
            return [
                'title' => 'New Title',
                'content' => 'Content of the blog post',
            ];
        });
    }
}
