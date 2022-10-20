<?php

namespace App\tests\Form\ContactTest;

use App\Entity\Message;
use App\Form\MessageType;
use Symfony\Component\Form\Test\TypeTestCase;



class ContactTest extends TypeTestCase 
{
	public function testSubmitValidData()
	{
		$formData = [
            'name' => 'test',
            'email' => 'test@test.com',
			'message' => 'test unitaire'
        ];

        $model = new Message();
		$form = $this->factory->create(MessageType::class, $model);
		$expected = new Message();
		$form->submit($formData);
		$this->assertTrue($form->isSynchronized());

        // check that $model was modified as expected when the form was submitted
        $this->assertEquals($expected, $model);
	}
}