<?php

use Tests\Utils\Models\Task;
use Tests\Utils\Models\TaskTargetDay;
use Faker\Generator as Faker;

/* @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(TaskTargetDay::class, function (Faker $faker): array {
    return [
        'task_id' => function () {
            return factory(Task::class)->create()->getKey();
        },
        'day' => $faker->date(),
    ];
});
