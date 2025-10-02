<?php
// database/factories/StoreFactory.php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
	public function definition(): array
	{
		return [
			'name' => 'Магазин ' . $this->faker->streetName(),
			'street' => $this->faker->streetAddress(),
			'city' => 'Москва',
			'postal_code' => $this->faker->postcode(),
			'phone' => '+7 (495) ' . $this->faker->numberBetween(100, 999) . '-' . $this->faker->numberBetween(10, 99) . '-' . $this->faker->numberBetween(10, 99),
			'email' => $this->faker->safeEmail(),
			'map_url' => 'https://yandex.ru/maps/?text=' . urlencode($this->faker->address()),
			'working_hours' => [
				'Пн-Пт' => '10:00–20:00',
				'Сб' => '11:00–19:00',
				'Вс' => 'выходной',
			],
			'is_active' => true,
		];
	}
}
