<?php
    $base = 'https://programlab.tech/news/';
    $url=$_SERVER['REQUEST_URI'];
    $break = explode ( "news/", $url );
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <style type="text/css">
        .dropdown-menu.columns-3 {
            min-width: 700px;
        }
        * {
        margin: 0;
        padding: 0;
        font-family: 'Abel', sans-serif;
    }
    .dropdown-menu li a {
        padding: 5px 15px;
        font-weight: 300;
    }
    .multi-column-dropdown {
        list-style: none;
    }
    .multi-column-dropdown li a {
        display: block;
        clear: both;
        line-height: 1.428571429;
        color: #333;
        white-space: normal;
    }
    .multi-column-dropdown li a:hover {
        text-decoration: none;
        color: #262626;
        background-color: #f5f5f5;
    }
     
    @media (max-width: 767px) {
        .dropdown-menu.multi-column {
            min-width: 240px !important;
            overflow-x: hidden;
        }
    }



    </style>
    <title>News</title>
</head>
<body>   
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
        </div>
        <!--/.navbar-header-->
        <?php
        $data = file_get_contents('https://content.guardianapis.com/sections?api-key=475211e8-39db-4922-b717-4c25b9b878fc');
        $data = json_decode($data, true);
        ?>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo $base; ?>">Home</a></li>
                <li><a href="<?php echo $base; ?>commentisfree">Opinion</a></li>
                <li><a href="<?php echo $base; ?>culture">Culture</a></li>
                <li><a href="<?php echo $base; ?>lifeandstyle">Lifestyle</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">More ❯<b class="caret"></b></a>
                    <ul class="dropdown-menu multi-column columns-3">
                        <div class="row">
                        <?php
                            $x = 0;
                            for ($i=0; $i < 6; $i++) { 
                                echo '<div class="col-sm-2">';
                                    echo '<ul class="multi-column-dropdown">';
                                    for ($j=$x; $j < count($data['response']['results']); $j++) { 
                                        echo '<li><a href="'.$base.$data['response']['results'][$j]['id'].'">'.$data['response']['results'][$j]['webTitle'].'</a></li>';
                                        if ($j != 0 && $j % ceil(count($data['response']['results']) / 6) == 0) {
                                            $x++;
                                            break;
                                        }else{
                                            $x++;
                                        }

                                    }
                                    echo '</ul>';
                                echo '</div>';
                            }
                        ?>
                            
                        </div>
                    </ul>
                </li>

                
            </ul>
            <form class="navbar-form navbar-left" action="<?php echo $base ?>search">
                <div class="form-group">
                    <input name="q" id="q" type="text" class="form-control" placeholder="Search" value="<?php echo (strpos($break[1], 'search') !== false ? $_REQUEST['q'] : ''); ?>">
                </div>
                <button type="submit" class="btn btn-default">Search</button>
            </form>
        </div>
        <!--/.navbar-collapse-->



    </nav>
    <?php
        if ($break[1] == '') {
            include ( "home.php" );
        }else{
            include ( "sections.php" );
        }

        
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
    <script>
        function load_more_content(){
            if($('#section').val() == 'search'){
                $.get("https://content.guardianapis.com/search?q="+$('#q').val()+"&api-key=475211e8-39db-4922-b717-4c25b9b878fc&page="+$('#page').val(), function(data){
                    var html = '';
                    if(data.response.results.length > 0){
                        for (var i = 0; i < data.response.results.length; i++) {
                            html += '<div class="col-md-4"><div class="well well-lg">';
                            html += '<h4>' + data.response.results[i].webTitle + '</h4>';
                            html += '<p><a class="btn btn-secondary" href="' + data.response.results[i].webUrl + '" target="_blank" role="button">Read more »</a></p>';
                            html += '</div></div>';
                        }
                        $(".content_row").append(html);
                        $('#page').val(parseInt($('#page').val()) + 1);
                        if(data.response.pages == data.response.currentPage){
                            $('#load_more_button').hide();
                        }
                    }

                });
            }else{
                $.get("https://content.guardianapis.com/"+$('#section').val()+"?api-key=475211e8-39db-4922-b717-4c25b9b878fc&page="+$('#page').val(), function(data){
                    var html = '';
                    if(data.response.results.length > 0){
                        for (var i = 0; i < data.response.results.length; i++) {
                            html += '<div class="col-md-4"><div class="well well-lg">';
                            html += '<h4>' + data.response.results[i].webTitle + '</h4>';
                            html += '<p><a class="btn btn-secondary" href="' + data.response.results[i].webUrl + '" target="_blank" role="button">Read more »</a></p>';
                            html += '</div></div>';
                        }
                        $(".content_row").append(html);
                        $('#page').val(parseInt($('#page').val()) + 1);
                        if(data.response.pages == data.response.currentPage){
                            $('#load_more_button').hide();
                        }
                    }

                });
            }
        }
    </script>
</body>
</html>



