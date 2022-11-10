<?php

namespace Crud\Mvc\online_store_factory\core\products;

use Crud\Mvc\online_store_factory\core\services\ServiceInterface;

interface ProductInterface
{
    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void;

    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param string $release
     * @return void
     */
    public function setReleaseDate(string $release): void;

    /**
     * @return string|null
     */
    public function getReleaseDate(): ?string;

    /**
     * @param string $manufactures
     * @return void
     */
    public function setManufactures(string $manufactures): void;

    /**
     * @return string|null
     */
    public function getManufactures(): ?string;

    /**
     * @param int $cost
     * @return void
     */
    public function setCost(int $cost): void;

    /**
     * @return int|null
     */
    public function getCost(): ?int;

    public function setService(ServiceInterface $service): void;
    public function getService(): array;
}
