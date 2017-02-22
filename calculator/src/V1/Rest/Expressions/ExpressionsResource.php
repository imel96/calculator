<?php

namespace calculator\V1\Rest\Expressions;

use Zend\Cache\Storage;
use Zend\Http\Response;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class ExpressionsResource extends AbstractResourceListener
{
    protected $storage;
    protected $response;

    public function __construct(Storage\StorageInterface $storage, Response $response)
    {
        $this->storage = $storage;
        $this->response = $response;
    }

    /**
     * Create a resource
     *
     * @param  mixed            $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        $id = hash("sha1", $data->expression);
        $tokens = explode(",", $data->expression);
        $result = Evaluator::evaluateBinary($tokens[1], $tokens[0], $tokens[2]);
        $this->storage->setItem($id, serialize(['expression' => $data->expression, 'result' => $result]));

        $this->response->getHeaders()
            ->addHeaderLine("Location: " . $this->getEvent()->getRequest()->getUriString() . "/$id");

        return $this->response->setStatusCode(Response::STATUS_CODE_201);
    }

    /**
     * Delete a resource
     *
     * @param  mixed            $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        $this->storage->removeItem($id);

        return $this->response->setStatusCode(Response::STATUS_CODE_204);
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed            $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        $keys = [];

        foreach ($this->storage as $key) {
            $keys[] = $key;
        }
        $this->storage->removeItems($keys);
        return $this->response->setStatusCode(Response::STATUS_CODE_204);

    }

    /**
     * Fetch a resource
     *
     * @param  mixed            $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        $item = unserialize($this->storage->getItem($id));
        $item['expression'] = str_replace(",", "", $item['expression']);

        return ['id' => $id] + $item;
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
        $items = [];

        foreach ($this->storage as $key) {
            $keys[] = $key;
        }
        if (empty($keys)) {
            return $keys;
        }
        foreach ($this->storage->getItems($keys) as $key => $item) {
            $item = unserialize($item);
            $item['expression'] = str_replace(",", "", $item['expression']);
            $items[] = ['id' => $key] + $item;
        }

        return $items;
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed            $id
     * @param  mixed            $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Patch (partial in-place update) a collection or members of a collection
     *
     * @param  mixed            $data
     * @return ApiProblem|mixed
     */
    public function patchList($data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for collections');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed            $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed            $id
     * @param  mixed            $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}
