<?php
final class Index{
    //constants
    const PAGE_DIR = '../page/';
    const LAYOUT_DIR = '../layout/';
    const DEFAULT_PAGE = 'home';
    
   
    public function init(){
        session_start();
        set_exception_handler(array($this,'handleException'));
        spl_autoload_register(array($this, 'loadClass'));
    }
    
    /**
     * Class loader.
     */
    public function loadClass($name) {
        $classes = array(
            'Config' => '../config/config.php',
            'Error' => '../validation/error.php',
            'Flash' => '../flash/flash.php',
            'NotFoundException' => '../exception/notFoundException.php',
            'FlightBookingDao' => '../dao/flightBookingDao.php',
            'FlightBookingMapper' => '../mapping/flightBookingMapper.php',
            'FlightBooking' => '../model/flightBooking.php',
//            'TodoSearchCriteria' => '../dao/TodoSearchCriteria.php',
            'FlightBookingValidator' => '../validation/flightBookingValidator.php',
            'Utils' => '../util/utils.php'
        );
        if (!array_key_exists($name, $classes)) {
            die('Class "' . $name . '" not found.');
        }
        require_once $classes[$name];
    }
    
    private function handleException(Exception $ex){
        $extra = array('message' => $ex->getMessage());
        if($ex instanceof NotFoundException){
            header('HTTP/1.0 404 Not Found');

            $this->runPage('404',$extra);
        }else{
            header('HTTP/1.0 500 Internal Server Error');
            $this->runPage('500',$extra);
        }
    }
    
    public function run(){
        $this->runPage($this->getPage());
    }
    
    private function runPage($page, array $extra = array()){
        $run = false;
        if($this->hasScript($page)){
            $run = true;
            require $this->getScript($page);
        }
        if($this->hasTemplate($page)){
            $run = true;
            //required in layout/index.php
            $template = $this->getTemplate($page);
            //init flashes
            $flashes = null;
            if (Flash::hasFlashes()) {
                $flashes = Flash::getFlashes();
            }
            require self::LAYOUT_DIR.'index.php';
        }
        if(!$run){
            die('Page '.$page.' has neither script nor template!');
        }
    }
    
    private function getPage(){
        $page = self::DEFAULT_PAGE;
        if(array_key_exists('page', $_GET)){
            $page = $_GET['page'];
        }
        return $this->checkPage($page);
    }
    
    private function checkPage($page){
        if (!preg_match('/^[a-z0-9-]+$/i', $page)) {
            // TODO log attempt, redirect attacker, ...
            throw new NotFoundException('Unsafe page "' . $page . '" requested');
        }
        if (!$this->hasScript($page) && !$this->hasTemplate($page)) {
            // TODO log attempt, redirect attacker, ...
            throw new NotFoundException('Page "' . $page . '" not found');
        }
        return $page;
    }
    
    private function hasScript($page){
        return file_exists($this->getScript($page));
    }
    
    private function hasTemplate($page){
        return file_exists($this->getTemplate($page));
    }
    
    private function getScript($page){       
        return self::PAGE_DIR.$page.'-script.php';
    }
    
    private function getTemplate($page){
       return self::PAGE_DIR.$page.'-view.php';
    }
}
$index = new Index();
$index->init();
$index->run();
        