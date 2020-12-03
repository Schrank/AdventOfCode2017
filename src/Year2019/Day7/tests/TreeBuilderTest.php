<?php
declare(strict_types=1);

namespace AdventOfCode\Day7;

use PHPUnit\Framework\TestCase;

class TreeBuilderTest extends TestCase
{
    public function testTreeBuilder()
    {
        $input   = [
            'pbga (66)',
            'xhth (57)',
            'ebii (61)',
            'havc (66)',
            'ktlj (57)',
            'fwft (72) -> ktlj, cntj, xhth',
            'qoyq (66)',
            'padx (45) -> pbga, havc, qoyq',
            'tknk (41) -> ugml, padx, fwft',
            'jptl (61)',
            'ugml (68) -> gyxo, ebii, jptl',
            'gyxo (61)',
            'cntj (57)',
        ];
        $builder = new TreeBuilder($input);
        $this->assertSame('tknk', $builder->getRoot());
    }

    public function testBuilderOnFixture()
    {
        $input   = array_map('trim', file(__DIR__ . '/tree.fixture'));
        $builder = new TreeBuilder($input);
        $this->assertSame('dgoocsw', $builder->getRoot());
        $builder->getUnbalanced();
    }
}
