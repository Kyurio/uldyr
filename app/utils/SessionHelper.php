<?php


class SessionHelper
{

    public static function startSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            if (!session_start()) {
                throw new Exception('No se pudo iniciar la sesión.');
            } else {
                // Regenera el ID de sesión para evitar ataques de fijación de sesiones
                session_regenerate_id(true);
            }
        }
    }

    public static function set($key, $value)
    {
        self::startSession();
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        self::startSession();
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function remove($key)
    {
        self::startSession();
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public static function destroy()
    {
        self::startSession();
        session_unset();
        session_destroy();
    }

    public static function validateSession()
    {
        $maxInactiveTime = 1800;
    
        // Obtener la URL de referencia
        $referer = filter_input(INPUT_SERVER, 'HTTP_REFERER', FILTER_VALIDATE_URL);
    
        // Establecer la URL predeterminada en caso de que la URL de referencia sea inválida
        $redirectPath = ($referer === false) ? '/login' : $referer;
    
        self::startSession();
        self::updateLastActivity();
    
        if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] === null || (time() - $_SESSION['last_activity']) > $maxInactiveTime) {
            self::destroy();
            header("Location: $redirectPath");
            exit;
        }
    }
    

    public static function updateLastActivity()
    {
        self::startSession();
        $_SESSION['last_activity'] = time();
    }

    public static function setSessionTimeout($seconds)
    {
        ini_set('session.gc_maxlifetime', $seconds);
    }

    public static function setCookieLifetime($seconds)
    {
        session_set_cookie_params($seconds);
    }
}
