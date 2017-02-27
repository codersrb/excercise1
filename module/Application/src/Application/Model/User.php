<?php
namespace Application\Model;


use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class User implements InputFilterAwareInterface
{
    public $pkUserID;
    public $userName;
    public $userPassword;
    public $userConfirmPassword;
    public $userPhoneNumber;
    public $userDateofBirth;
    public $userAddress;
    public $userAdded;

	protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->pkUserID     = (isset($data['pkUserID'])) ? $data['pkUserID'] : null;
        $this->userName = (isset($data['userName'])) ? $data['userName'] : null;
        $this->userPassword  = (isset($data['userPassword'])) ? $data['userPassword'] : null;
        $this->userConfirmPassword  = (isset($data['userConfirmPassword'])) ? $data['userConfirmPassword'] : null;
        $this->userPhoneNumber  = (isset($data['userPhoneNumber'])) ? $data['userPhoneNumber'] : null;
        $this->userDateofBirth  = (isset($data['userDateofBirth'])) ? $data['userDateofBirth'] : null;
		$this->userAddress  = (isset($data['userAddress'])) ? $data['userAddress'] : null;
        $this->userAdded  = (isset($data['userAdded'])) ? $data['userAdded'] : null;
    }


	// Add content to these methods:
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
	 	throw new \Exception("Not used");
	}



	public function getInputFilter()
	{
		if(!$this->inputFilter)
		{
			$inputFilter = new InputFilter();

			 $inputFilter->add(array(
			     'name'     => 'userName',
			     'required' => true,
			     'filters'  => array(
			         array('name' => 'StripTags'),
			         array('name' => 'StringTrim'),
			     ),
			     'validators' => array(
			         array(
			             'name'    => 'StringLength',
			             'options' => array(
			                 'encoding' => 'UTF-8',
			                 'min'      => 1,
			                 'max'      => 100,
			             ),
			         ),
			     ),
			 ));

		 $inputFilter->add(array(
		     'name'     => 'userPassword',
		     'required' => true,
		     'filters'  => array(
		         array('name' => 'StripTags'),
		         array('name' => 'StringTrim'),
		     ),
		     'validators' => array(
		         array(
		             'name'    => 'StringLength',
		             'options' => array(
		                 'encoding' => 'UTF-8',
		                 'min'      => 1,
		                 'max'      => 100,
		             ),
		         ),
		     ),
		 ));


		 $inputFilter->add(array(
		     'name'     => 'userConfirmPassword',
		     'required' => true,
		     'filters'  => array(
		         array('name' => 'StripTags'),
		         array('name' => 'StringTrim'),
		     ),
		     'validators' => array(
		         array(
		             'name'    => 'StringLength',
		             'options' => array(
		                 'encoding' => 'UTF-8',
		                 'min'      => 1,
		                 'max'      => 100,
		             ),
		         ),
		     ),
		 ));

		 $inputFilter->add(array(
		     'name'     => 'userPhoneNumber',
		     'required' => true,
		     'filters'  => array(
		         array('name' => 'StripTags'),
		         array('name' => 'StringTrim'),
		     ),
		     'validators' => array(
		         array(
		             'name'    => 'StringLength',
		             'options' => array(
		                 'encoding' => 'UTF-8',
		                 'min'      => 1,
		                 'max'      => 100,
		             ),
		         ),
		     ),
		 ));

		 $inputFilter->add(array(
		     'name'     => 'userDateofBirth',
		     'required' => true,
		     'filters'  => array(
		         array('name' => 'StripTags'),
		         array('name' => 'StringTrim'),
		     ),
		     'validators' => array(
		         array(
		             'name'    => 'StringLength',
		             'options' => array(
		                 'encoding' => 'UTF-8',
		                 'min'      => 1,
		                 'max'      => 100,
		             ),
		         ),
		     ),
		 ));
		 $inputFilter->add(array(
		     'name'     => 'userAddress',
		     'required' => true,
		     'filters'  => array(
		         array('name' => 'StripTags'),
		         array('name' => 'StringTrim'),
		     ),
		     'validators' => array(
		         array(
		             'name'    => 'StringLength',
		             'options' => array(
		                 'encoding' => 'UTF-8',
		                 'min'      => 1,
		                 'max'      => 100,
		             ),
		         ),
		     ),
		 ));

		 $this->inputFilter = $inputFilter;
		}

		return $this->inputFilter;
	}
}
