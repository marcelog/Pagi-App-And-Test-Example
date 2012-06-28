<?php
use PAGI\Application\PAGIApplication;

class App extends PAGIApplication
{
    private $hangup = false;
    private $agi;
    private $asteriskLogger = null;

    public function init()
    {
        $this->agi = $this->getAgi();
        $this->agi->answer();
        $this->logger->info('Init');
        $this->asteriskLogger = $this->agi->getAsteriskLogger();  
        $this->asteriskLogger->notice('Init');
    }

    public function shutdown()
    {
        if ($this->asteriskLogger !== null) {
            $this->asteriskLogger->notice('Shutdown');
        }
        $this->logger->info("Shutdown");
        // This is to avoid a double hangup
        if (!$this->hangup) {
            $this->agi->hangup();
            $this->hangup = true;
        }
    }

    public function run()
    {
        $this->asteriskLogger->notice("Run");  
        $this->logger->info("Run"); 
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
        if ($this->asteriskLogger !== null) {
            $this->asteriskLogger->error("$message at $file:$line");
        }
        $this->logger->error("$message at $file:$line");
    }

    public function signalHandler($signal)
    {
        if ($this->asteriskLogger !== null) {
            $this->asteriskLogger->notice("Got signal: $signal");
        }
        $this->logger->info("Got signal: $signal");
        exit(0);
    }
}
