<?php

namespace Sgdng\ApiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DependenciaControllerTest extends WebTestCase
{
    public function testCget()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/cget');
    }

}
