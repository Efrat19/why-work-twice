<?php

namespace App\Services;

/**
 * Interface ISmartSearch
 * @package App\Services
 */
interface ISmartSearch {

    /**
     * @param array $relatedModels
     * @return mixed
     */
    public function getFilters(array $relatedModels);

    /**
     * @param $resultModel
     * @param array $filters
     * @return mixed
     */
    public function getResults($resultModel, array $filters);
}
