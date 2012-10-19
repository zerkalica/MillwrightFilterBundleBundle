<?php
namespace Millwright\FilterBundle\Twig;

use Millwright\Util\Request\OptionRegistryInterface;

/**
 * Twig extension for Bootstrap helpers
 */
class FilterExtension extends \Twig_Extension
{
    protected $options;

    /**
     * Constructor
     *
     * @param OptionRegistryInterface $options
     */
    public function __construct(OptionRegistryInterface $options)
    {
        $this->options = $options;
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return array(
            'options_registry' => new \Twig_Function_Method($this, 'getOptions'),
            'options_query'    => new \Twig_Function_Method($this, 'getQuery'),
        );
    }

    /**
     * Gets all stored in registry options
     *
     * @param string|null   $namespace
     * @param string[]|null $overrides
     *
     * @return string[string]
     */
    public function getOptions($namespace = null, array $overrides = null)
    {
        return $this->options->getOptions($namespace, $overrides);
    }

    /**
     * Gets all stored in registry options as a GET query (?q=w&e=r)
     *
     * @param string[]|null $overrides
     * @param string|null   $namespace
     *
     * @return string
     */
    public function getQuery(array $overrides = null, $namespace = null)
    {
        $options = $this->options->getOptions($namespace, $overrides);

        return http_build_query($options, null, '&');
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return 'millwright_filter';
    }
}
