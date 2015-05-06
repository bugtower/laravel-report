<?php namespace BugTower\BugTowerLaravel;

use Illuminate\Support\Facades\Facade;

class BugTowerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'BugTower';
    }
}
