<?php

namespace Crud\Mvc\online_store_factory\core\products;

use Crud\Mvc\online_store_factory\core\services\ServiceInterface;

/**
 *
 */
abstract class AbstractProduct implements ProductInterface
{
    protected string $name;
    protected string $manufactures;
    protected string $release;
    protected int $cost;
    protected array $services;

    /**
     * @param $values
     */
    public function __construct($values)
    {
        list($name, $manufactures, $release, $cost) = $values;
        $this->name = $name;
        $this->manufactures = $manufactures;
        $this->release = $release;
        $this->cost = $cost;
        $this->services = [];
    }

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
        foreach ($this->services as $service){
            $servicesCost += $service->getCost();
        }
        return $servicesCost;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $className = explode("\\",get_class($this));
        $className = end($className);
        if ($this->services){
            $services = implode(', ', $this->services);
        }else{
            $services = "Not defined";
        }
        return "Product type: $className<br>
                Product name: $this->name<br>
                Manufactured: $this->manufactures<br>
                Release: $this->release<br>
                Cost: $this->cost$<br>
                Services: $services<br>";
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
