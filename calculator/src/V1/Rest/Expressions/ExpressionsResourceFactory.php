<?php
namespace calculator\V1\Rest\Expressions;

use Zend\Cache;

class ExpressionsResourceFactory
{
    public function __invoke($services)
    {
        return new ExpressionsResource(Cache\StorageFactory::adapterFactory('filesystem'));
    }
}
