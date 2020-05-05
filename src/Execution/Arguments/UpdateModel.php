<?php

namespace Nuwave\Lighthouse\Execution\Arguments;

use Illuminate\Database\Eloquent\Model;
use Nuwave\Lighthouse\Support\Contracts\ArgResolver;

class UpdateModel implements ArgResolver
{
    /**
     * @var callable|\Nuwave\Lighthouse\Support\Contracts\ArgResolver
     */
    private $previous;

    /**
     * @param callable|\Nuwave\Lighthouse\Support\Contracts\ArgResolver $previous
     */
    public function __construct(callable $previous)
    {
        $this->previous = $previous;
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation  $modelOrrelation
     * @param  \Nuwave\Lighthouse\Execution\Arguments\ArgumentSet  $args
     */
    public function __invoke($modelOrRelation, $args)
    {
        $model = $modelOrRelation instanceof Model ? $modelOrRelation : $modelOrRelation->make();

        $id = $args->arguments['id']
            ?? $args->arguments[$model->getKeyName()];

        $model = $modelOrRelation->newQuery()->findOrFail($id->value);

        return ($this->previous)($model, $args);
    }
}
