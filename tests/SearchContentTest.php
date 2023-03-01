<?php

class SearchContentTest extends \PHPUnit\Framework\TestCase
{
    public function testGetContent()
    {
        $searcher = new \Squiz\PhpCodeExam\Searcher();
        self::assertSame(
            1,
            $searcher->execute('vitae', 'content')['id']
        );

        self::assertFalse(
            $searcher->execute('Vitae', 'content')
        );
    }
}
