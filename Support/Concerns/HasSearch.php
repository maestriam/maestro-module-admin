<?php

namespace Maestro\Admin\Support\Concerns;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Builder;

trait HasSearch
{
    /**
     * Scope a query to search for a term in the attributes
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function scopeSearch($query)
    {
        [$searchTerm, $attributes] = $this->parseArguments(func_get_args());

        if (!$searchTerm || !$attributes) {
            return $query;
        }

        return $query->where(function (Builder $query) use ($attributes, $searchTerm) {
            foreach (Arr::wrap($attributes) as $attribute) {
                $query->when(
                    str_contains($attribute, '.'),
                    function (Builder $query) use ($attribute, $searchTerm) {
                        [$relationName, $relationAttribute] = explode('.', $attribute);
                        $query->orWhereHas($relationName, function (Builder $query) use ($relationAttribute, $searchTerm) {
                            $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
                        });
                    },
                    function (Builder $query) use ($attribute, $searchTerm) {
                        $this->getDefaultWhere($query, $attribute, $searchTerm);
                    }
                );
            }
        });
    }

    /**
     * Undocumented function
     *
     * @param [type] $query
     * @return void
     */
    private function getDefaultWhere(Builder $query, string $attr, string $term)
    {
        if ($this->hasConcatColumns($attr)) {
            return $this->getWhereConcat($query, $attr, $term);
        }
        
        return $query->orWhere($attr, 'LIKE', "%{$term}%");
    }

    /**
     * Verifica se as colunas descritas como pesquisaveis (searchable)
     * possuem concatenção entre elas.
     * Se sim, deve retorna true.  
     *
     * @param string $attribute
     * @return boolean
     */
    private function hasConcatColumns(string $attribute) : bool
    {
        return str_contains($attribute, ':');
    }

    /**
     * Interpreta os nomes das colunas como concatenaveis e 
     * retorna seu SQL para interpretação. 
     *
     * @param string $attribute
     * @param string $search
     * @return string
     */
    private function getWhereConcat(Builder $query, string $attribute, string $term) : Builder 
    {
        $fields = explode(':', $attribute);

        return $query->orWhereConcat($fields, 'LIKE', "%{$term}%");
    }

    /**
     * Parse search scope arguments
     *
     * @param array $arguments
     * @return array
     */
    private function parseArguments(array $arguments)
    {
        $args_count = count($arguments);

        switch ($args_count) {
            case 1:
                return [request('q'), $this->searchableAttributes()];
                break;

            case 2:
                return is_string($arguments[1])
                    ? [$arguments[1], $this->searchableAttributes()]
                    : [request('q'), $arguments[1]];
                break;

            case 3:
                return is_string($arguments[1])
                    ? [$arguments[1], $arguments[2]]
                    : [$arguments[2], $arguments[1]];
                break;

            default:
                return [null, []];
                break;
        }
    }

    /**
     * Get searchable columns
     *
     * @return array
     */
    public function searchableAttributes()
    {
        if (method_exists($this, 'searchable')) {
            return $this->searchable();
        }

        return property_exists($this, 'searchable') ? $this->searchable : [];
    }
}