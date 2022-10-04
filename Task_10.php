<?php
class Calculator
{
    private int|float $number_1;
    private int|float $number_2;
    private string|int|float $result;

    public function __construct(int|float $num_1, int|float $num_2)
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
        if ($this->number_2 == 0) {
            $this->result = "You cannot divide by 0";
        }
        $this->result = round($this->number_1 / $this->number_2, 2);
        return $this;
    }

    public function substract(): Calculator
    {
        $this->result = $this->number_1 - $this->number_2;
        return $this;
    }

    public function addBy(int|float $input_number): float
    {
        return $this->result + $input_number;
    }


    public function multiplyBy(int|float $input_number): int|float
    {
        return $this->result * $input_number;
    }

    public function divideBy(int|float $input_number): string|int|float
    {
        if ($input_number === 0) {
            return "You cannot divide by 0";
        }
        return round($this->result / $input_number, 2);
    }

    public function substractBy(int|float $input_number): int|float
    {
        return $this->result - $input_number;
    }
}


$mycalc = new Calculator(4, 2);
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
