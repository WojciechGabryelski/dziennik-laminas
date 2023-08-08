<?php

namespace GradeBook\Form\Fieldset;

class StudentFieldset extends UserFieldset
{
    public function init(): void
    {
        parent::init();
        $this->add([
            'name' => 'studentCourses',
            'type' => 'hidden',
            'options' => [
                'label' => 'Courses',
            ],
        ]);
    }
}