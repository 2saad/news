<div class="container">
<?php
	$section = $break[1];
	if (strpos($section, 'search') !== false) {
		echo '<input type="hidden" id="section" value="search">';
		$data = file_get_contents('https://content.guardianapis.com/search?q='. $_REQUEST['q'] .'&api-key=475211e8-39db-4922-b717-4c25b9b878fc');
		$data = json_decode($data, true);
		echo '<div class="row content_row">';
		echo '<h1>Search result</h1>';
		for ($i=0; $i < count($data['response']['results']); $i++) { ?>
		<div class="col-md-4">
			<div class="well well-lg">
	            <h4><?php echo $data['response']['results'][$i]['webTitle']; ?></h4>
	            <p><a class="btn btn-secondary" href="<?php echo $data['response']['results'][$i]['webUrl']; ?>" target="_blank" role="button">Read more »</a></p>
        	</div>
        </div>
		<?php }
		echo '</div>';
	}else{
		echo '<input type="hidden" id="section" value="'.$section.'">';
		$data = file_get_contents('https://content.guardianapis.com/'. $section .'?api-key=475211e8-39db-4922-b717-4c25b9b878fc');
		$data = json_decode($data, true);
		echo '<div class="row content_row">';
		echo '<h1>'. $data['response']['section']['webTitle'] .'</h1>';
		for ($i=0; $i < count($data['response']['results']); $i++) { ?>
		<div class="col-md-4">
			<div class="well well-lg">
	            <h4><?php echo $data['response']['results'][$i]['webTitle']; ?></h4>
	            <p><a class="btn btn-secondary" href="<?php echo $data['response']['results'][$i]['webUrl']; ?>" target="_blank" role="button">Read more »</a></p>
        	</div>
        </div>
		<?php }
		echo '</div>';
		      
		    
		
	}
	if ($data['response']['pages'] > 10) {
	
?>
<div class="row">
  <div class="col-sm-12">
    <div class="text-center">
      <button class="btn btn-primary" id="load_more_button" onclick="load_more_content();">Show more</button>
    </div>
  </div>
</div>
<?php } ?>
</div>
<input type="hidden" id="page" value="2">