<?php

use CrazyCodr\Iterators\CurrentNextIterator;

class CurrentNextIteratorTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @param $in
     * @param $out
     * @dataProvider providesTestIterator
     */
    public function testIterator($in, $out)
    {
        $iterator = new CurrentNextIterator($in);
        $result = [];
        foreach ($iterator as $keys => $values) {
            $result[] = [
                'keys'   => array_values($keys),
                'values' => array_values($values)
            ];
        }
        $this->assertSame($out, $result);
    }

    public function providesTestIterator()
    {
        return [

            'basic-test' => [
                'in'  => [1, 2, 3, 4, 5, 6, 7],
                'out' => [
                    [
                        'keys'   => [0, 1],
                        'values' => [1, 2]
                    ],
                    [
                        'keys'   => [1, 2],
                        'values' => [2, 3]
                    ],
                    [
                        'keys'   => [2, 3],
                        'values' => [3, 4]
                    ],
                    [
                        'keys'   => [3, 4],
                        'values' => [4, 5]
                    ],
                    [
                        'keys'   => [4, 5],
                        'values' => [5, 6]
                    ],
                    [
                        'keys'   => [5, 6],
                        'values' => [6, 7]
                    ],
                    [
                        'keys'   => [6, null],
                        'values' => [7, null]
                    ],
                ]
            ],
            'one-item'   => [
                'in'  => [1],
                'out' => [
                    [
                        'keys'   => [0, null],
                        'values' => [1, null]
                    ],
                ]
            ],
            'no-items'   => [
                'in'  => [],
                'out' => []
            ]

        ];
    }
}
