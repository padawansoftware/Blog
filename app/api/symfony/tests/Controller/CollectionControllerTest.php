<?php
namespace Api\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CollectionControllerTest extends WebTestCase
{
    /**
     * Test get all collections
     */
    public function testGetCollectionsAction()
    {
        $client = static::createClient();

        $client->request('GET', '/collections?group=list');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertNotEmpty(json_decode($client->getResponse()->getContent(), true)[0]);
    }

    /**
     * Test get single collection
     */
    public function testGetCollectionAction()
    {
        $client = static::createClient();

        $client->request('GET', '/collections/1?group=list');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertNotEmpty(json_decode($client->getResponse()->getContent(), true));
    }
}
