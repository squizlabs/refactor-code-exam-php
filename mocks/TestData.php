<?php

namespace Squiz\PhpCodeExam\Mocks;

/**
 * This is a mock class for getting an example set of data for the exam
 *
 * This class can be ignored for refactoring or considering for changes.
 */
class TestData
{
    /**
     * Mock getting a full set of data from a database which may be a JOIN on
     * one or more tables. We assume that something like ROW or SELECT array()
     * was used to parse the `tags` column as a PHP array.
     *
     * @return array[]
     */
    public function getFromDbMock(): array
    {
        return [
            [
                'id' => 1,
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a metus ac metus luctus luctus vitae iaculis enim. Curabitur sed volutpat ligula. Sed interdum a massa non facilisis. Curabitur bibendum risus eget arcu tincidunt lacinia. Sed mattis tortor vitae tincidunt bibendum. Etiam mollis rutrum laoreet. Mauris venenatis, elit vitae aliquet viverra, magna massa vehicula urna, eu vulputate odio turpis non sapien. Fusce non sollicitudin lorem, quis lobortis ligula. Ut ut rutrum nulla. Pellentesque nec ultricies nulla. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'tags' => ['latin', 'lorem ipsum', 'copy']
            ],
            [
                'id' => 2,
                'content' => 'The Secret of Monkey Island is a 1990 point-and-click graphic adventure game developed and published by Lucasfilm Games. It takes place in a fictional version of the Caribbean during the age of piracy. The player assumes the role of Guybrush Threepwood, a young man who dreams of becoming a pirate, and explores fictional islands while solving puzzles.',
                'tags' => ['monkey', 'secret', 'lucasarts', 'point and click']
            ],
            [
                'id' => 3,
                'content' => 'The greatest glory in living lies not in never falling, but in rising every time we fall.',
                'tags' => ['Nelson', 'Mandela', 'South Africa']
            ],
            [
                'id' => 4,
                'content' => 'The way to get started is to quit talking and begin doing.',
                'tags' => ['Disney', 'Walt', 'Cartoon']
            ],
            [
                'id' => 5,
                'content' => 'Your time is limited, so don\'t waste it living someone else\'s life. Don\'t be trapped by dogma – which is living with the results of other people\'s thinking.',
                'tags' => ['Apple', 'Steve', 'Jobs']
            ],
            [
                'id' => 6,
                'content' => 'Life is what happens when you\'re busy making other plans.',
                'tags' => ['John', 'Lennon', 'Beatles']
            ],
            [
                'id' => 7,
                'content' => 'If it were done when \'tis done, then \'twere well It were done quickly: if the assassination Could trammel up the consequence, and catch With his surcease success; that but this blow Might be the be-all and the end-all here, But here, upon this bank and shoal of time, We\'ld jump the life to come. But in these cases We still have judgment here; that we but teach Bloody instructions, which, being taught, return To plague the inventor: this even-handed justice Commends the ingredients of our poison\'d chalice To our own lips. He\'s here in double trust;',
                'tags' => ['mcbeth', 'shakespeare', 'scotland']
            ],
            [
                'id' => 42,
                'content' => 'Far out in the uncharted backwaters of the unfashionable end of the western spiral arm of the Galaxy lies a small unregarded yellow sun.',
                'tags' => ['hitchhiker', 'guide', 'galaxy', 'book', 'douglas', 'adams']
            ],

            // assume that this data set is many times larger
        ];
    }
}
