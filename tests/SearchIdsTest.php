<?php

class SearchIdsTest extends \PHPUnit\Framework\TestCase
{
    public function testGetPagesFromIds()
    {
        $searcher = new \Squiz\PhpCodeExam\Searcher();
        self::assertSame(
            [
                'id' => 42,
                'content' => 'Far out in the uncharted backwaters of the unfashionable end of the western spiral arm of the Galaxy lies a small unregarded yellow sun.',
                'tags' => ['hitchhiker', 'guide', 'galaxy', 'book', 'douglas', 'adams']
            ],
            $searcher->getPageById(42)
        );

        self::assertSame(
            false,
            $searcher->getPageById('foo')
        );


        self::assertSame(
            [
                'id' => 42,
                'content' => 'Far out in the uncharted backwaters of the unfashionable end of the western spiral arm of the Galaxy lies a small unregarded yellow sun.',
                'tags' => ['hitchhiker', 'guide', 'galaxy', 'book', 'douglas', 'adams']
            ],
            $searcher->execute('2', 'id')
        );
    }
}
