<div class="container">
    <div class="row">
        <?php
            $data = file_get_contents('https://content.guardianapis.com/news?api-key=475211e8-39db-4922-b717-4c25b9b878fc');
            $data = json_decode($data, true);
        ?>
        <h1>News</h1>
        
        <?php
        for ($i=0; $i < count($data['response']['results']); $i++) {  ?>
        <div class="col-md-4">
            <div class="well well-lg">
                <h4><?php echo $data['response']['results'][$i]['webTitle']; ?></h4>
                <p><a class="btn btn-secondary" href="<?php echo $data['response']['results'][$i]['webUrl']; ?>" target="_blank" role="button">Read more »</a></p>
            </div>
        </div>
        <?php }
        ?>
        
    </div>
    <div class="row">
        <?php
            $data = file_get_contents('https://content.guardianapis.com/commentisfree?api-key=475211e8-39db-4922-b717-4c25b9b878fc');
            $data = json_decode($data, true);
        ?>
        <h1>Opinion</h1>
        <?php
        for ($i=0; $i < count($data['response']['results']); $i++) {  ?>
        <div class="col-md-4">
            <div class="well well-lg">
                <h4><?php echo $data['response']['results'][$i]['webTitle']; ?></h4>
                <p><a class="btn btn-secondary" href="<?php echo $data['response']['results'][$i]['webUrl']; ?>" target="_blank" role="button">Read more »</a></p>
            </div>
        </div>
        <?php }
        ?>
    </div>
    <div class="row">
        <?php
            $data = file_get_contents('https://content.guardianapis.com/culture?api-key=475211e8-39db-4922-b717-4c25b9b878fc');
            $data = json_decode($data, true);
        ?>
        <h1>Culture</h1>
        <?php
        for ($i=0; $i < count($data['response']['results']); $i++) {  ?>
        <div class="col-md-4">
            <div class="well well-lg">
                <h4><?php echo $data['response']['results'][$i]['webTitle']; ?></h4>
                <p><a class="btn btn-secondary" href="<?php echo $data['response']['results'][$i]['webUrl']; ?>" target="_blank" role="button">Read more »</a></p>
            </div>
        </div>
        <?php }
        ?>
    </div>
    <div class="row">
        <?php
            $data = file_get_contents('https://content.guardianapis.com/lifeandstyle?api-key=475211e8-39db-4922-b717-4c25b9b878fc');
            $data = json_decode($data, true);
        ?>
        <h1>Lifestyle</h1>
        <?php
        for ($i=0; $i < count($data['response']['results']); $i++) {  ?>
        <div class="col-md-4">
            <div class="well well-lg">
                <h4><?php echo $data['response']['results'][$i]['webTitle']; ?></h4>
                <p><a class="btn btn-secondary" href="<?php echo $data['response']['results'][$i]['webUrl']; ?>" target="_blank" role="button">Read more »</a></p>
            </div>
        </div>
        <?php }
        ?>
    </div>
</div>