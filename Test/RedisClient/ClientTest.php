<?php
/**
 * Created by PhpStorm.
 * User: miquel
 * Date: 17/03/14
 * Time: 11:38
 */

namespace Solilokiam\HttpRedisCache\Test\RedisClient;


use PHPUnit\Framework\TestCase;
use Solilokiam\HttpRedisCache\RedisClient\Client;

class ClientTest extends TestCase
{
    protected $redisMock;

    protected function setUp(): void
    {
        $this->redisMock = $this->createMock(\Redis::class);
    }

    public function testSimpleConnect(): void
    {
        $client = new Client(['host' => 'localhost']);

        $return = $client->createConnection();

        $this->assertTrue($return);
    }

    public function testReadWriteKey(): void
    {
        $client = new Client(['host' => 'localhost']);

        $connection = $client->createConnection();

        $this->assertTrue($connection);

        $client->set('testkey', '1234');

        $result = $client->get('testkey');

        $this->assertEquals('1234', $result);

        $client->del('testkey');
    }

    public function testDelKey(): void
    {
        $client = new Client(['host' => 'localhost']);

        $connection = $client->createConnection();

        $this->assertTrue($connection);

        $client->set('testkey', '1234');
        $client->del('testkey');

        $result = $client->get('testkey');

        $this->assertEquals(false, $result);


    }

    public function testHashGet(): void
    {
        $client = new Client(['host' => 'localhost']);

        $connection = $client->createConnection();

        $this->assertTrue($connection);

        $client->hSetNx('testkey', 'testhash', 1);

        $result = $client->hGet('testkey', 'testhash');

        $this->assertEquals(1, $result);

        $client->del('testkey');
    }
}
