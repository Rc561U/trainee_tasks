<?php


class Matrix
{
	private $matrix;
	private $rows;
	private $cols;
	private $error_msg = "The first matrix must have the same number of columns as the second matrix has rows";

	public function __construct($matrix)
	{
		$this->matrix = $matrix;
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

		for ($i = 0; $i < count($newMatrix); $i++) {
			for ($j = 0; $j < count($newMatrix[$i]); $j++) {
				$newMatrix[$i][$j] = $newMatrix[$i][$j] * $number;
			}
		}
		return $newMatrix;
	}


	public function multiplyMatrix(array $inputMatrix)
	{
		if (!$this->checkMatrix($inputMatrix)) {
			echo $this->error_msg;
			return;
		}
		$oldMatrix = $this->matrix;
		$inpMatrix = $inputMatrix;
		$newMatrix = array();
		$matrLen = $this->rows;

		for ($i = 0; $i < $matrLen; $i++) {
			for ($j = 0; $j < $matrLen; $j++) {
				$newMatrix[$i][$j] = 0;
				for ($k = 0; $k < $matrLen; $k++)
					$newMatrix[$i][$j] += $oldMatrix[$i][$k] * $inpMatrix[$k][$j];
			}
		}
		return $newMatrix;
	}

	public function addMatrix(array $userAddMatrix)
	{
		if (!$this->checkMatrix($userAddMatrix)) {
			echo $this->error_msg;
			return;
		}

		$newMatrix = [];
		for ($i = 0; $i < $this->rows; $i++) {
			for ($j = 0; $j < $this->cols; $j++) {
				$newMatrix[$i][$j] = $this->matrix[$i][$j] + $userAddMatrix[$i][$j];
			}
		}

		return $newMatrix;
	}


	private function checkMatrix(array $matrix): bool
	{
		return count($matrix) == $this->rows ? true : false;
	}


	private function calulateRowsAndCols(array $matrix)
	{
		$this->rows = count($matrix);
		$this->cols = count($matrix[0]);
	}
}

function showMatrix($matrix)
{
	if (!is_array($matrix)) {
		return $matrix;
	}
	foreach ($matrix as $row) {
		foreach ($row as $value) {
			echo $value . " ";
		}
		echo "<br>";
	}
}

// Initialize new matrix class
$matrix = array(
	[1, 2, 3],
	[4, 5, 6],
	[7, 8, 9],
);

$myMatrix = new Matrix($matrix);
echo "Default matrix<br>";
$myMatrix->showMatrix();

// Multiply by num block
$res = $myMatrix->multiplyByNum(2);
echo "<br>Multiply by 2 operation<br>";
showMatrix($res);

// Multiply two matrix block
$new_matrix = array(
	[1, 2, 3],
	[4, 5, 6],
	[7, 8, 9],
);
echo "<br>Multiply operation<br>";
$res2 = $myMatrix->multiplyMatrix($new_matrix);
showMatrix($res2);

// Add two matrix block
echo "<br>Add operation<br>";
$res3 = $myMatrix->addMatrix($new_matrix);
showMatrix($res3);


// Try to add invalid matrix
$new_matrix = array();
echo "<br>Test operation<br>";
$res2 = $myMatrix->multiplyMatrix($new_matrix);
showMatrix($res2);
echo "<br>";
$new_matrix = [[1, 2, 3], [5, 6, 7], [9, 10, 11], [9, 10, 11], [9, 10, 11]];
$res2 = $myMatrix->addMatrix($new_matrix);
showMatrix($res2);
