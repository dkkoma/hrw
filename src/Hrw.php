<?php

namespace Hrw;

class Hrw
{
    private $nodes;

    public function __construct(array $nodes)
    {
        $this->nodes = $nodes;
    }

    /**
     * pick a node by Rendezvous hashing method
     * @param string $key
     * @return mixed node
     */
    public function pick(string $key)
    {
        return $this->select($key, $this->nodes);
    }

    /**
     * @param string $key
     * @param array $nodes
     * @return mixed
     */
    private function select(string $key, array $nodes)
    {
        $winner = null;
        $maxWeight = null;
        foreach($nodes as $nodeKey => $node) {
            $seed = is_array($node) ? $nodeKey : $node;
            $weight = $this->calcRendezvousWeight($key, $seed);
            if ($maxWeight < $weight) {
                $winner = $node;
                $maxWeight = $weight;
            }
        }
        return is_array($winner) ? $this->select($key, $winner) : $winner;
    }

    /**
     * @param string $key
     * @param $seed
     * @return string
     */
    private function calcRendezvousWeight(string $key, $seed) : string
    {
        return md5($key . $seed);
    }
}
