<!DOCTYPE html>
<!--コメント!-->
<html>
<head>

<script src="lib/jquery/jquery.min.js"></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js'></script>
<script src="lib/bootstrap/js/bootstrap.min.js"></script>
<script src="lib/slicknav/dist/jquery.slicknav.js"></script>

<link rel="stylesheet" href="lib/slicknav/dist/slicknav.css">
<link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css" >
<link rel="stylesheet" href="lib/bootstrap/css/bootstrap-theme.min.css">
<link rel="stylesheet" media="all" type="text/css" href="style/index.css">
<!-- ※デフォルトのスタイル（style.css） -->
<link rel="stylesheet" media="all" type="text/css" href="style/style.css" />
<!-- ※タブレット用のスタイル（tablet.css） -->
<link rel="stylesheet" media="all" type="text/css" href="style/tablet.css" />
<!-- ※スマートフォン用のスタイル（smart.css） -->
<link rel="stylesheet" media="all" type="text/css" href="style/smart.css" />

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,user-scalable=no,maximum-scale=1" />

<title>サッカー情報まとめ</title>
</head>
<body
  <!--スマホ用!-->
  <ul id="menu" >
      <li><a href="#">更新順</a></li>
      <li><a href="react.php">海外の反応</a></li>
      <li>サイト一覧
          <ul class="site">
          </ul>
      </li>
  </ul>

<!--pc用!-->
<nav class="navbar navbar-default navbar-fixed-top navbar-inverse pc" id="pc">
  	<div class="container-fluid">
  		<div class="navbar-header">
  			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarEexample7">
  				<span class="sr-only">Toggle navigation</span>
  				<span class="icon-bar"></span>
  				<span class="icon-bar"></span>
  				<span class="icon-bar"></span>
  			</button>
  		</div>

  		<div class="collapse navbar-collapse" id="navbarEexample7">
  			<ul class="nav navbar-nav">
  				<li class="active"><a href="index.php">TOP</a></li>
  			<li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle">サイト一覧▼</a>
          <ul class="dropdown-menu site" role="menu">
		      </ul>
        </li>
  				<li><a href="#">更新順</a></li>
          <li><a href="react.php">海外の反応</a></li>
          <li><a href="#">サイトについて</a></li>
  			</ul>
  		</div>
  	</div>
</nav>
  <div class="container">
  <div id="hometilte"><h2>サッカー情報まとめ</h2></div>

<?php
//サイト情報をまとめて取得
$rssList = array(
    'http://worldfn.net/index.rdf',
    'http://samuraigoal.doorblog.jp/index.rdf',
    'http://www.calciomatome.net/index.rdf',
    'http://blog.livedoor.jp/footcalcio/index.rdf',
    'http://nofootynolife.blog.fc2.com/?xml',
    'http://footballnet.2chblog.jp/index.rdf',
    'http://samuraisoccer.doorblog.jp/index.rdf',
    'http://football-2ch.com/index.rdf',
    'http://sakarabo.blog.jp/index.rdf',
    'http://iroyaku.livedoor.biz/index.rdf',
    'http://jleaguematome.blog.fc2.com/?xml',
    'http://blog.livedoor.jp/soccerkusoyarou/index.rdf',
    'http://world-samurai.com/index.rdf',
    'http://blog.livedoor.jp/aushio/index.rdf',
);

for ($n = 0;$n < count($rssList);++$n) {
    $rssdata = simplexml_load_file("$rssList[$n]");
    $namae = $rssdata->channel->title;
    $home = $rssdata->channel->link;
    $js[] = $namae;
    echo '<div class="panel panel-default"><a target="_blank" class="panel-default" id="'.$namae.'" href="'.$home.'"><div class="panel-heading">'.$namae.'</div></a>';
    echo '<div class="listgroup">';
    $i = 0;
    foreach ($rssdata->item as $item) {
        //5記事ずつ表示
      if ($i < 5) {
          $title = $item->title;
          $date = date('n/j/H:i', strtotime($item->children('http://purl.org/dc/elements/1.1/')->date));
          $link = $item->link;
          $description = mb_strimwidth(strip_tags($item->description), 0, 110, '…Read More', 'utf-8');
          echo '<a target="_blank" class="list-group-item" href="'.$link.'" target="_blank><span class="date pull-left">'.$date.'</span><br><span class="title">'.$title.'</span></a>';
          ++$i;
      }
    }
    echo '</div></div>';
}

?>

</div>
</body>
<script test.php>
</script>
<script type="text/javascript">
$(document).ready(function(){
	$('#menu').slicknav();
});
var array = <?php echo json_encode($js, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
for (var i=0;i<array.length;i++){
  $(".site").append('<li role="presentation"><a href="#'+array[i][0]+'">'+array[i][0]+'</a></li>')
}
</script>
</html>
