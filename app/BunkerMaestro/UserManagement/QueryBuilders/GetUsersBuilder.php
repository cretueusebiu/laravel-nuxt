<?php


namespace App\BunkerMaestro\UserManagement\QueryBuilders;


use App\BunkerMaestro\Core\QueryBuilders\PaginatorBuilder;
use App\BunkerMaestro\Core\QueryBuilders\QueryBuilder;
use App\User;
use Illuminate\Database\Eloquent\Builder;

class GetUsersBuilder implements QueryBuilder
{
    private $paginator;

    public function __construct(PaginatorBuilder $paginator)
    {
        $this->paginator = $paginator;
    }

    public function build(int $currentPage = 1): Builder
    {
        $builder = User::query();
        return $this->paginator->setCurrentPage($currentPage)
        ->build($builder);
    }
}
