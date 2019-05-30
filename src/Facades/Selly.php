<?php
namespace McCaulay\Selly\Facades;

use Illuminate\Support\Facades\Facade;

class Selly extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'selly';
    }
}
