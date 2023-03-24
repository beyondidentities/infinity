<?php
namespace App\Component\Session;

use SessionHandlerInterface;
use Symfony\Component\Cache\Adapter\AbstractAdapter as CacheAdapter;

class RedisSession implements SessionHandlerInterface
{
    protected CacheAdapter $cache;

    public function __construct(array $config)
    {
        $this->cache = $config['cache'];
    }

    public function open(string $path, string $name): bool
    {
        return true;
    }

    public function close(): bool
    {
        return true;
    }

    public function read(string $id): string|false
    {
        $value = $this->cache->getItem($id)->get();

        if ($value === null) {
            $value = '';
        }

        return $value;
    }

    public function write(string $id, string $data): bool
    {
        $this->cache->save($this->cache->getItem($id)->set($data));
        return true;
    }

    public function destroy(string $id): bool
    {
        $this->cache->deleteItem($id);
        return true;
    }

    public function gc(int $max_lifetime): int|false
    {
        return 0;
    }
}