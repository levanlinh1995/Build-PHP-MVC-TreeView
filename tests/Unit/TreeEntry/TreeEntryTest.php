<?php

namespace Tests\Unit\TreeEntry;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class TreeEntryTest extends TestCase
{
    private $http;
    private $url = 'http://localhost:3000/';

    public function setUp(): void
    {
        $this->http = new Client(['base_uri' => $this->url]);
    }

    public function testGetAllTreeEntry()
    {
        $response = $this->http->get('/tree-entry');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $data = json_decode($response->getBody(), true);
    }

    public function testGetRootEntry()
    {
        $response = $this->http->get('/root-tree-entry');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
    }

    public function testGetChildrenById()
    {
        $id = 0;
        $response = $this->http->get('/tree-entry/children/' . $id );

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
    }

    public function tearDown(): void
    {
        $this->http = null;
    }
}
