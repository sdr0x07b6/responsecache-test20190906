<?php

namespace Tests\Feature;

use Tests\TestCase;
use Config;
use Illuminate\Support\Facades\Cache;
use Spatie\ResponseCache\Facades\ResponseCache;


class ExampleTest extends TestCase
{
    /**
     * @test
     */
    public function clearByTag()
    {
        $header = Config::get('responsecache.cache_time_header_name');

        // Ignore the CACHE_DRIVER setting in phpunit.xml and use Redis
        Config::set('cache.default', 'redis');


        // Clear all cache as initialization
        ResponseCache::clear();

        // Create a cache for "users" and "products"
        $this->get('/users');
        $this->get('/products');

        // Delete the "users" cache by tag
        // ResponseCache::clear(['users']); // Fail
        Cache::tags('users')->flush(); // Pass

        // Response is only cached for "products"
        $res = $this->get('/users')->assertHeaderMissing($header);
        $this->get('/products')->assertHeader($header);
    }
}
