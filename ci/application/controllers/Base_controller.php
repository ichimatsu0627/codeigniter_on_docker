<?php

/**
 * Class Base_controller
 *
 * ---- CI_Class ----
 * @property CI_Session       $session
 */
class Base_controller extends CI_Controller
{
    public $view = [];

    public $controller_name;
    public $action_name;

    /**
     * Base_controller constructor.
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->load_db();
        $this->load_libraries();
        $this->set_uri();
    }

    /**
     * DB設定読み込み
     */
    private function load_db()
    {
        $this->db = $this->load->database("db", TRUE);
    }

    /**
     * ライブラリ読み込み
     */
    private function load_libraries()
    {
        $this->load->library("layout");
    }

    /**
     * URI設定
     */
    private function set_uri()
    {
        $RTR                   =& load_class('Router', 'core');
        $this->controller_name =  $RTR->fetch_class();
        $this->action_name     =  $RTR->fetch_method();
    }

    /**
     * リダイレクト
     * @param string $path
     */
    public function _redirect($path)
    {
        header("Location:".SITE_URL.$path);
        exit;        
    }
}
