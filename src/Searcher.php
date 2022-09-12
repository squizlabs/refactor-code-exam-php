<?php

namespace Squiz\PhpCodeExam;

require_once __DIR__ . '/../mocks/TestData.php';

use Squiz\PhpCodeExam\Mocks\TestData;

class Searcher
{
    public $allData = [];

    public function __construct()
    {
        /**
         * We just assume that we get all of this data from the DB
         * in a reasonably quick way
         */
        $this->allData = (new TestData())->getFromDbMock();
    }

    public function execute($term, $type)
    {
        foreach ($this->allData as $key => $value) {
            foreach ($value as $index => $reference) {
                if ($index === $type) {
                    if ($reference === $term) {
                        return $this->allData[$key];
                    }

                    if (is_array($reference)) {
                        if (in_array($term, $reference)) {
                            if ($type === 'tags') {
                                return isset($this->allData[$key]) ? $this->allData[$key] : null;
                            }
                        }
                    }

                    if (strpos($reference, $term) > 0) {
                        return $this->allData[$key];
                    }
                }
            }
        }

        return false;
    }

    public function getPageById($id)
    {
        $pageIds = array_column($this->allData, 'id');
        if (in_array($id, $pageIds)) {
            return $this->allData[array_flip($pageIds)[$id]];
        }

        return $id;
    }
}
