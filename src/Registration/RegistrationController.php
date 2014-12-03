<?php
/**
 * Handles the registration related actions.
 */
namespace Kata\Registration;

use SebastianBergmann\Exporter\Exception;

class RegistrationController
{
	/** @var Validator */
	protected $validator;
	/** @var UserBuilder */
	protected $userBuilder;
	/** @var UserDao2 */
	protected $userDao;

	/**
	 * Constructor.
	 *
	 * @param Validator   $validator
	 * @param UserBuilder $userBuilder
	 * @param UserDao2    $userDao
	 */
	public function __construct(Validator $validator, UserBuilder $userBuilder, UserDao2 $userDao)
	{
		$this->validator   = $validator;
		$this->userBuilder = $userBuilder;
		$this->userDao     = $userDao;
	}

	public function doRegistration(Request $request)
	{
		try
		{
			$this->validator->isValidUserName();
			$this->validator->isValidPassword();

			$user = $this->userBuilder->getUser($request->getUserName(), $request->getPassword());

			$uid = $this->userDao->create($user);

			return new Response('yes', '201', $uid);
		}
		catch(InvalidUserNameException $exception)
		{
			return new Response('no', '601', '');
		}
		catch(InvalidPasswordException $exception)
		{
			return new Response('no', '602', '');
		}
		catch(UserExistsException $exception)
		{
			return new Response('no', '701', '');
		}
		catch(Exception $exception)
		{
			return new Response('no', '500', '');
		}
	}
}