<?php

namespace Laravel\Nova\Http\Requests;

use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Exceptions\LensCountException;

class LensCountRequest extends NovaRequest
{
    use CountsResources;
    use InteractsWithLenses;

    /**
     * Get the count of the lens resources.
     *
     * @return int
     */
    public function toCount()
    {
        return rescue(function () {
            return $this->toQuery()->toBase()->getCountForPagination();
        }, 0);
    }

    /**
     * Transform the request into a query.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function toQuery()
    {
        return tap($this->lens()->query(LensRequest::createFrom($this), $this->newSearchQuery()), function ($query) {
            if (! $query instanceof Builder) {
                throw new LensCountException('Lens must return an Eloquent query instance in order to count lens resources.');
            }
        });
    }
}
