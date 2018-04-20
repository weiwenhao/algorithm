<?php

namespace Algorithm;

use Algorithm\Structures\BiTree;

class BinarySearchTree
{
    /**
     * @param $root
     * @param $data
     * @return bool
     */
    public function search($root, $data)
    {
        if (is_null($root)) {
            return false;
        }

        while (true) {
            if ($root->data === $data) {
                return $root;
            }

            if ($data > $root->data) {
                if (is_null($root->right)) {
                    return false;
                }
                $root = $root->right;
            } else {
                if (is_null($root->left)) {
                    return false;
                }
                $root = $root->left;
            }
        }
    }

    /**
     * @param BiTree $biTree
     * @param $data
     * @return bool
     */
    public function insert(BiTree $biTree, $data)
    {
        $node = $biTree->createNode($data);

        if (!$root = $biTree->getRoot()) {
            $biTree->setRoot($node);
            return true;
        }

        while (true) {
            if ($root === $node) {
                return true;
            }

            if ($node > $root) {
                if (is_null($root->right)) {
                    $root->right = $node;
                    return true;
                }
                $root = $root->right;
            } else {
                if (is_null($root->left)) {
                    $root->left = $node;
                    return true;
                }
                $root = $root->left;
            }
        }
    }


    /**
     * @param $root
     * @param $data
     * @return null
     */
    public function delete($root, $data)
    {
        if (!$root) {
            return null;
        }

        if ($root->data === $data) {
            if ($root->left) {
                // 左转
                $node = $root->left;

                $parent = $root;
                $toward = 'left';

                while ($node->right) {

                    $parent = $node;
                    $toward = 'right';

                    $node = $node->right;
                }

                $root->data = $node->data;

                $parent->{$toward} = $this->delete($node, $node->data);
        

            } else {
                return $root->right;
            }
        } elseif ($root->data > $data) {
            // 如果root的左孩子没有被删除,那就原样返回回来, 如果被删除了,那就找个孩子代替
            $root->left = $this->delete($root->left, $data);
        } else {
            $root->right = $this->delete($root->right, $data);
        }

        return $root;
    }
}