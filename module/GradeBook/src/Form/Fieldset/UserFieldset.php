<?php

namespace GradeBook\Form\Fieldset;

use Laminas\Form\Fieldset;

class UserFieldset extends Fieldset
{
    public function init(): void
    {
        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'firstName',
            'type' => 'text',
            'options' => [
                'label' => 'First name',
            ],
        ]);
        $this->add([
            'name' => 'lastName',
            'type' => 'text',
            'options' => [
                'label' => 'Last name',
            ],
        ]);
    }
}