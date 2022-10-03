<?php


class Pathfinder
{
    private $storage = "data.json";
    
    public $start;
    public $end;
    public $all_path;
    public $maze = [];
    public $queue = [];
    public $compared;
    public $result;


    public function __construct($maze, $start, $end)
    {
        $this->maze = $maze;
        $this->start = $start;
        $this->end = $end;
        $this->compared[] = $start;

        array_push($this->queue, ['parent' => [], 'coordinate' => $start]);

        if ($this->validateUserPoints($start) && $this->validateUserPoints($end)) 
        {
            $this->breadth_first_search();
            $this->getShortestPath();
        }
        else 
        {
            $this->result = 'Incorrect data entry';
            $this->storeData();
        }
    }

    

    ///////////////// Algorithm block ///////////////////////////
    public function get_next_nodes(array $node)
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


    public function breadth_first_search()
    {
        while (!empty($this->queue)) {
            $node = array_shift($this->queue);

            if ($node['coordinate'] == $this->end) {
                $this->all_path[] = $node;
                return true;
            }

            $this->all_path[] = $node;

            $links = $this->get_next_nodes($node['coordinate']);

            foreach ($links as $link) {
                array_push($this->queue, ['parent' => $node['coordinate'], 'coordinate' => $link]);

                $this->compared[] = $link;
            }
        }
    }

    
    public function getShortestPath()
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
        $this->result = $answer;
        $this->storeData();
    }


    ////////////////// Support block ////////////////////////////
    public function __toString()    
    {
        $result = $this->result;
        $start = json_encode($this->start);
        $end = json_encode($this->end);
        if (is_array($result)) {
            return "The shortest path from point $start to point $end is:"."<br>".json_encode($result);
        }
        else
        {
            return $result;
        }
    }


    public function validateUserPoints($point)
    {
        $grid = $this->maze;
        $x = $point[0];
        $y = $point[1];

        if(0 <= $x && $x < 10 && 0 <= $y && $y < 10 && !$grid[$x][$y]){
            return true;
        }
        return false;
    }

    ////////// Optional block ///////////////////////////////////
    public function generateNewGrid()
    {
        $grid = array();
        for ($i=0; $i < 10; $i++) { 
            $z = array();
            for ($j=0; $j < 10; $j++) { 
                $ran = array(0,0,1);
                $z[] =  $ran[array_rand($ran, 1)];
            }
            $grid[] = $z;
        }
        $this->maze = $grid;
    }


    public function showGrid()
    {
       foreach ($this->maze as $array) 
           {
               foreach ($array as $element) 
               {
                   echo $element . " ";
               }
               echo "<br>";
           } 
    }


    public function setNewPoints(array $a, array $b)
    {
        $this->start = $a;
        $this->end = $b;
    }
    ////////////////// Save log block ///////////////////////////

    private function storeData()
    {
        $breadth_first_search_attempts = [
            "Start point" => json_encode($this->start),
            "Finish point" => json_encode($this->end),
            "Path" => is_string($this->result) ? $this->result : json_encode($this->result)
        ];

        $handle = @fopen($this->storage, 'r+');
        if ($handle)
        {
            
            fseek($handle, 0, SEEK_END);
            if (ftell($handle) > 0)
            {
                fseek($handle, -1, SEEK_END);
                fwrite($handle, ',', 1);
                fwrite($handle, json_encode($breadth_first_search_attempts,JSON_PRETTY_PRINT) . ']');
            }
            else
            {
                fwrite($handle, json_encode(array($breadth_first_search_attempts),JSON_PRETTY_PRINT));
            }
                fclose($handle);
        }

    }
}



$grid = [
    [0,1,0,1,1,0,1,0,1,0],
    [0,1,0,0,0,0,1,0,1,0],
    [0,1,1,0,1,0,1,0,0,0],
    [0,0,0,1,1,0,1,1,1,0],
    [0,1,0,0,0,0,0,0,1,0],
    [0,1,0,1,1,1,1,0,1,0],
    [0,1,0,0,1,0,1,0,0,0],
    [0,1,0,0,1,0,1,0,1,0],
    [0,1,0,0,1,0,0,0,1,0],
    [0,1,0,0,1,0,1,1,1,0],
];

$start = [0, 0];  // [Y,X]
$finish = [9, 2]; // [Y,X]


$bfs = new Pathfinder($grid, $start, $finish); 
echo $bfs;