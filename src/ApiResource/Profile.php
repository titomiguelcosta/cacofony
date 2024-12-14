<?php

declare(strict_types=1);

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\State\ProfileProvider;

#[ApiResource(
    operations: [
        new Get(uriTemplate: '/{eid}', output: Profile::class, name: 'profile_get', provider: ProfileProvider::class,),
    ],
    routePrefix: '/profiles',
)]
final class Profile
{
    #[ApiProperty(writable: false, identifier: true)]
    public string $eid = '312a5a85432d2112';
    public string $name = 'John Doe';
    public ?string $email = 'john.doe@example.com';
    public Network $network;

    public function __construct(string $name = 'John', string $email = null)
    {
        $this->name = $name;
        $this->email = $email;
    }
}
