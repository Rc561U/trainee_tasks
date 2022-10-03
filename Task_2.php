<?php

class Birthday
{
	private string $today;
	private string $birthday;
	private string $days_left;


	public function __construct(string $date)
	{

		if ($this->validateInputFormat($date) && $this->isDateExist($date)) 
		{
			$this->today = date("d-m-Y");
			$this->birthday = $date;
			$this->birthday_passed_or_not($date);
			$this->left_days_until_birthday();
		}

		else {$this->days_left = "Incorrect date entered. Acceptable date format is 'DD-MM-YYYY'";}
		
		
	}


	public function __toString()
    {
        return $this->days_left;
    }
	

	private function birthday_passed_or_not(string $userInpBirthday)
	{
		$today = strtotime($this->today);
		$birthday = strtotime($userInpBirthday);

		$current_year_birthday = strtotime($this->get_current_birthday($birthday));
	
		if ($today > $current_year_birthday) 
		{
			$this->birthday = $this->get_next_birthday($birthday);
		}
		else
		{
			$this->birthday = $this->get_current_birthday($birthday);
		}

	}


	private function get_current_birthday($date):string
	{
		return date("d-m-Y",strtotime(date('d M', $date).date('Y')));
		
	}


	private function get_next_birthday($date):string
	{
		return date("d-m-Y",strtotime(date('d M', $date).date('Y',strtotime('+1 year'))));
		
	}


	private function left_days_until_birthday()
	{
		$datetime1 = date_create($this->today);
		$datetime2 = date_create($this->birthday);

		$interval = date_diff($datetime1, $datetime2);
		$this->days_left = $interval->format('%R%a days are left until the entered birthday');
	}


	private function isDateExist(string $date): bool
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




$birthdays = array("", 12, "99-99-9999", "31-02-2022", "29-01-1996", date("d-m-Y"), "30-12-2001");

foreach ($birthdays as $birthday) 
{
	$user_bd = new Birthday($birthday);
	echo $user_bd;
	echo "<br>";
}

