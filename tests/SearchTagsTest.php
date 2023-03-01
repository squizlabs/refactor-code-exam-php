<?php

class SearchTagsTest extends \PHPUnit\Framework\TestCase
{
    public function testGetTags()
    {
        $searcher = new \Squiz\PhpCodeExam\Searcher();
        self::assertSame(
            ['mcbeth', 'shakespeare', 'scotland'],
            $searcher->execute('shakespeare', 'tags')['tags']
        );

        self::assertSame(
            ['mcbeth', 'shakespeare', 'scotland'],
            $searcher->execute('assassination', 'content')['tags']
        );

        self::assertFalse(
            $searcher->execute('Marlowe', 'tags')
        );
    }
}
