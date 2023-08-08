<?php

namespace GradeBook\Form\Fieldset;

use GradeBook\Entity\Course;
use GradeBook\Entity\Student;
use Laminas\Form\Fieldset;

class StudentCourseFieldset extends Fieldset
{
    public function init(): void
    {
        $this->add([
            'name' => 'student',
            'type' => Student::class,
        ]);
        $this->add([
            'name' => 'course',
            'type' => Course::class,
        ]);
    }
}