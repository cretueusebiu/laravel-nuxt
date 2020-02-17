<?php


namespace App\BunkerMaestro\Core\QueryBuilders;


use Illuminate\Database\Eloquent\Builder;

interface QueryBuilder
{
    public function build(): Builder;
}
