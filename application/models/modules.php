<?php
class Modules extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function loadSideBar()
    {
        $module_dir = directory_map('./modules/sidebar/', 1);
        foreach ($module_dir as $modules) {
            if (file_exists("./modules/sidebar/".$modules."/enabled.fractalbb")) {
                $return .= $this->load->view('../../modules/sidebar/'.$modules.'/main', '', true);
            }
        }
        return $return;
    }

    function generateUCPLinks()
    {
        $module_dir = directory_map('./modules/ucp/', 1);
        foreach ($module_dir as $modules) {
            $module_config = parse_ini_file("./modules/ucp/".$modules."/config.ini");
            if (file_exists("./modules/ucp/".$modules."/enabled.fractalbb")) {
                $return .= '<li><a href="'.base_url().'ucp/module/'.$module_config['url_name'].'"><i class="fa fa-'.$module_config['icon'].'"></i> '.$module_config['name'].'</a></li>';
            }
        }
        return $return;
    }
}