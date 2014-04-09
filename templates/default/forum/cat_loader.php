<?php
	$query = $this->db->query('SELECT * FROM `forum_categories` ORDER BY `id` ASC');
	$cat_data = $query->result_array();

	foreach ($cat_data as $category) {
		echo '<table class="table forum remove-margin">
            <thead>
                <tr>
                    <th></th>
                    <th>'.$category['name'].'</th>
                    <th class="cell-stat text-center hidden-xs hidden-sm">Topics</th>
                    <th class="cell-stat text-center hidden-xs hidden-sm">Posts</th>
                    <th class="cell-stat-2x hidden-xs hidden-sm">Last Post</th>
                </tr>
            </thead>
            <tbody>';

        	$forumquery = $this->db->query("SELECT * FROM `forum_forums` WHERE `cat_id` = '".$category['id']."' ORDER BY `id` ASC");
			$forum_data = $forumquery->result_array(); 
			foreach ($forum_data as $forum) {
                $latestpost = $this->db->query("SELECT * FROM `forum_content` WHERE `forum_id` = ".$forum['id']." ORDER BY `id` DESC LIMIT 1");
                $latest = $latestpost->result_array();
                $postcount = $this->db->query("SELECT * FROM `forum_content` WHERE `forum_id` = ".$forum['id']);
                $topiccount = $this->db->query("SELECT * FROM `forum_posts` WHERE `forum_id` = ".$forum['id']);
				echo '<tr>
                    <td class="cell-small text-center"><i class="fa-folder fa-2x fa"></i></td>
                    <td>
                        <h4><a href="'.base_url().'forum/viewforum/'.$forum['id'].'">'.$forum['name'].'</a> <br><small>'.$forum['description'].'</small></h4>
                    </td>
                    <td class="text-center hidden-xs hidden-sm"><a href="'.base_url().'forum/viewforum/'.$forum['id'].'">'.$topiccount->num_rows().'</a></td>
                    <td class="text-center hidden-xs hidden-sm"><a href="'.base_url().'forum/viewforum/'.$forum['id'].'">'.$postcount->num_rows().'</a></td>
                    
                    <td class="hidden-xs hidden-sm">by <a href="'.base_url().'ucp/viewuser/'.$latest[0]['author'].'">'.$latest[0]['author'].'</a><br><small><a href="'.base_url().'forum/viewtopic/'.$latest[0]['id'].'">View Post</a></small></td>
                </tr>';
			}
		echo '</tbody>
        </table>';
	}
?>

