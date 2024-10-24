<?php

namespace Maestro\Admin\Support\Concerns;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;

/**
 * Orquestrador de Jobs/Eventos via laravel
 */
trait Locomotive
{
    public function push(string $name, string $job) : void
    {
        $jobs = $this->jobs($name, $job);

        if ($jobs == null) return;

        $jobs->push($job);

        Cache::put($name, $jobs);
    }

    public function first(string $name, string $job)
    {
        $jobs = $this->jobs($name, $job);

        if ($jobs == null) return;

        $jobs->prepend($job);

        Cache::put($name, $jobs);
    }

    public function last(string $name, string $job)
    {
        $jobs = $this->jobs($name, $job);

        if ($jobs == null) return;

        $jobs->append($job);

        Cache::put($name, $jobs);
    }

    public function event(string $event, string $name) 
    {
        $jobs = Cache::get($name, collect([]))->toArray();

        if (empty($jobs)) return;
        
        Event::listen($event, function($v) use ($jobs) {
            try {
                foreach($jobs as $job) {
                    app($job)->handle($v);
                }
            } catch (\Throwable $th) {
                return $th;
            }
        });
    }    

    private function jobs(string $name, string $job) : ?Collection
    {
        $jobs = Cache::get($name, collect([]));                

        if ($jobs->contains($job)) {
            return null;
        }

        if (! class_exists($job)) {
            throw new \Exception("Invalid Job", 1);
        }

        return $jobs;
    }
}