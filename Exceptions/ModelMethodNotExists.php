<?php

namespace Maestro\Admin\Exceptions;

class ModelMethodNotExists extends BaseException
{
    const CODE = 'ADMEXC02';

    /**
     * Define as configuração para enviar o exception
     *
     * @param string $name
     */
    public function __construct($obj)
    {
        $class = get_class($obj);

        $this->initialize($class);
    }

    /**
     * {@inheritDoc}
     */
    public function getErrorMessage(): string
    {
        return "The given [%s] object doesn't have the 'model' method implemented";
    }

    /**
     * {@inheritDoc}
     */
    public function getErrorCode(): string
    {
        return self::CODE;
    }
}