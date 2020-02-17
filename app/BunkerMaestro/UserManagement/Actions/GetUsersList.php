<?php


namespace App\BunkerMaestro\UserManagement\Actions;


use App\BunkerMaestro\UserManagement\QueryBuilders\GetUsersBuilder;
use App\User;

class GetUsersList
{
    /**
     * @var GetUsersBuilder
     */
    private $builder;

    public function __construct(GetUsersBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function handle(int $page)
    {
        return User::query()->paginate(10, ['*'], 'page', $page);
    }
}
