MillwrightFilterBundle
======================

Glue together KnpPaginatorBundle and LexikFormFilterBundle.

* Inject service @millwright_filter.paginator
* Use PaginatorInterface $paginator;
* Use $this->paginator->paginate($builder, 'users', $form);

* builder - QueryBuilder or something to paginate
* 'user'  - paginator parameters and query builder namespce
* form    - filter form, see LexikFormFilterBundle

Services
========

millwright_filter.registry used for storing query parameters (see OptionsRegistryInterface)

Twig functions
==============

Used for saving paginator and filter state in get parameters.

options_registry(exclude_namespace, overrides) - returns array, used for sharing query parameters between filter form and paginator:

``` jinjia
{% beginmacro form(form, attributes) %}
    <form {{ form_enctype(form) }} {{ _self.attributes(attributes) }} novalidate>
    {{ form_widget(form) }}
    {#
        options_registry(form.vars.name) - build http query with all stored parameters, except this form
    #}
    {% for key, value in options_registry(form.vars.name) %}
        <input name="{{ key }}" value="{{ value }}" type="hidden" />
    {% endfor %}
    </form>
{% endmacro form %}
```

options_query(overrides, exlude_namespace) - returns string, builds http query, used for links (paginator, filters state):

``` html
<a href="?{{ options_query({current: next}) }}">Prev</a>
<a href="?{{ options_query({current: prev}) }}">Next</a>
```

In controller:

``` php
    /** @var $options \Millwright\FilterBundle\OptionRegistryInterface */
    $options = $this->get('millwright_filter.registry');
    $options->addOption('current', $currentDate->format(DateUtil::SQL_DATE));

    return array('next' => 'next week', 'prev' => 'prev week', 'paginator' => $paginator, 'filter' => $form);
```
