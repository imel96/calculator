<?php

namespace calculator\V1\Rest\Expressions;

use Zend\Cache\Storage;
use Zend\Json;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class ExpressionsResource extends AbstractResourceListener
{
    protected $storage;

    public function __construct(Storage\StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * Create a resource
     *
     * @param mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        $id = hash("sha256", $data->expression);
        $this->storage->setItem($id, $data->expression);
        var_dump(preg_split("/[-+\/*]/", $this->storage->getItem($id)));
        var_dump(preg_split("/\d+/", $this->storage->getItem($id)));

        echo Json\Json::encode("Location: $id");
        print_r(get_class_methods($this));
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        $this->storage->removeItem($id);
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        $keys = [];

        foreach ($this->storage as $key) {
            $keys[] = $key;
        }
        $this->storage->removeItems($keys);
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
	return new ExpressionsEntity($this->storage->getItem($id));
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array            $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        $keys = [];

        foreach ($this->storage as $key) {
            $keys[] = $key;
        }
        return new ExpressionsCollections($this->storage->getItems($keys));
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Patch (partial in-place update) a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patchList($data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for collections');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}
