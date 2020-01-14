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
     * decide node by Rendezvous hashing method
     * https://en.wikipedia.org/wiki/Rendezvous_hashing
     * @param $key
     * @return mixed node
     */
    public function decideNode($key)
    {
        $decideKey = null;
        $maxKey = null;
        foreach($this->nodes as $nodeKey => $node) {
            $rendezvousKey = $this->calcRendezvousKey($key, $node);
            if ($maxKey < $rendezvousKey) {
                $decideKey = $nodeKey;
                $maxKey = $rendezvousKey;
            }
        }

        return $this->nodes[$decideKey];
    }

    /**
     * @param $key
     * @param $node
     * @return string
     */
    private function calcRendezvousKey($key, $node)
    {
        return md5($key . $node);
    }
}
