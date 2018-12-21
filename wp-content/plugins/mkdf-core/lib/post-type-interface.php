<?php
namespace MikadoCore\Lib;

/**
 * interface PostTypeInterface
 * @package MikadoCore\Lib;
 */
interface PostTypeInterface {
    /**
     * @return string
     */
    public function getBase();

    /**
     * Registers custom post type with WordPress
     */
    public function register();
}