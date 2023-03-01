<?php

namespace Squiz\PhpCodeExam;

require_once __DIR__ . '/../mocks/TestData.php';

use Squiz\PhpCodeExam\Mocks\TestData;

class Searcher
{
    public array $allData = [];
    private array $searchResult;

    public function __construct()
    {
        /**
         * We just assume that we get all of this data from the DB
         * in a reasonably quick way
         */
        $this->allData = (new TestData())->getFromDbMock();
        $this->searchResult = [];
    }

    /**
     * @param $term
     * @param $type
     * @return array
     */
    public function execute($term, $type): array
    {
        foreach ($this->allData as $key => $value) {
            foreach ($value as $index => $reference) {
                if ($index === $type) {
                    if ($type === 'tags') {
                        if(in_array($term, $reference)) {
                            $this->searchResult[] = $this->allData[$key];
                        }
                    } else if (stripos($reference, $term) > 0) {
                        $this->searchResult[] = $this->allData[$key];
                    }
                }
            }
        }

        return $this->searchResult;
    }

    /**
     * @param $id
     * @return array|false|mixed
     */
    public function getPageById($id)
    {
        $pageIds = array_column($this->allData, 'id');
        if (in_array($id, $pageIds)) {
            return $this->allData[array_flip($pageIds)[$id]];
        }

        return false;
    }

    /**
     * @return array
     */
    public function getAllData(): array
    {
        return $this->allData;
    }

    /**
     * @param array|array[] $allData
     */
    public function setAllData(array $allData): void
    {
        $this->allData = $allData;
    }

    /**
     * @return array
     */
    public function getSearchResult(): array
    {
        return $this->searchResult;
    }

    /**
     * @param array $searchResult
     */
    public function setSearchResult(array $searchResult): void
    {
        $this->searchResult = $searchResult;
    }
}
