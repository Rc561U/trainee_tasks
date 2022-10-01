<?php

class Birthday
{
	private string $today;
	private string $birthday;
	private string $days_left;


	public function __construct(string $data)
	{
		$this->today = date("d-m-Y");
		$this->birthday = $data;
		$this->birthday_passed_or_not($data);
		$this->left_days_until_birthday();
		
	}


	public function __toString()
    {
        return $this->days_left;
    }
	

	private function birthday_passed_or_not(string $birthday)
	{
		$today = strtotime($this->today);
		$birthday = strtotime($birthday);
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


	private function get_current_birthday(string $date): string
	{
		return date("d-m-Y",strtotime(date('d M', $date).date('Y')));
		
	}


	private function get_next_birthday(string $date): string
	{
		return date("d-m-Y",strtotime(date('d M', $date).date('Y',strtotime('+1 year'))));
		
	}


	public function left_days_until_birthday()
	{
		$datetime1 = date_create($this->today);
		$datetime2 = date_create($this->birthday);

		$interval = date_diff($datetime1, $datetime2);
		$this->days_left = $interval->format('%R%a days are left until the entered birthday');
	}
}




$birthdays = array( "29-01-1996", date("d-m-Y"), "30-12-2001");

foreach ($birthdays as $birthday) 
{
	$user_bd = new Birthday($birthday);
	echo $user_bd;
	echo "<br>";
}



