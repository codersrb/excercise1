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
	protected $dbAdapter;

	/**
	 * @todo Database adapter
	 */
	public function setDbAdapter($dbAdapter)
    {
		$this->dbAdapter = $dbAdapter;
    }


	/**
	 * @todo to exchange received data to properties
	 */
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


	/**
	 * @todo Set Input Filter
	 */
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
	 	throw new \Exception("Not used");
	}


	/**
	 * @todo Input Validation method
	 */
	public function getInputFilter()
	{
		if(!$this->inputFilter)
		{
			$inputFilter = new InputFilter();

			/**
			 * @todo Clause for username validator
			 */
			 $clause = null;

			 if($data['userName'])
			 {
				 $clause = 'userName = ' . (string) $data['userName'];
			 }


			 /**
			  * @todo
			  * Filters {StripTags, StringTrim}
			  * Validations {StringLength, NoRecordExists, Alpha}
			  */
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
			                 'min'      => 4,
			                 'max'      => 20,
			             ),
			         ),
			         array(
			             'name'    => '\Zend\Validator\Db\NoRecordExists',
			             'options' => array(
			                 'table' => 'tbl_users',
							 'field'   => 'userName',
					         'adapter' => $this->dbAdapter,
					         'exclude' => $clause,
			             ),
			         ),
					 array(
						 'name' => 'Alpha'
					 ),
			     ),
			 ));


			 /**
			 * @todo
			 * Filters {StripTags, StringTrim}
			 * Validations {StringLength, Alnum}
			 */
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
			                 'min'      => 6,
			                 'max'      => 25,
			             ),
			         ),
					 array(
						 'name' => 'Alnum'
					 ),
			     ),
			 ));


			 /**
			 * @todo
			 * Filters {StripTags, StringTrim}
			 * Validations {StringLength, Identical, Alnum}
			 */
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
							 'min'      => 6,
			                 'max'      => 25,
			             ),
			         ),
					 array(
			            'name' => 'Identical',
			            'options' => array(
			                'token' => 'userPassword',
			            ),
			        ),
					array(
						'name' => 'Alnum'
					),
			     ),
			 ));


			 /**
			 * @todo
			 * Filters {StripTags, StringTrim}
			 * Validations {StringLength, Digits}
			 */
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
			                 'min'      => 8,
			                 'max'      => 15,
			             ),
			         ),
					 array(
			             'name'    => 'Digits',
			         ),
			     ),
			 ));


			 /**
			 * @todo
			 * Filters {StripTags, StringTrim}
			 * Validations {Date}
			 */
			 $inputFilter->add(array(
			     'name'     => 'userDateofBirth',
			     'required' => true,
			     'filters'  => array(
			         array('name' => 'StripTags'),
			         array('name' => 'StringTrim'),
			     ),
				 'validators' => array(
					 array('name' => 'Date')
				 )
			 ));


			 /**
			 * @todo
			 * Filters {StripTags, StringTrim}
			 * Validations {StringLength}
			 */
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
			                 'min'      => 8,
			                 'max'      => 50,
			             ),
			         ),
			     ),
			 ));


			 /**
			 * @todo
			 * Validations {CSRF}
			 */
			 $inputFilter->add(array(
			     'name'     => 'csrf',
			     'validators'  => array(
			         array('name' => 'csrf'),
			     )
			 ));

		 	$this->inputFilter = $inputFilter;

		}

		return $this->inputFilter;
	}
}
