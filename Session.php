<?php
class Session
{
    private $sessionKey = 'visites';

    public function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function getVisites()
    {
        $this->startSession();
        if (!isset($_SESSION[$this->sessionKey])) {
            $_SESSION[$this->sessionKey] = 0;
        }
        return $_SESSION[$this->sessionKey];
    }

    public function incrementVisites()
    {
        $this->startSession();

        $_SESSION[$this->sessionKey]++;
    }

    public function reset()
    {
        session_unset();
        session_destroy();
    }
}
