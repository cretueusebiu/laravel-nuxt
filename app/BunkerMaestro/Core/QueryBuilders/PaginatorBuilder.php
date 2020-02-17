<?php


namespace App\BunkerMaestro\Core\QueryBuilders;


use Illuminate\Pagination\LengthAwarePaginator;

class PaginatorBuilder
{
    /**
     * @var int
     */
    private $currentPage;
    /**
     * @var int
     */
    private $perPage;

    public function __construct()
    {
        $this->currentPage = 1;
        $this->perPage = 15;
    }

    public function build(QueryBuilder $builder): LengthAwarePaginator
    {
        return $builder->build()->paginate($this->perPage, ['*'], null, $this->currentPage);
    }

    /**
     * @param int $currentPage
     * @return PaginatorBuilder
     */
    public function setCurrentPage(int $currentPage): PaginatorBuilder
    {
        $this->currentPage = $currentPage;
        return $this;
    }

    /**
     * @param int $perPage
     * @return PaginatorBuilder
     */
    public function setPerPage(int $perPage): PaginatorBuilder
    {
        $this->perPage = $perPage;
        return $this;
    }
}
