<?php

declare(strict_types=1);

namespace App\Repositories\Auth;

use Closure;
use Illuminate\Auth\Passwords\PasswordBrokerManager as IlluminatePasswordBrokerManager;
use Psr\Log\InvalidArgumentException;

/**
 * Class PasswordRepositoryManager.
 */
class PasswordRepositoryManager extends IlluminatePasswordBrokerManager
{
    /**
     * Resolve the given broker.
     *
     * @param string $name
     *
     * @return PasswordRepository
     *
     * @throws \InvalidArgumentException
     */
    protected function resolve($name)
    {
        $config = $this->getConfig($name);
        if (null === $config) {
            throw new InvalidArgumentException("Password resetter [{$name}] is not defined.");
        }
        // The password broker uses a token repository to validate tokens and send user
        // password e-mails, as well as validating that password reset process as an
        // aggregate service of sorts providing a convenient interface for resets.
        return new PasswordRepository(
            $this->createTokenRepository($config),
            $this->app['auth']->createUserProvider($config['provider']),
            $this->app['mailer'],
            $config['email']
        );
    }

    /**
     * Send a password reset link to a user.
     *
     * @return string
     */
    public function sendResetLink(array $credentials)
    {
        // TODO: Implement sendResetLink() method.
    }

    /**
     * Reset the password for the given token.
     *
     * @return mixed
     */
    public function reset(array $credentials, Closure $callback)
    {
        // TODO: Implement reset() method.
    }

    /**
     * Set a custom password validator.
     *
     * @return void
     */
    public function validator(Closure $callback)
    {
        // TODO: Implement validator() method.
    }

    /**
     * Determine if the passwords match for the request.
     *
     * @return void
     */
    public function validateNewPassword(array $credentials)
    {
        // TODO: Implement validateNewPassword() method.
    }
}
