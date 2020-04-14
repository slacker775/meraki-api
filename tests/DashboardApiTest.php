<?php
namespace Meraki\Api\Tests;

use PHPUnit\Framework\TestCase;
use Meraki\Api\Client;
use Meraki\Api\Authentication\CiscoMerakiAPIKeyAuthentication;
use Meraki\Api\Model\Organization;
use Meraki\Api\Model\Network;
use Meraki\Api\Model\SmUser;
use Meraki\Api\Model\SmProfile;
use Meraki\Api\Model\SmDevice;
use Meraki\Api\Model\SmConnectivity;
use Meraki\Api\Model\SmSecurityCenter;
use Meraki\Api\Model\NetworksNetworkIdSmDevicesGetResponse200;
use Meraki\Api\Model\NetworksNetworkIdSmProfilesGetResponse200;
use Meraki\Api\Model\SmDeviceCert;
use Meraki\Api\Model\SmDeviceSoftwares;

class DashboardApiTest extends TestCase
{
    private function getClient(): Client
    {
        $auth = new CiscoMerakiAPIKeyAuthentication($_SERVER['API_TOKEN']);
        
        return Client::create(null, $auth);
    }
    
    public function testListOrgSuccess()
    {
        $client = $this->getClient();
        
        $response = $client->getOrganizations();
        
        self::assertNotEmpty($response);
        self::assertInstanceOf(Organization::class, $response[0]);
    }
    
    public function testListNetworkSuccess()
    {
        $client = $this->getClient();
        
        $response = $client->getOrganizationNetworks($_SERVER['ORG_ID']);
        
        self::assertNotEmpty($response);
        self::assertInstanceOf(Network::class, $response[0]);
    }
    
    public function testListSmUserSuccess()
    {
        $client = $this->getClient();
        
        $response = $client->getNetworkSmUsers($_SERVER['NETWORK_ID']);
        
        self::assertNotEmpty($response);
        self::assertInstanceOf(SmUser::class, $response[0]);
    }
    
    public function testListSmProfileSuccess()
    {
        $client = $this->getClient();
        
        $response = $client->getNetworkSmProfiles($_SERVER['NETWORK_ID']);
        
        self::assertInstanceOf(NetworksNetworkIdSmProfilesGetResponse200::class, $response);
        self::assertNotEmpty($response->getProfiles());
    }
    
    public function testListSmDeviceSuccess()
    {
        $client = $this->getClient();
        
        $response = $client->getNetworkSmDevices($_SERVER['NETWORK_ID']);
        
        self::assertInstanceOf(NetworksNetworkIdSmDevicesGetResponse200::class, $response);
        self::assertNotEmpty($response->getDevices());
    }
    
    public function testListSmDeviceConnectivitySuccess()
    {
        $client = $this->getClient();
        
        $response = $client->getNetworkSmConnectivity($_SERVER['NETWORK_ID'], $_SERVER['SM_DEVICE_ID']);
        
        self::assertNotEmpty($response);
        self::assertInstanceOf(SmConnectivity::class, $response[0]);
    }
    
    public function testListSmDeviceSecuritySuccess()
    {
        $client = $this->getClient();
        
        $response = $client->getNetworkSmSecurityCenters($_SERVER['NETWORK_ID'], $_SERVER['SM_DEVICE_ID']);
        
        self::assertNotNull($response);
        self::assertInstanceOf(SmSecurityCenter::class, $response[0]);
    }
    
    public function testListSmDeviceCertsSuccess()
    {
        $client = $this->getClient();
        
        $response = $client->getNetworkSmCerts($_SERVER['NETWORK_ID'], $_SERVER['SM_DEVICE_ID']);
        
        self::assertNotNull($response);
        self::assertInstanceOf(SmDeviceCert::class, $response[0]);
    }
    
    public function testListSmDeviceSoftwaresSuccess()
    {
        $client = $this->getClient();
        
        $response = $client->getNetworkSmSoftwares($_SERVER['NETWORK_ID'], $_SERVER['SM_DEVICE_ID']);
        
        self::assertNotNull($response);
        self::assertInstanceOf(SmDeviceSoftwares::class, $response[0]);
    }
}