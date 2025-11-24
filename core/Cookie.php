<?php

namespace Core;

class Cookie
{
    /**
     * Set a cookie
     *
     * @param string $name Name of the cookie
     * @param string $value Value of the cookie
     * @param int $expire Expiration time (timestamp)
     * @param string $path Path on the server in which the cookie will be available
     * @param string $domain Domain that the cookie is available to
     * @param bool $secure Indicates that the cookie should only be transmitted over a secure HTTPS connection
     * @param bool $httponly When TRUE the cookie will be made accessible only through the HTTP protocol
     * @return bool Returns TRUE on success or FALSE on failure
     */
    public static function set($name, $value, $expire = 0, $path = '/', $domain = '', $secure = false, $httponly = false)
    {
        return setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
    }

    /**
     * Get a cookie value
     *
     * @param string $name Name of the cookie
     * @param mixed $default Default value if cookie doesn't exist
     * @return mixed Cookie value or default if not found
     */
    public static function get($name, $default = null)
    {
        return $_COOKIE[$name] ?? $default;
    }

    /**
     * Check if a cookie exists
     *
     * @param string $name Name of the cookie
     * @return bool Returns TRUE if cookie exists, FALSE otherwise
     */
    public static function has($name)
    {
        return isset($_COOKIE[$name]);
    }

    /**
     * Delete a cookie
     *
     * @param string $name Name of the cookie to delete
     * @param string $path Path on the server in which the cookie will be available
     * @param string $domain Domain that the cookie is available to
     * @return bool Returns TRUE on success or FALSE on failure
     */
    public static function delete($name, $path = '/', $domain = '')
    {
        if (self::has($name)) {
            unset($_COOKIE[$name]);
            return setcookie($name, '', time() - 3600, $path, $domain);
        }
        return false;
    }

    /**
     * Set a cookie that expires when the browser is closed
     *
     * @param string $name Name of the cookie
     * @param string $value Value of the cookie
     * @param string $path Path on the server in which the cookie will be available
     * @param string $domain Domain that the cookie is available to
     * @param bool $secure Indicates that the cookie should only be transmitted over a secure HTTPS connection
     * @param bool $httponly When TRUE the cookie will be made accessible only through the HTTP protocol
     * @return bool Returns TRUE on success or FALSE on failure
     */
    public static function setSession($name, $value, $path = '/', $domain = '', $secure = false, $httponly = false)
    {
        return setcookie($name, $value, 0, $path, $domain, $secure, $httponly);
    }

}