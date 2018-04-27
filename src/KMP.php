<?php

namespace Algorithm;

class KMP
{
    public function find(string $haystack, string $needle): bool
    {
        $next = $this->getNext($needle);

        $i = 0; // 主串
        $j = 0; // 子串
        while ($i < strlen($haystack) && $j < strlen($needle)) {
            if ($j == -1 || $haystack[$i] == $needle[$j]) {
                $i++;
                $j++;
            } else {
                $j = $next[$j];
            }
        }

        if ($j == strlen($needle)) {
            return true;
        }

        return false;
    }

    /**
     * 推导
     * 已知 next[j] = k
     *
     * 假设字符串p如下
     * a b K o p m a b j j+1
     * 由next[j] == k得  p[0 ~ k-1] = p[j-k ~ j-1] 
     *
     * 则当 p[j] == p[k]时
     * 可以得到 next[j+1] == next[j] + 1
     *
     * 当p[j] != p[k]
     * 则进入了熟悉的字符串失配模式,明确一下情况,此时的失配是谁与谁进行比较时的失配?
     * 可以理解为前缀与后缀的比较中产生了失配.
     * 此时我们应该怎么做? 当然是继续寻找前缀来和后缀匹配
     * 应该拿p[j] 和 p[k-1]来进行比较吗? 不应该.前缀在此时其实已经充当了搜索词的意思.由于在前后缀的比较过程中我们已经知道了
     * p[0 ~ k-1] = p[j-k ~ j-1] 且在p[j] 和 p[k]的比较时适配
     *
     * 根据kmp算法的定义, 当搜索词在p[k]时适配时我们应该做什么?
     * 另 k = next[k] 然后继续与字符串进行匹配
     * 此时我们比较 p[j] 与 p[next[k]]
     * 
     * 我们又回到了上一步,根据匹配的结果做判断.
     *
     * 但k = next[k] 并不能无限进行下去, 当k = -1时  (next[0] = -1) 表示p[0]与p[j]也不配置,
     * 则后缀找不到匹配的前缀. 此时的next[j + 1]  == 0;
     * 代码中的体现为 $k == -1时  $next[++$j] == ++ $k
     * 
     * 计算部分匹配表
     * @param $needle
     * @return array
     */
    private function getNext($needle): array
    {
        $next = [-1]; //  next[0] = -1，告诉 KMP 主算法已经不能再移动 j 指针了 // 当 j = 1 的时候，显然 j 只能移动到 0，所以 next[1] = 0.
        $len = strlen($needle);
        $k = -1;
        $j = 0;

        while ($j < $len - 1) {
            if ($k == -1 || $needle[$j] == $needle[$k]) {
                $next[++$j] = ++$k;
            } else {
                $k = $next[$k];
            }
        }

        return $next;
    }
}