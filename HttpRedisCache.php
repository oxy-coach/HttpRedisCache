<?php
/**
 * Created by PhpStorm.
 * User: miquel
 * Date: 5/03/14
 * Time: 15:46
 */

namespace Solilokiam\HttpRedisCache;

use Solilokiam\HttpRedisCache\Store\RedisHttpStore;
use Symfony\Bundle\FrameworkBundle\HttpCache\HttpCache;
use Symfony\Component\HttpKernel\HttpCache\StoreInterface;

class HttpRedisCache extends HttpCache
{
    public function createStore(): StoreInterface
    {
        return new RedisHttpStore(
            $this->getConnectionParams(),
            $this->getDigestKeyPrefix(),
            $this->getLockKey(),
            $this->getMetadataKeyPrefix()
        );
    }

    public function getConnectionParams(): array
    {
        return ['host' => 'localhost'];
    }

    public function getDigestKeyPrefix(): string
    {
        return 'hrd';
    }

    public function getLockKey(): string
    {
        return 'hrl';
    }

    public function getMetadataKeyPrefix(): string
    {
        return 'hrm';
    }
}
