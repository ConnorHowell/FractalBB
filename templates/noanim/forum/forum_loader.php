<?php
	$query = $this->db->query("SELECT * FROM `forum_posts` WHERE `forum_id` ='".$slug."' ORDER BY `id` ASC");
	$post_data = $query->result_array();

	foreach ($post_data as $post) {
        $postcount = $this->db->query("SELECT * FROM `forum_content` WHERE `topic_id` = ".$post['id']);
		if ($post['pinned'] == 1) {
            echo '<tr class="active">
                    <td class="text-center cell-small sticky"><i class="fa fa-exclamation fa-2x"></i></td>
                    <td>
                        <h4><a href="'.base_url().'forum/viewtopic/'.$post['id'].'">'.$post['name'].'</a> <br><small>by <a href="'.base_url().'ucp/viewuser/'.$post['author'].'">'.$post['author'].'</a>, '.$post['timestamp'].'</small></h4>
                    </td>
                    <td class="text-center hidden-xs hidden-sm"><a href="javascript:void(0)">'.$postcount->num_rows().'</a></td>
                    <td class="text-center hidden-xs hidden-sm"><a href="javascript:void(0)">'.$post['views'].'</a></td>
                </tr>';
        }
        else echo '<tr>
                    <td colspan="2">
                        <h4><a href="'.base_url().'forum/viewtopic/'.$post['id'].'">'.$post['name'].'</a> <br><small>by <a href="'.base_url().'ucp/viewuser/'.$post['author'].'">'.$post['author'].'</a>, '.$post['timestamp'].'</small></h4>
                    </td>
                    <td class="text-center hidden-xs hidden-sm"><a href="javascript:void(0)">'.$postcount->num_rows().'</a></td>
                    <td class="text-center hidden-xs hidden-sm"><a href="javascript:void(0)">'.$post['views'].'</a></td>
                </tr>';
	}
?>

