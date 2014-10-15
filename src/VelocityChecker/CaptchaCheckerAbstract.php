<?php
/**
 * CaptchaCheckerAbstract.
 */

namespace Kata\VelocityChecker;

abstract class CaptchaCheckerAbstract {

	/** The failed login attempts ttl. */
	const FAILED_LOGIN_ATTEMPTS_TTL = 3600;

	/**
	 * Checks the captcha is needed.
	 *
	 * @param AttemptDo $attemptDo   The failed login attempt data.
	 *
	 * @return bool   TRUE, if captcha is needed, otherwise FALSE.
	 */
	abstract public function checkIsCaptchaNeeded(AttemptDo $attemptDo);

	/**
	 * Decides the captcha is needed.
	 *
	 * @param array  $attempts       The attempts array.
	 * @param string $attemptValue   The current attempt value.
	 * @param int    $attemptLimit   The failed attempts limit.
	 *
	 * @return bool
	 */
	protected function isCaptchaNeeded(array $attempts, $attemptValue, $attemptLimit)
	{
		$attemptCount        = 0;
		$attemptValidityTime = time() - self::FAILED_LOGIN_ATTEMPTS_TTL;

		/** @var AttemptDo $attempt */
		foreach ($attempts as $attempt)
		{
			if ($attempt->getValue() !== $attemptValue)
			{
				continue;
			}

			if (
				$attempt->getTime() >= $attemptValidityTime
				&& ++$attemptCount >= $attemptLimit
			) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Increases the failed attempts.
	 *
	 * @param array     &$attempts   The current attempts container.
	 * @param AttemptDo $attemptDo   The failed login attempt data.
	 *
	 * @return void
	 */
	protected function increaseAttempts(array &$attempts, AttemptDo $attemptDo)
	{
		$attempts[] = $attemptDo;
	}
}