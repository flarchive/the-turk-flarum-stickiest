<?php

namespace TheTurk\Stickiest\Query;

use Flarum\Filter\FilterInterface;
use Flarum\Filter\FilterState;
use Flarum\Search\AbstractRegexGambit;
use Flarum\Search\SearchState;
use Illuminate\Database\Query\Builder;

class StickyFilterGambit extends AbstractRegexGambit implements FilterInterface
{
    protected function getGambitPattern()
    {
        return 'is:sticky';
    }

    protected function conditions(SearchState $search, array $matches, $negate)
    {
        $this->constrain($search->getQuery(), $negate);
    }

    public function getFilterKey(): string
    {
        return 'sticky';
    }

    public function filter(FilterState $filterState, string $filterValue, $negate)
    {
        $this->constrain($filterState->getQuery(), $negate);
    }

    protected function constrain(Builder $query, bool $negate)
    {
        $query->where('is_stickier', ! $negate);
    }
}
