<?php 
class Calculator
{
    private int $number_1;
    private int $number_2;
    private string|int|float $result;

    public function __construct(int $num_1, int $num_2)
    {
        $this->number_1 = $num_1;
        $this->number_2 = $num_2;
    }

    public function __toString()
    {
        return $this->result;
    }

    public function add(): Calculator
    {
        $this->result = $this->number_1 + $this->number_2;
        return $this;
    }


    public function multiply(): Calculator
    {
        $this->result = $this->number_1 * $this->number_2;
        return $this;
    }

    public function divide(): Calculator
    {
        if ($this->number_2 === 0)
        {
            $this->result = "You cannot divide by 0";
        }
        $this->result = $this->number_1 / $this->number_2;
        return $this;
    }

    public function substract(): Calculator
    {
        $this->result = $this->number_1 - $this->number_2;
        return $this;
    }

    public function addBy(int $input_number): float
    {
        return $this->result + $input_number;
    }


    public function multiplyBy(int $input_number): float
    {
        return $this->result * $input_number;
    }

    public function divideBy(int $input_number): string|int|float
    {
        
        if ($input_number === 0){return "You cannot divide by 0";}
        return $this->result / $input_number;
    }

    public function substractBy(int $input_number): float
    {
        return $this->result - $input_number;
    }
}

$mycalc = new Calculator(12, 6);
echo $mycalc->add();
echo "\n";
echo $mycalc->multiply();
echo "\n";
echo $mycalc->divide();
echo "\n";
echo $mycalc->substract();
echo "\n";

echo $mycalc->add()->divideBy(9);
echo "\n";
echo $mycalc->add()->substractBy(9);
echo "\n";
echo $mycalc->add()->multiplyBy(9);
echo "\n";
echo $mycalc->add()->addBy(9);

