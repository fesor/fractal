<?php

/*
 * This file is part of the League\Fractal package.
 *
 * (c) Phil Sturgeon <me@philsturgeon.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\Fractal;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\NullResource;
use League\Fractal\Resource\Primitive;
use League\Fractal\Resource\ResourceInterface;

/**
 * Transformer Abstract
 *
 * All Transformer classes should extend this to utilize the convenience methods
 * collection() and item(), and make the self::$availableIncludes property available.
 * Extend it and add a `transform()` method to transform any default or included data
 * into a basic array.
 */
abstract class TransformerAbstract
{
    /**
     * Resources that can be included if requested.
     *
     * @var array
     */
    protected $availableIncludes = [];

    /**
     * Include resources without needing it to be requested.
     *
     * @var array
     */
    protected $defaultIncludes = [];

    /**
     * The transformer should know about the current scope, so we can fetch relevant params.
     *
     * @var Scope
     */
    protected $currentScope;

    /**
     * Getter for availableIncludes.
     *
     * @return array
     */
    public function getAvailableIncludes()
    {
        return $this->availableIncludes;
    }

    /**
     * Getter for defaultIncludes.
     *
     * @return array
     */
    public function getDefaultIncludes()
    {
        return $this->defaultIncludes;
    }

    /**
     * Getter for currentScope.
     *
     * @return \League\Fractal\Scope
     */
    public function getCurrentScope()
    {
        return $this->currentScope;
    }

    /**
     * Setter for availableIncludes.
     *
     * @param array $availableIncludes
     *
     * @return $this
     */
    public function setAvailableIncludes($availableIncludes)
    {
        $this->availableIncludes = $availableIncludes;

        return $this;
    }

    /**
     * Setter for defaultIncludes.
     *
     * @param array $defaultIncludes
     *
     * @return $this
     */
    public function setDefaultIncludes($defaultIncludes)
    {
        $this->defaultIncludes = $defaultIncludes;

        return $this;
    }

    /**
     * Setter for currentScope.
     *
     * @param Scope $currentScope
     *
     * @return $this
     */
    public function setCurrentScope($currentScope)
    {
        $this->currentScope = $currentScope;

        return $this;
    }

    /**
     * Create a new primitive resource object.
     *
     * @param mixed                        $data
     * @param callable|null                $transformer
     * @param string                       $resourceKey
     *
     * @return Primitive
     */
    protected function primitive($data, $transformer = null, $resourceKey = null)
    {
        return new Primitive($data, $transformer, $resourceKey);
    }

    /**
     * Create a new item resource object.
     *
     * @param mixed                        $data
     * @param TransformerAbstract|callable $transformer
     * @param string                       $resourceKey
     *
     * @return Item
     */
    protected function item($data, $transformer, $resourceKey = null)
    {
        return new Item($data, $transformer, $resourceKey);
    }

    /**
     * Create a new collection resource object.
     *
     * @param mixed                        $data
     * @param TransformerAbstract|callable $transformer
     * @param string                       $resourceKey
     *
     * @return Collection
     */
    protected function collection($data, $transformer, $resourceKey = null)
    {
        return new Collection($data, $transformer, $resourceKey);
    }

    /**
     * Create a new null resource object.
     *
     * @return NullResource
     */
    protected function null()
    {
        return new NullResource();
    }
}
