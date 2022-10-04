<?php
class Birthday
{

	private $nextdate;
	private $tonext;
	private $result;
	public function __construct($date)
	{
		if ($this->validateInputFormat($date) && $this->is_date_exist($date)) {
			$birthdate = new DateTime($date);
			$today = new DateTime("today");
			$this->nextdate = new DateTime($birthdate->format('d F') . " this year");
			$this->nextdate >= $today or $this->nextdate->modify("+1 year");
			$this->tonext = $today->diff($this->nextdate);
			$this->result = $this->tonext->format('%a') . ' days are left until the entered birthday';
		} else {
			$this->result = "Incorrect date entered. Acceptable date format is 'DD-MM-YYYY'";
		}
	}


	public function __toString()
	{
		return $this->result;
	}

	private function is_date_exist(string $date): bool
	{
		$d = DateTime::createFromFormat($format = 'd-m-Y', $date);
		return $d && $d->format($format) === $date;
	}


	private function validateInputFormat(string $date): int
	{
		$pattern = "/^[\d]{2}-[\d]{2}-[\d]{4}$/";
		return preg_match($pattern, $date);
	}
}

//  29-01-1994
$my = new Birthday("29-11-1191");
echo $my;
