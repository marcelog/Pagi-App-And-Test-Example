<?php
use PAGI\Application\PAGIApplication;

class App extends PAGIApplication
{
    private $hangup = false;
    private $agi;

    public function init()
    {
        $this->agi = $this->getAgi();
        $this->agi->answer();
    }

    public function shutdown()
    {
        // This is to avoid a double hangup
        if (!$this->hangup) {
            $this->agi->hangup();
            $this->hangup = true;
        }
    }

    public function run()
    {
        $clid = $this->agi->getCallerId();
        $number = $clid->getNumber();
        if ($number == 'anonymous') {
            $this->play("i-cant-find-your-number");
        } else {
            $this->play("you-are-calling-from");
            $this->agi->sayDigits($number);
        }
        $this->play("bye");
    }

    private function play($sound)
    {
        $this->agi->streamFile(SOUNDS_PATH . "/$sound");
    }

    public function errorHandler($type, $msg, $file, $line)
    {
    }

    public function signalHandler($signal)
    {
    }
}
