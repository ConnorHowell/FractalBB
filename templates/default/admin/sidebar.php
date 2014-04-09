<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Sidebar Modules</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
<?php
	foreach ($module_list as $list) {
        $module_config = parse_ini_file("./modules/sidebar/".$list."/config.ini");
		echo '<div class="col-lg-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            '.ucfirst($module_config['name']).' by '.ucfirst($module_config['author']).'
                        </div>
                        <div class="panel-body">
                            <p>'.$module_config['description'].'<br><hr>';
                            if (file_exists("./modules/sidebar/".$list."/enabled.fractalbb")) {
                            	echo '<a href="disable_side_module/'.$module_config['url_name'].'" class="btn btn-outline btn-danger">Disable</a>';
                            }
                            else echo '<a class="btn btn-outline btn-success" href="enable_side_module/'.$module_config['url_name'].'">Enable Module</a>';
                            echo '</p>
                        </div>
                    </div>
                </div>';
	}
?>
</div>