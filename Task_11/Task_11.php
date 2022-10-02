<?php


class BfsMaze
{
    
    public $start;
    public $end;
    public $maze = [];
    public $all_path;
    public $queue = [];
    public $compared;

    public function __construct($maze, $start, $end)
    {
        $this->maze = $maze;
        $this->start = $start;
        $this->end = $end;
        $this->compared[] = $start;

        array_push($this->queue, ['parent' => [], 'coordinate' => $start]);
    }

   
    public function getLinks(array $node)
    {
        $link = [];
        if (empty($node)) {
            return $link;
        }

        $x = $node[0];
        $y = $node[1];
        if (isset($this->maze[$x - 1][$y]) && !$this->maze[$x - 1][$y] && !in_array([$x - 1, $y], $this->compared)) {
            $link[] = [$x - 1, $y];
        }

        if (isset($this->maze[$x + 1][$y]) && !$this->maze[$x + 1][$y] && !in_array([$x + 1, $y], $this->compared)) {
            $link[] = [$x + 1, $y];
        }

        if (isset($this->maze[$x][$y - 1]) && !$this->maze[$x][$y - 1] && !in_array([$x, $y - 1], $this->compared)) {
            $link[] = [$x, $y - 1];
        }

        if (isset($this->maze[$x][$y + 1]) && !$this->maze[$x][$y + 1] && !in_array([$x, $y + 1], $this->compared)) {
            $link[] = [$x, $y + 1];
        }

        return $link;
    }

    public function search()
    {
        while (!empty($this->queue)) {
            $node = array_shift($this->queue);

            if ($node['coordinate'] == $this->end) {
                $this->all_path[] = $node;

                return true;
            }

            $this->all_path[] = $node;

            $links = $this->getLinks($node['coordinate']);

            foreach ($links as $link) {
                array_push($this->queue, ['parent' => $node['coordinate'], 'coordinate' => $link]);

                $this->compared[] = $link;
            }
        }
    }

    
    public function getAnswer()
    {
        $stack = [];
        $answer = [];
        $path = array_reverse($this->all_path);
        foreach ($path as $p) {
            if (empty($answer)) {
                $answer[] = $p['coordinate'];
                array_push($stack, $p);
            } else {
                $tmp = array_pop($stack);
                if ($p['coordinate'] == $tmp['parent']) {
                    array_unshift($answer, $p['coordinate']);
                    array_push($stack, $p);
                } else {
                    array_push($stack, $tmp);
                    continue;
                }
            }
        }

        return $answer;
    }
}

$maze = [
    [0,1,0,1,1,0,1,1,1,0],
    [0,1,0,0,0,0,1,1,1,0],
    [0,1,1,0,1,0,1,1,1,0],
    [0,0,0,1,1,0,1,1,1,0],
    [0,1,0,0,0,0,1,1,1,0],
    [0,1,0,1,1,1,1,1,1,0],
    [0,1,0,0,1,0,1,1,1,0],
    [0,1,0,0,1,0,1,1,1,0],
    [0,1,0,0,1,0,1,1,1,0],
    [0,1,0,0,1,0,1,1,1,0],
    ];


$bfs = new BfsMaze($maze, [0, 0], [4, 4]);
//$bfs = new BfsMaze($maze, [4, 4], [4, 0]);
$bfs->search();
$answer = $bfs->getAnswer();
print_r($answer);