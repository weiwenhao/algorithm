<?php

namespace Algorithm\Test;

use Algorithm\BinarySearchTree;
use Algorithm\KMP;
use Algorithm\Structures\BiTNode;
use Algorithm\Structures\BiTree;
use PHPUnit\Framework\TestCase;

class KMPTest extends TestCase
{
    public function testFind()
    {
        $haystack = 'BBCABCDABABCDABCDABDE';
        $needle = 'ABCDABD';

        $kmp = new KMP();
        $res = $kmp->find($haystack, $needle);

        $this->assertTrue($res);

        $needle = 'ABCDABE';
        $res = $kmp->find($haystack, $needle);

        $this->assertFalse($res);
    }
}