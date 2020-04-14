<?php
namespace Meraki\Api\Tests;

use Meraki\Api\Authentication\CiscoMerakiAPIKeyAuthentication;
use Meraki\Api\Client;
use PHPUnit\Framework\TestCase;

class DashboardApiTestCase extends TestCase
{
    protected function getClient(): Client
    {
        $auth = new CiscoMerakiAPIKeyAuthentication($_SERVER['API_TOKEN']);
        
        return Client::create(null, $auth);
    }
}