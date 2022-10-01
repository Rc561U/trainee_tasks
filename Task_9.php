<?php

class Student
{
    public $firstName;
    public $lastName;
    public $group;
    public $marks;

    public function __construct($firstName, $lastName, $group, $marks)
    {
        $this->markValidation($marks);

        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->group = $group;
        $this->marks = ceil(array_sum($marks)/count($marks));
    }

    public function markValidation($marks)
    {
        if (gettype($marks) != 'array')
        {
            throw new InvalidArgumentException(
                '$marks must be an array of integers!'
            );
        }

        if (empty($marks))
        {
            throw new InvalidArgumentException(
                'array $marks cannot be empty!'
            );
        }

        foreach ($marks as $mark) {
            if (gettype($mark) != 'integer')
            {
                throw new InvalidArgumentException(
                    '$marks must be an array of integers!'
                );
            }
        }
        
        foreach ($marks as $mark) {
            if ($mark > 5 || $mark < 1)
            {
                throw new InvalidArgumentException(
                    'mark must be at least 1, but not bigger than 5!'
                );
            }
        }
        
        
    }

    public function getScholarship() 
    {
        return  $this->marks == 5 ? 100 : 80;
    }

}

class Aspirant extends Student
{
    public $scientificWork;

    public function __construct($firstName, $lastName, $group, $marks, $scientificWork)
    {
        parent::__construct($firstName, $lastName, $group, $marks);
        $this->markValidation($marks);

        $this->scientificWork = $scientificWork;
    }


    public function getScholarship() 
    {
        return  $this->marks == 5 ? 200 : 180;
    }
}

$students = [
    new Aspirant('John', 'Adams', 409, [4, 5], 'Important work'),
    new Student('Jodie', 'Downs', 109, [4, 5]),
    new Aspirant('Aria', 'Cottrell', 409, [2,5,4,2], 'Not interesting project'),
    new Student('Chanelle', 'Dolan', 209, [5, 5])
];

foreach ($students as $student)
{
    echo $student->getScholarship() . "<br>";
}