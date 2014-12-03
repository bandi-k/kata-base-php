<?php
/**
 * Handles the registration related actions.
 */
namespace Kata\Registration;

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
		catch(\Exception $exception)
		{
			return new Response('no', '500', '');
		}
	}
}