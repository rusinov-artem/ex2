<?php


namespace Rusinov\Ex2\LogSystem;


use Monolog\Handler\AbstractHandler;

class LogHandler extends AbstractHandler
{

    /**
     * Handles a record.
     *
     * All records may be passed to this method, and the handler should discard
     * those that it does not want to handle.
     *
     * The return value of this function controls the bubbling process of the handler stack.
     * Unless the bubbling is interrupted (by returning true), the Logger class will keep on
     * calling further handlers in the stack with a given log record.
     *
     * @param array $record The record to handle
     * @return bool true means that this handler handled the record, and that bubbling is not permitted.
     *                        false means the record was either not processed or that this handler allows bubbling.
     */
    public function handle(array $record)
    {
        $action = $this->route($record);

        if($action){
            $this->run($action, $record);
        }

    }

    private function getRouts()
    {
        $routs = [];
        $routs[] = function(array $record)
        {

          if(in_array('system', $record['context']))
          {
                return [new Controller(), 'system'];
          }

        };

        return $routs;
    }

    private function route(array $record)
    {
        $routs = $this->getRouts();
        foreach ($routs as $rout)
        {
            if($result = $rout($record))
            {
                return $result;
            }
        }
        return false;
    }

    private function run($action, $record)
    {
        $action($record);
    }



}