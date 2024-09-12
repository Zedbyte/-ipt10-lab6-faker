<?php

require_once '../vendor/autoload.php';

use Faker\Factory;

class Random
{
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create('en_PH'); // Corrected access to the faker property
    }

    public function generateRandom($count)
    {
        $data = [];

        for ($i = 0; $i < $count; $i++) {
            $data[] = [
                $this->faker->uuid,
                $this->faker->title,
                $this->faker->firstName,
                $this->faker->lastName,
                $this->faker->streetAddress,
                $this->faker->barangay(), // Using city suffix as a placeholder for Barangay
                $this->faker->municipality(),
                $this->faker->province(),
                "Philippines",
                $this->faker->phoneNumber, 
                $this->faker->mobileNumber(), 
                $this->faker->company,
                $this->faker->domainName,
                $this->faker->jobTitle,
                $this->faker->safeColorName,
                $this->faker->date('Y-m-d'),
                $this->faker->email,
                $this->faker->password,
            ];
        }

        return $data;
    }
}