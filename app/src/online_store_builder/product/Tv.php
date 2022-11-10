<?php

namespace Crud\Mvc\online_store_builder\product;

use Crud\Mvc\online_store_builder\core\product\AbstractProduct;
use Crud\Mvc\online_store_builder\core\product\ProductInterface;
use Crud\Mvc\online_store_builder\core\service\ServiceInterface;

class Tv extends AbstractProduct implements ProductInterface
{
    protected string $name;
    protected string $manufactures;
    protected string $release;
    protected int $cost;
    protected array $services;

    /**
     * @param ServiceInterface $service
     * @return void
     */
    public function setService(ServiceInterface $service): void
    {
        $this->services[] = $service;
    }

    /**
     * @return array
     */
    public function getService(): array
    {
        return $this->services;
    }

    /**
     * @return int
     */
    public function getServicesCost(): int
    {
        $servicesCost = 0;
        if(!empty($this->services)){
            foreach ($this->services as $service){
                $servicesCost += $service->getCost();
            }
        }
        return $servicesCost;
    }


    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $release
     * @return void
     */
    public function setReleaseDate(string $release): void
    {
        $this->release = $release;
    }

    /**
     * @return string|null
     */
    public function getReleaseDate(): ?string
    {
        return $this->release;
    }

    /**
     * @param string $manufactures
     * @return void
     */
    public function setManufactures(string $manufactures): void
    {
        $this->manufactures = $manufactures;
    }

    /**
     * @return string|null
     */
    public function getManufactures(): ?string
    {
        return $this->manufactures;
    }

    /**
     * @param int $cost
     * @return void
     */
    public function setCost(int $cost): void
    {
        $this->cost = $cost;
    }

    /**
     * @return int|null
     */
    public function getCost(): ?int
    {
        return $this->cost;
    }
}