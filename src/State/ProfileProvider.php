<?php

declare(strict_types=1);

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\Network;
use App\ApiResource\Profile;

/**
 * @implements ProviderInterface<Profile>
 */
final class ProfileProvider implements ProviderInterface
{
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): Profile
    {
        $profile = new Profile('Tito Costa', 'tito@example.org');

        $network = new Network();
        $network->eid = '6213f453acd32312';
        $network->name = 'Speakap';
        $network->description = 'Fetched from imaginary DB';

        $profile->network = $network;

        return $profile;
    }
}
