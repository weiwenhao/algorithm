<?php

namespace Algorithm;

class Dijkstra
{
    /**
     * 图(路径)数据, 为了方便这里采用`邻接矩阵`存储.
     * 邻接矩阵为图数据存储的一种方式
     * @var $graph
     */
	protected $graph;

    /**
     * @var array 已经找到了全局最短路径的节点. 既算法描述中的集合s
     */
	protected $found = [];

    /**
     * @var array 相对于S的最短路径集合 dist
     */
	protected $distance = [];

    /**
     * @var int
     */
    protected $vertexCount = 0;

    public function __construct(array $graph, array $vertex)
    {
        $this->vertexCount = count($graph);

        $this->graph = $graph;
    }

    /**
     * 查找给点起点到终点的最小权值
     * @param $begin
     * @param $end
     * @return mixed
     */
    public function findWeight($begin, $end)
    {
        $this->initFound($begin);
        $this->initDistance($begin);

        for ($i = 0; $i < $this->vertexCount; ++$i) {
            $minVertex = $this->findMinVertex();
            if ($minVertex === $end) {
                return $this->distance[$minVertex];
            }
            $this->found[] = $minVertex;
            $this->updateDistance($minVertex);
        }
    }

    private function initFound($begin)
    {
        $this->found[] = $begin;
    }

    private function initDistance($begin)
    {
        $this->distance = $this->graph[$begin];
    }

    private function findMinVertex()
    {
        $temp = array_diff_key($this->distance, array_flip($this->found));
        return array_keys($temp, min($temp))[0];
    }


    /**
     * 每一次找到一个全局最短路径顶点之后,我们都要根据此顶点进行中转来更新我们的相对最短顶点集合
     * @param $vertex 宝安中心/老街
     */
    private function updateDistance($vertex)
    {
        foreach ($this->graph[$vertex] as $key => $value) {
            $newValue = $this->distance[$vertex] + $value;

            if ($newValue < $this->distance[$key]) {
                $this->distance[$key] =$newValue;
            }
        }
    }

}