<?php

declare(strict_types=1);

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\Network;
use App\ApiResource\Profile;

/**
 * @implements ProviderInterface<Network>
 */
final class NetworkProvider implements ProviderInterface
{
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): Network
    {
        $network = new Network();
        $network->eid = '6213f453acd32312';
        $network->name = 'Speakap';
        $network->description = 'Fetched from imaginary DB';

        if (in_array('profiles', $context['filters']['groups'] ?? [], true)) {
            $network->profiles = [
                new Profile('John Doe'),
                new Profile('Jane Doe'),
            ];
        }

        return $network;
    }
}
