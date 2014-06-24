<?php
class Modules extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function loadSideBar()
    {
        $module_dir = directory_map('./modules/sidebar/', 1); //Map the modules directory
        foreach ($module_dir as $modules) {
            if (file_exists("./modules/sidebar/".$modules."/enabled.fractalbb")) { //If the module has the 'enabled.fractalbb' it means it's loaded
                $return .= $this->load->view('../../modules/sidebar/'.$modules.'/main', '', true); //Add the contents of the 'main' file to the variable 'return'
            }
        }
        return $return;
    }

    function generateUCPLinks()
    {
        $module_dir = directory_map('./modules/ucp/', 1); //Map the UCP module directory
        foreach ($module_dir as $modules) {
            $module_config = parse_ini_file("./modules/ucp/".$modules."/config.ini"); //Parse the INI file to check the details of the module
            if (file_exists("./modules/ucp/".$modules."/enabled.fractalbb")) { //If it's enabled
                $return .= '<li><a href="'.base_url().'ucp/module/'.$module_config['url_name'].'"><i class="fa fa-'.$module_config['icon'].'"></i> '.$module_config['name'].'</a></li>'; //Add the list item to the return buffer to generate a list of enabled modules
            }
        }
        return $return;
    }
}