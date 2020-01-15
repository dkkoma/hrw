<?php

namespace Hrw;

class Hrw
{
    private $nodes;

    public function __construct(array $nodes)
    {
        $this->nodes = $nodes;
    }

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
     * @param $node
     * @return string
     */
    private function calcRendezvousWeight($key, $seed)
    {
        return md5($key . $seed);
    }
}
