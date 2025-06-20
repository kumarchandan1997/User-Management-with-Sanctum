<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Exception;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = $this->getSeedUsers();

        foreach ($users as $index => $entry) {
            try {
                $user = $this->createUser($entry['user']);
                $this->createUserProfile($user, $entry['profile']);
                $this->createUserAddresses($user, $entry['addresses']);

                $this->command->info("User {$user->email} seeded successfully.");
            } catch (Exception $e) {
                Log::error("UserSeeder failed for user #{$index} ({$entry['user']['email']}): " . $e->getMessage());
                $this->command->error("Failed to seed user: {$entry['user']['email']}. Check logs.");
                continue;
            }
        }
    }

    protected function getSeedUsers(): array
    {
        return [
            [
                'user' => [
                    'name' => 'home_page',
                    'email' => 'test@example.com',
                    'password' => 'password',
                ],
                'profile' => [
                    'dob' => '1990-01-14',
                    'gender' => 'Male',
                ],
                'addresses' => [
                    [
                        'address_type' => 'home',
                        'address_details' => [
                            'door/street' => '1st Main Rd, Rajiv Nagar',
                            'landmark' => 'Zxy building',
                            'city' => 'Chennai',
                            'state' => 'Tamil Nadu',
                            'country' => 'India',
                        ],
                        'primary' => 'No',
                    ],
                    [
                        'address_type' => 'Office',
                        'address_details' => [
                            'door/street' => 'West Cross Rd, Chinmayi Nagar',
                            'landmark' => 'White Cross Building',
                            'city' => 'Brooklyn',
                            'state' => 'New York',
                            'country' => 'USA',
                        ],
                        'primary' => 'No',
                    ],
                ],
            ],
            [
                'user' => [
                    'name' => 'john_doe',
                    'email' => 'john@example.com',
                    'password' => 'secure123',
                ],
                'profile' => [
                    'dob' => '1985-08-21',
                    'gender' => 'Male',
                ],
                'addresses' => [
                    [
                        'address_type' => 'home',
                        'address_details' => [
                            'door/street' => '2nd Street, Green Valley',
                            'landmark' => 'Near Park',
                            'city' => 'Hyderabad',
                            'state' => 'Telangana',
                            'country' => 'India',
                        ],
                        'primary' => 'Yes',
                    ],
                    [
                        'address_type' => 'Office',
                        'address_details' => [
                            'door/street' => 'IT Park Rd, Cyber Towers',
                            'landmark' => 'Opposite Main Gate',
                            'city' => 'Hyderabad',
                            'state' => 'Telangana',
                            'country' => 'India',
                        ],
                        'primary' => 'No',
                    ],
                ],
            ],
        ];
    }

    protected function createUser(array $data): User
    {
        return User::create([
            'name' => e($data['name']),
            'email' => filter_var($data['email'], FILTER_SANITIZE_EMAIL),
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function createUserProfile(User $user, array $profileData): void
    {
        $user->profile()->create([
            'dob' => $profileData['dob'],
            'gender' => e($profileData['gender']),
        ]);
    }

    protected function createUserAddresses(User $user, array $addresses): void
    {
        $sanitizedAddresses = array_map(function ($address) {
            return [
                'address_type' => e($address['address_type']),
                'address_details' => array_map('e', $address['address_details']),
                'primary' => $address['primary'],
            ];
        }, $addresses);

        $user->addresses()->createMany($sanitizedAddresses);
    }
}
