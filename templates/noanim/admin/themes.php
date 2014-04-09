<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Theme Options</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
<?php
	foreach ($template_list as $list) {
        $template_settings = parse_ini_file("./templates/".$list.'/config.ini');
		echo '<div class="col-lg-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            '.ucfirst($template_settings['name']).'
                        </div>
                        <div class="panel-body">
                            <p><img src="'.base_url().'templates/'.$list.'/preview.png" height="100" width="100" class="img-circle" />';
                            if ($list == $current_theme) {
                            	echo '<button type="button" class="btn btn-success pull-right" disabled>Current Theme</button>';
                            }
                            else echo '<a class="btn btn-outline btn-success pull-right" href="settheme/'.$list.'">Set Theme</a>';
                            echo '</p>
                        </div>
                        <div class="panel-footer">
                            By '.ucfirst($template_settings['author']).'
                        </div>
                    </div>
                </div>';
	}
?>
</div>