<?php

namespace Algorithm\Structures;

class BiTree
{
    /**
     * @var null 根节点
     */
    private $root = null;

    /**
     * @return null
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * @param null $root
     */
    public function setRoot($root)
    {
        $this->root = $root;
    }

    public function createNode($data)
    {
        return new BiTNode($data);
    }

    /**
     * [copy description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function replace($oldNode, $newNode)
    {
        $old->left = $new->left;
        $old->rigth = $new->rigth;
        $old->data = $new->data;
    }

    /**
     * 中序遍历
     * @param $root
     * @return array
     */
    public function inorder($root)
    {
        $data = [];

        if ($root->left) {
            $data = array_merge($data, $this->inorder($root->left));
        }

        $data[] = $root->data;

        if ($root->right) {
            $data = array_merge($data, $this->inorder($root->right));
        }

        return $data;
    }
}