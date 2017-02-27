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
use Zend\Authentication\AuthenticationService;
use Application\Forms\LoginForm;
use Application\Forms\SignupForm;
use Application\Model\User;
use Application\Authentication\Adapter\AdminAuth as AuthAdapter;

class IndexController extends AbstractActionController
{

	/**
	 * @var Auth Holder property
	 */
	protected $auth;

	protected $albumTable;
	protected $adminTable;
	protected $userTable;

	/**
	 * @todo Constructor method.
	 * @todo To autoload dependencies
	 */
	public function __construct()
	{
		if (!$this->auth instanceof AuthenticationService)
		{
			$this->auth = new AuthenticationService();
		}
	}




	/**
	 * @todo Index action
	 */
    public function indexAction()
    {
		/** Check if logged-in */
        if(!$this->auth->hasIdentity())
		{
			$this->redirect()->toRoute('admin-login');
        }

		return new ViewModel(['title' => 'Dashboard']);

    }



	/**
	 * @todo Login Action
	 */
    public function loginAction()
    {
		/** Check if logged-in */
        if($this->auth->hasIdentity())
		{
            $this->redirect()->toRoute('home');
        }

		$this->layout('login');


        $formErrors = [];
        $loginForm = new LoginForm();

		/**
		 * @todo If POST Request
		 */
        if($this->getRequest()->isPost())
		{

            $loginData = $this->getRequest()->getPost()->toArray();

            /** Validate form data */
            $loginForm->setInputFilter($this->getAdminTable()->loginFilter());

            $loginForm->setData($loginData);

            if($loginForm->isValid())
			{
                /** valid form, now login to system */
                $data = $loginForm->getData();

                $authAdapter = new AuthAdapter($data['uname'], $data['passwd'], $this->getAdminTable());
                $result = $this->auth->authenticate($authAdapter);

                // check if credential is invalid
                if(!$result->isValid())
				{
                    $formErrors = $result->getMessages();
                }
				else
				{
                    $this->flashMessenger()->addMessage('Logged In');
                    return $this->redirect()->toRoute('home');
                }
            }
			else
			{
                $formErrors = $loginForm->getMessages();
            }
        }

        return new ViewModel([
            'loginForm' => $loginForm,
            'aErrors' => $formErrors,
			'title' => 'Login'
        ]);


    }


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
			$user = new User();
            $signupForm->setInputFilter($user->getInputFilter());
            $signupForm->setData($request->getPost());



			if($signupForm->isValid())
			{
                $user->exchangeArray($signupForm->getData());
                $this->getUserTable()->saveUser($user);

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


	public function getAdminTable()
    {
        if (!$this->adminTable) {
            $sm = $this->getServiceLocator();
            $this->adminTable = $sm->get('Application\Model\AdminTable');
        }
        return $this->adminTable;
    }



	public function getUserTable()
    {
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('Application\Model\UserTable');
        }
        return $this->userTable;
    }
}
