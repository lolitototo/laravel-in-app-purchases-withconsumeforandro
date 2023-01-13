<?php

declare(strict_types=1);

namespace Imdhemy\Purchases\Tests\Doubles;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use Imdhemy\AppStore\ClientFactory;
use Imdhemy\Purchases\Services\AppStoreTestNotificationServiceBuilder;
use JsonException;

class AppStoreTestNotificationServiceBuilderDouble extends AppStoreTestNotificationServiceBuilder
{
    public const PRODUCTION_TOKEN = 'production-token';
    public const SANDBOX_TOKEN = 'sandbox-token';

    /**
     * @return ClientInterface
     * @throws JsonException
     */
    protected function createClient(): ClientInterface
    {
        $token = $this->sandbox ? self::SANDBOX_TOKEN : self::PRODUCTION_TOKEN;

        $body = json_encode(['testNotificationToken' => $token], JSON_THROW_ON_ERROR);

        return ClientFactory::mock(new Response(200, [], $body));
    }
}
