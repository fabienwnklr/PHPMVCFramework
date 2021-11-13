<?php

namespace app\core;

class Session
{
    protected const FLASH_KEY = 'flash_messages';

    public function __construct()
    {
        session_start();
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];

        foreach ($flashMessages as $key => &$flashMessage) {
            // Mark to be removed
            $flashMessage['remove'] = true;
        }

        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }

    /**
     * Setting flash message
     *
     * @param string $key
     * @param string $message
     * @return void
     */
    public function setFlash(string $key, string $message): void
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'value' => $message
        ];
    }
    
    /**
     * Get flash message
     *
     * @param string $key
     * @return string
     */
    public function getFlash(string $key): string|false
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    public function __destruct()
    {
        // Iterate over marked to be removed
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        
        foreach ($flashMessages as $key => &$flashMessage) {
            if ($flashMessage['remove']) {
                unset($flashMessages[$key]);
            }
        }

        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }
}