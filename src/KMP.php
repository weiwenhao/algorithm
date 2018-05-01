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
     * 计算部分匹配表
     * @param $needle
     * @return array
     */
    private function getNext($needle): array
    {
        $next = [-1];
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