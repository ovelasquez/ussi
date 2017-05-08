<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EstadisticaControllerTest extends WebTestCase
{
    public function testPacientes()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/pacientes');
    }

}
