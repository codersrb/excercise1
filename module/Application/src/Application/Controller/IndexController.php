<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Forms\SignupForm;
use Application\Model\User;
use Application\Model\UserTable;

class IndexController extends AbstractActionController
{
	protected $userTable;
	/**
	 * @todo Signup Action
	 */
    public function signupAction()
    {
		$this->layout('login');


        $formErrors = [];
        $signupForm = new SignupForm();

		/**
		 * @todo If POST Request
		 */
		$request = $this->getRequest();
        if($request->isPost())
		{
			$dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

			$user = new User();
			$user->setDbAdapter($dbAdapter);
            $signupForm->setInputFilter($user->getInputFilter());
            $signupForm->setData($request->getPost());

			/** Validation */
			if($signupForm->isValid())
			{
                $user->exchangeArray($signupForm->getData());
                $boolSave = $this->getUserTable()->save($user);

				if($boolSave)
				{
					$this->flashMessenger()->addMessage(['success' => 'Signup successful !']);
					$this->redirect()->toRoute('signup-success');
				}

            }
			else
			{
				$formErrors = $signupForm->getMessages();
			}


        }

        return new ViewModel([
            'signupForm' => $signupForm,
            'formErrors' => $formErrors,
			'title' => 'Login'
        ]);
    }


	/**
	 * @todo Signup success Action
	 */
    public function signupSuccessAction()
    {
		$this->layout('login');

        return new ViewModel();
    }

	/**
	 * @todo User table
	 */
	public function getUserTable()
    {
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('Application\Model\UserTable');
        }
        return $this->userTable;
    }
}
