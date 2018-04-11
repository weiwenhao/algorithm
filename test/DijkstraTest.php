<?php

namespace Algorithm\Test;

use Algorithm\Dijkstra;
use PHPUnit\Framework\TestCase;

class DijkstraTest extends TestCase
{
    const MAX = 65525;

    private function createGraph($arc, $vertex)
    {
        $graph = [];
        //init
        foreach($vertex as $row){
            foreach($vertex as $column){
                $graph[$row][$column] = $row == $column ? 0 : self::MAX;
            }
        }

        //create
        foreach ($arc as $value) {
            $graph[$value['begin']][$value['end']] = $value['weight'];

            // 无向图需要反向设置
            $graph[$value['end']][$value['begin']] = $value['weight'];
        }

        return $graph;
    }

    public function testFindWeight()
    {
        $vertex = ['宝安中心', '新安', '深圳北站', '福田', '购物公园', '世界之窗', '老街', '布吉'];
        $arc = [
            [
                'begin' => '宝安中心',
                'end' => '深圳北站',
                'weight' => 5,
            ],
            [
                'begin' => '宝安中心',
                'end' => '新安',
                'weight' => 8,
            ],
            [
                'begin' => '新安',
                'end' => '深圳北站',
                'weight' => 2,
            ],
            [
                'begin' => '新安',
                'end' => '世界之窗',
                'weight' => 9,
            ],
            [
                'begin' => '深圳北站',
                'end' => '福田',
                'weight' => 5,
            ],
            [
                'begin' => '深圳北站',
                'end' => '布吉',
                'weight' => 10,
            ],
            [
                'begin' => '福田',
                'end' => '世界之窗',
                'weight' => 6,
            ],
            [
                'begin' => '福田',
                'end' => '购物公园',
                'weight' => 2,
            ],
            [
                'begin' => '福田',
                'end' => '老街',
                'weight' => 5,
            ],
            [
                'begin' => '购物公园',
                'end' => '世界之窗',
                'weight' => 4,
            ],
            [
                'begin' => '购物公园',
                'end' => '老街',
                'weight' => 4,
            ],
            [
                'begin' => '老街',
                'end' => '布吉',
                'weight' => 6,
            ]
        ];

        $graph = $this->createGraph($arc, $vertex);
        $dijkstra = new Dijkstra($graph, $vertex);
        $weight = $dijkstra->findWeight('宝安中心', '老街');
        $this->assertEquals(15, $weight);
    }
}