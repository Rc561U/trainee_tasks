<?php 


class Matrix
{
	private $matrix;
	private $rows;
	private $columns;


	public function __construct()
	{
		$this->matrix = array(
			array(1,2,3),
			array(4,5,6),
			array(7,8,9)
		);
		$this->calulateRowsAndCols($this->matrix);
	}

	public function showMatrix()
	{
		foreach ($this->matrix as $row) {
			foreach ($row as $value) {
				echo $value . " ";
			}
			echo "<br>";
		}
	}


	public function multiplyByNum(int $number)
	{	
		$newMatrix = $this->matrix;

		for ($i=0; $i < count($newMatrix); $i++) { 
			for ($j=0; $j < count($newMatrix[$i]); $j++) { 
				$newMatrix[$i][$j] = $newMatrix[$i][$j] * $number;
			}
		}
		$this->matrix = $newMatrix;
		$this->calulateRowsAndCols($newMatrix);
	}


	public function multiplyMatrix(array $inputMatrix)
	{	
		if (!$this->checkMatrix($inputMatrix)) {
			echo "The first matrix must have the same number of columns as the second matrix has rows";
			return;
		}
		$oldMatrix = $this->matrix;
		$inpMatrix = $inputMatrix;
		$newMatrix = array();
		$matrLen = $this->rows;
		for ($i = 0; $i < $matrLen; $i++)
		    {
		        for ($j = 0; $j < $matrLen; $j++)
		        {
		            $newMatrix[$i][$j] = 0;
		            for ($k = 0; $k < $matrLen; $k++)
		                $newMatrix[$i][$j] += $oldMatrix[$i][$k] * $inpMatrix[$k][$j];
		        }
		    }
		$this->matrix = $newMatrix;
		$this->calulateRowsAndCols($newMatrix);
	}

	public function addNewMatrix(array $matix)	
	{
		$this->matrix = $matrix;
		$this->calulateRowsAndCols($matrix);
	}


	private function checkMatrix(array $matrix) : bool	
	{
		return count($matrix) == $this->rows ? true : false ;
	}


	private function calulateRowsAndCols(array $matrix)
	{
		$this->rows = count($matrix);
		$this->cols = count($matrix[0]);
	}
	
}


$myMatrix = new Matrix();
$myMatrix->showMatrix();
$myMatrix->multiplyByNum(2);

$new = array(
			array(1,2,3),
			array(4,5,6),
			array(7,8,9),
		);

$myMatrix->multiplyMatrix($new);

$myMatrix->showMatrix();
