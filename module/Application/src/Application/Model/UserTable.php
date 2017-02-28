<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Exception;

class UserTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }


	/**
	 * @todo Save User
	 */
    public function save(User $user)
    {
		$data = [
			'userName' => $user->userName,
			'userPassword' => password_hash($user->userPassword, PASSWORD_DEFAULT),
			'userPhoneNumber' => $user->userPhoneNumber,
			'userDateofBirth' => $user->userDateofBirth,
			'userAddress' => $user->userAddress,
		];

		try
		{
			$this->tableGateway->insert($data);
		}
		catch(Exception $ex)
		{
			$this->flashMessenger()->addMessage($ex->getMessage());
			return false;
		}

		return true;
    }
}
