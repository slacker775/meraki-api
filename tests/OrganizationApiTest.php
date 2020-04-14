<?php
namespace Meraki\Api\Tests;

use Meraki\Api\Model\Organization;

class OrganizationApiTest extends DashboardApiTestCase
{

    public function testListOrgSuccess()
    {
        $client = $this->getClient();

        $response = $client->getOrganizations();

        self::assertNotEmpty($response);
        self::assertInstanceOf(Organization::class, $response[0]);
    }
}