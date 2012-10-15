<?php
namespace Millwright\FilterBundle;

/**
 * Option registry
 */
interface OptionRegistryInterface
{
    /**
     * Add option to namespace
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return void
     */
    function addOption($key, $value);

    /**
     * Get all stored options array
     *
     * @param string|null $key
     * @param array|null  $overrides
     *
     * @return string[string]
     */
    function getOptions($key = null, array $overrides = null);
}
