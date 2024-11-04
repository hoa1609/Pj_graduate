<?php

namespace App\Services\Interfaces;

/**
 * Interface UserCatalogueServiceInterface
 * @package App\Services\Interfaces
 */
interface ProductCatalogueServiceInterface
{
    public function paginate($request, $languageId);
}
