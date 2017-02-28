<?php
namespace Application\Forms;

use Zend\Form\Form;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\InputFilter\InputFilter;
use Zend\Captcha\Image;
use Zend\Captcha\AdapterInterface;

class SignupForm extends Form
{

	protected $captcha;

    function __construct()
    {
        parent::__construct('signup-form');

        $this->setAttribute('method', 'post');
		$this->setAttribute('novalidate', 'novalidate');


		$this->captcha = new Image(array(
            'expiration' => '300',
            'wordlen' => '5',
            'font' => 'data/fonts/arial.ttf',
            'fontSize' => '30',
            'imgDir' => 'public/captcha',
            'imgUrl' => 'captcha'
        ));


        $this->add(array(
            'name' => 'userName',
            'type' => 'Text',
            'options' => array(
                'label' => 'Username',
                'label_options' => array(
                    // 'disable_html_escape' => true
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'required' => true,
                'placeholder' => 'Username'
            )
        ));

        $this->add(array(
            'name' => 'userPassword',
            'type' => 'Password',
            'options' => array(
                'label' => 'Password:',
                'label_options' => array(
                    'disable_html_escape' => true
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'required' => true,
                'placeholder' => 'Password'
            )
        ));


		$this->add(array(
            'name' => 'userConfirmPassword',
            'type' => 'Password',
            'options' => array(
                'label' => 'Password:',
                'label_options' => array(
                    'disable_html_escape' => true
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'required' => true,
                'placeholder' => 'Confirm Password'
            )
        ));


		$this->add(array(
            'name' => 'userDateofBirth',
            'type' => 'DateSelect',
            'options' => array(
                'label' => 'Date of Birth',
				'format' => 'Y-m-d',
                'label_options' => array(
                    'disable_html_escape' => true
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'required' => true,
                'placeholder' => 'Date of Birth'
            )
        ));

		$this->add(array(
			'name' => 'userPhoneNumber',
			'type' => 'Text',
			'options' => array(
				'label' => 'Telephone Number',
				'label_options' => array(
					'disable_html_escape' => true
				)
			),
			'attributes' => array(
				'type' => 'tel',
				'class' => 'form-control',
				'required' => true,
				'placeholder' => 'Telephone Number'
			)
		));



		$this->add(array(
			'name' => 'userAddress',
			'type' => 'Textarea',
			'options' => array(
				'label' => 'Address',
				'label_options' => array(
					'disable_html_escape' => true
				)
			),
			'attributes' => array(
				'class' => 'form-control',
				'required' => true,
				'placeholder' => 'Address'
			)
		));

		$this->add(array(
	     'type' => 'Zend\Form\Element\Csrf',
	     'name' => 'csrf',
	   ));


	   $this->add(array(
		    'type'  => 'Zend\Form\Element\Captcha',
            'name' => 'captcha',
            'options' => array(
                'label' => 'Verification',
                'captcha' => $this->captcha,
            ),
			'attributes' => array(
				'class' => 'form-control',
				'required' => true,
				'placeholder' => 'Captcha'
			),
        ));


        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Signup',
                'class' => 'btn btn-primary btn-flat'
            )
        ));
    }
}
