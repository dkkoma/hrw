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
     * @param $key
     * @return mixed node
     */
    public function pick($key)
    {
        return $this->select($key, $this->nodes);
    }

    private function select($key, $nodes)
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
     * @param $key
     * @param $seed
     * @return string
     */
    private function calcRendezvousWeight($key, $seed)
    {
        return md5($key . $seed);
    }
}
