<?php

namespace Maestro\Admin\Support\Concerns;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;

/**
 * Orquestrador de Jobs/Eventos via laravel.
 * @todo Verificar a possibilidade desse trait ser apenas
 * uma função chamada locomotive(), onde retorna uma instância
 * para uma classe onde retorna as regras de negócio. 
 * 
 * ex: locomotive()->push('minha-fila', MeuJob::class);
 */
trait Locomotive
{
    /**
     * Insere um novo job para uma determinada fila.
     *
     * @param string $queue
     * @param string $job
     * @return void
     */
    public function push(string $queue, string $job) : void
    {
        $jobs = $this->jobs($queue, $job);

        if ($jobs == null) return;

        $jobs->push($job);

        Cache::put($queue, $jobs);
    }

    /**
     * Insere um novo serviço em uma fila no ínicio como primeiro
     * item da fila. 
     *
     * @param string $queue
     * @param string $job
     * @return void
     */
    public function first(string $queue, string $job)
    {
        $jobs = $this->jobs($queue, $job);

        if ($jobs == null) return;

        $jobs->prepend($job);

        Cache::put($queue, $jobs);
    }

    /**
     * Insere um novo job no final da fila. 
     *
     * @param string $name
     * @param string $job
     * @return void
     */
    public function last(string $name, string $job)
    {
        $jobs = $this->jobs($name, $job);

        if ($jobs == null) return;

        $jobs->append($job);

        Cache::put($name, $jobs);
    }

    public function event(string $queue, mixed $params) 
    {
        $jobs = Cache::get($queue, collect([]))->toArray();

        if (empty($jobs)) return;

        $this->runJobs($jobs, $params);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function runJobs(array $jobs, mixed $params)
    {
        foreach($jobs as $job) {

            $listener = app($job);

            $listener->handle($params);
        }        
    }

    /**
     * Limpa os jobs de uma determinada fila. 
     *
     * @param string $queue
     * @return void
     */
    public function clear(string $queue)
    {
        return Cache::forget($queue);
    }

    /**
     * Undocumented function
     *
     * @param string $name
     * @param string $job
     * @return Collection|null
     */
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