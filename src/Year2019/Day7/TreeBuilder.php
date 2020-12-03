<?php
declare(strict_types=1);

namespace AdventOfCode\Day7;

interface INode
{
    public function addChild(INode $child): void;

    public function getWeight(): int;

    public function isBalanced(): bool;

    /**
     * @return Node[]
     */
    public function getChildren(): array;
}

class TreeBuilder
{
    /**
     * @var mixed[]
     */
    private $nodeInfos;
    /**
     * @var INode[]
     */
    private $nodes;
    /**
     * @var RootNode
     */
    private $root;

    public function __construct($input)
    {
        foreach ($input as $line) {
            if (!preg_match('#([a-z]*) \(([0-9]*)\)( -> ([ a-z,])*)?#', $line, $matches)) {
                throw new \RuntimeException('Something is wrong.');
            }
            if (count($matches) === 5) {
                list(, $nodeName, $weight, $children) = $matches;
                $children = array_map('trim', explode(',', substr($children, 4)));
            } elseif (count($matches) === 3) {
                $children = [];
                list(, $nodeName, $weight) = $matches;
            } else {
                throw new \RuntimeException('Something is wrong');
            }
            $nodes[$nodeName] = [
                'children' => $children,
                'parent'   => null,
                'weight'   => (int)$weight,
            ];
        }

        foreach ($nodes as $parentName => $node) {
            foreach ($node['children'] as $child) {
                $nodes[$child]['parent'] = $parentName;
            }
        }
        $this->nodeInfos = $nodes;
        $this->buildTree();
    }

    private function buildTree()
    {
        $infos = $this->nodeInfos;
        while ($infos !== []) {
            foreach ($infos as $nodeName => $n) {
                $parent = $n['parent'];
                if ($parent !== null && !isset($this->nodes[$parent])) {
                    continue;
                }
                if ($parent === null) {
                    $node       = new RootNode();
                    $this->root = $node;
                } else {
                    $node = new Node($this->nodes[$parent], $n['weight'], $nodeName);
                }
                $this->nodes[$nodeName] = $node;
                unset($infos[$nodeName]);
            }
        }
    }

    public function getUnbalanced()
    {
        foreach ($this->nodes as $n) {
            if (!$n->isBalanced()) {
                echo $n->getName() . ' ' . $n->getWeight() . "\n";
                foreach ($n->getChildren() as $c) {
                    echo $c->getName() . ': ' . $c->getWeight() . " \n";
                }
                echo "\n\n";
            }
        }
        echo "\n\n";
        echo $this->nodes['marnqj']->getNodeWeight();
    }

    public function getRoot()
    {
        foreach ($this->nodeInfos as $name => $n) {
            if ($n['parent'] === null) {
                return $name;
            }
        }
    }
}

class Node implements INode
{
    /**
     * @var INode
     */
    private $parent;
    /**
     * @var int
     */
    private $weight;
    /**
     * @var INode[]
     */
    private $children = [];
    private $name;

    public function __construct(INode $parent, int $weight, $name)
    {
        $this->parent = $parent;
        $this->weight = $weight;
        $parent->addChild($this);
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getParent(): INode
    {
        return $this->parent;
    }

    public function addChild(INode $child): void
    {
        $this->children[] = $child;
    }

    public function getNodeWeight()
    {
        return $this->weight;
    }

    public function getWeight(): int
    {
        $weight = 0;
        foreach ($this->children as $c) {
            $weight += $c->getWeight();
        }
        return $this->weight + $weight;
    }

    public function isBalanced(): bool
    {
        $balanced = true;
        $weight   = null;
        foreach ($this->children as $child) {
            if ($weight === null) {
                $weight = $child->getWeight();
            }
            $balanced = $balanced && ($weight === $child->getWeight());
        }
        return $balanced;
    }

    public function getChildren(): array
    {
        return $this->children;
    }
}

class RootNode implements INode
{
    /**
     * @var INode[]
     */
    private $children;

    public function addChild(INode $child): void
    {
        $this->children[] = $child;
    }

    public function getWeight(): int
    {
        return 0;
    }

    public function isBalanced(): bool
    {
        $balanced = true;
        $weight   = null;
        foreach ($this->children as $child) {
            if ($weight === null) {
                $weight = $child->getWeight();
            }
            $balanced = $balanced && ($weight === $child->getWeight());
        }
        return $balanced;
    }

    public function getChildren(): array
    {
        return $this->children;
    }

    public function getName(): string
    {
        return 'root';
    }
}

