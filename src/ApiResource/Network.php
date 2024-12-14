<?php

declare(strict_types=1);

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Serializer\Filter\GroupFilter;
use ApiPlatform\Serializer\Filter\PropertyFilter;
use App\State\NetworkProvider;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/{eid}',
//            normalizationContext: ['groups' => ['read']],
            output: Network::class,
            name: 'network_get',
            provider: NetworkProvider::class,
        ),
    ],
    routePrefix: '/networks',
)]
#[ApiFilter(GroupFilter::class, arguments: ['parameterName' => 'groups', 'overrideDefaultGroups' => true, 'whitelist' => ['profiles', 'read']])]
#[ApiFilter(PropertyFilter::class, arguments: ['parameterName' => 'properties', 'overrideDefaultProperties' => true, 'whitelist' => ['description', 'name', 'password']])]
final class Network
{
    #[ApiProperty(writable: false, identifier: true)]
    #[Groups('read')]
    public string $eid = '772a5a85432d2112';

    #[Groups('read')]
    public string $name = 'speakap';

    #[Groups('profiles')]
    public string $description = 'this network was created by Api Platform';

    /**
     * @var string Property viewable and writable only by users with ROLE_ADMIN
     */
    #[ApiProperty(security: "is_granted('IS_AUTHENTICATED_FULLY')", securityPostDenormalize: "is_granted('UPDATE', object)")]
    public string $password = '$ecr37Pa$$w0rd';

    /**
     * @var Profile[]
     */
    #[Groups('profiles')]
    public array $profiles = [];
}
