<?php

namespace App\Services\Interfaces;

/**
 * Interface UserCatalogueServiceInterface
 * @package App\Services\Interfaces
 */
interface AttributeCatalogueServiceInterface
{
    public function paginate($request, $languageId);
}
