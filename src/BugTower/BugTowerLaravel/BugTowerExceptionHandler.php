<?php namespace BugTower\BugTowerLaravel;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class BugTowerExceptionHandler extends ExceptionHandler {
    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, BugTower, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        $shouldReport = true;
        foreach ($this->dontReport as $type)
        {
            if ($e instanceof $type)
                return parent::report($e);
        }

        global $app;
        $BugTower = $app['BugTower'];

        if ($BugTower) {
            $BugTower->notifyException($e, null, "error");
        }
        return parent::report($e);
    }
}
