<?php

/**
 * (c) Tajiri Llc
 * @author Daniel Zema <zema.d@tajiri.llc>
 *
 */
namespace App\Service\DataFixtures\Providers;


use App\Entity\User;
use DateTime;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class FixturesProvider
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function brands(): string
    {
        $names = array(
            'Toyota',
            'Audi',
            'BMW',
            'Volkswagen',
            'Mercedes',
            'Nissan',
            'Hyundai',
            'Ford',
            'Lexus',
            'Jeep',
            'Jetour',
            'Tata',
            'Citroën',
            'Infiniti',
            'Mazda',
            'Suzuki',
        );

        return $names[array_rand($names)];
    }
    public function grades(): string
    {
        $names = array(
            'Colonel',
            'Sergent',
            'Capitaine',
            'Major',
            'Sergent-major',
            'Caporal',
            'OPJ',
            'Lieutenant',
            'Sous-Lieutenant',
            'General'
        );

        return $names[array_rand($names)];
    }
    public function gender(): string
    {
        $names = array(
            'M',
            'F'
        );

        return $names[array_rand($names)];
    }
    public function locationTypes(): string
    {
        $names = array(
            'Country',
            'Province',
            'District',
            'City',
            'Town'
        );

        return $names[array_rand($names)];
    }
    public function vehicleTypes(): string
    {
        $names = array(
            '4x4',
            'Berline',
            'Moto',
            'Camion',
            'USV'
        );

        return $names[array_rand($names)];
    }

    public function encodePassword(string $plainPassword): string
    {
        return $this->hasher->hashPassword(new User(), $plainPassword);
    }

}