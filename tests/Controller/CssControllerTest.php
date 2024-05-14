<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\Tests\Controller;

use Neusta\Pimcore\TestingFramework\Database\ResetDatabase;
use Pimcore\Test\WebTestCase;
use Spatie\Snapshots\MatchesSnapshots;

class CssControllerTest extends WebTestCase
{
    use MatchesSnapshots;
    use ResetDatabase;

    /**
     * @test
     */
    public function it_returns_css(): void
    {
        $client = self::createClient();

        $client->request('GET', '/neusta/backend-branding/css');

        self::assertResponseIsSuccessful();
        self::assertResponseHeaderSame('Content-Type', 'text/css; charset=UTF-8');
        $this->assertMatchesTextSnapshot($client->getResponse()->getContent());
    }
}
