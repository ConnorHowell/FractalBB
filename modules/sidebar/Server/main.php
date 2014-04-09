<?php
$query = new SampQuery($this->config->item('server_ip'), $this->config->item('server_port')); 
$info = $query->getInfo();
$ping = $query->getPing()
?>
<div class="well">
    <h4>Server Statistics</h4>
    <p>Name: <?php echo $info['hostname']; ?><br>
    Players: <?php echo $info['players']; ?> / <?php echo $info['maxplayers']; ?><br>
    Gamemode: <?php echo $info['gamemode']; ?><br>
    Map: <?php echo $info['map']; ?><br>
    Ping: <?php echo $ping; ?>
    </p>
</div>