<?php
namespace Api\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    /**
     * Test get all posts
     */
    public function testGetPostsAction()
    {
        $client = static::createClient();

        $client->request('GET', '/posts?group=list');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertNotEmpty(json_decode($client->getResponse()->getContent(), true)[0]);
    }

    /**
     * Test get single post
     */
    public function testGetPostAction()
    {
        $client = static::createClient();

        $client->request('GET', '/posts/1?group=summary');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertNotEmpty(json_decode($client->getResponse()->getContent(), true));
    }
}
