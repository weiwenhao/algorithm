<?php

namespace Algorithm\Test;

use Algorithm\BinarySearchTree;
use Algorithm\Structures\BiTNode;
use Algorithm\Structures\BiTree;
use PHPUnit\Framework\TestCase;

class BinarySearchTreeTest extends TestCase
{
    private $binarySearchTree;
    private $biTree;

    public function __construct(string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->binarySearchTree = new BinarySearchTree();
        $this->biTree = new BiTree();
    }

    public function testInsert()
    {
        $this->binarySearchTree->insert($this->biTree, 12);
        $this->binarySearchTree->insert($this->biTree, 8);
        $this->binarySearchTree->insert($this->biTree, 9);
        $this->binarySearchTree->insert($this->biTree, 24);
        $this->binarySearchTree->insert($this->biTree, 18);
        $this->binarySearchTree->insert($this->biTree, 3);
        $this->binarySearchTree->insert($this->biTree, 15);
        $this->binarySearchTree->insert($this->biTree, 30);
        $this->binarySearchTree->insert($this->biTree, 46);
        $this->binarySearchTree->insert($this->biTree, 22);
        $this->binarySearchTree->insert($this->biTree, 27); // 3 8 9 12 15 18 22 24 27 30 46

        //中序遍历
        $this->assertEquals([3, 8, 9, 12, 15, 18, 22, 24, 27, 30, 46], $this->biTree->inorder($this->biTree->getRoot()));

        return $this->biTree;
    }

    /**
     * @depends testInsert
     * @param BiTree $biTree
     */
    public function testSearch(BiTree $biTree)
    {

        $root = $this->binarySearchTree->search($biTree->getRoot(), 15);

        $this->assertEquals(15, $root->data);
    }

    /**
     * @depends testInsert
     * @param BiTree $biTree
     */
    public function testDelete(BiTree $biTree)
    {
        $biTree->setRoot($this->binarySearchTree->delete($biTree->getRoot(), 24));

        $this->assertEquals([3, 8, 9, 12, 15, 18, 22, 27, 30, 46], $biTree->inorder($biTree->getRoot()));
    }
}