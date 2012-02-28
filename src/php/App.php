<?php
use PAGI\Application\PAGIApplication;

class App extends PAGIApplication
{
    private $hangup = false;

    public function init()
    {
        $agi = $this->getAgi();
        $agi->answer();
    }

    public function shutdown()
    {
        // This is to avoid a double hangup
        if (!$this->hangup) {
            $agi = $this->getAgi();
            $agi->hangup();
            $this->hangup = true;
        }
    }

    public function run()
    {
        $agi = $this->getAgi();
        $clid = $agi->getCallerId();
        $number = $clid->getNumber();
        if ($number == 'anonymous') {
            $agi->streamFile("i-cant-find-your-number");
        } else {
            $agi->streamFile("you-are-calling-from");
            $agi->sayDigits($number);
        }
        $agi->streamFile("bye");
    }

    public function errorHandler($type, $msg, $file, $line)
    {
    }

    public function signalHandler($signal)
    {
    }
}
