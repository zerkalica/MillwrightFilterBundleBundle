<?php
namespace Millwright\FilterBundle\Paginator;

use Symfony\Component\Form\Form;

use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Paginator interface
 */
interface PaginatorInterface
{
    /**
     * Get paginator object
     *
     * @param object    $target pagination target ex: QueryBuilder
     * @param string    $alias  namespace of pagination get parameters
     * @param Form|null $form   optional filter form
     *
     * @return PaginationInterface
     */
    function paginate($target, $alias, Form $form = null);
}
