<?php
use backend\assets\BrowseAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

BrowseAsset::register($this);
$directoryAsset = Yii::$app->request->baseUrl;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body ontouchstart="">
	<div id="header">
		<h1>Uploaded Image Explorer</h1>
	</div>
	<div id="editbar">
		<div id="editbarView" onclick="#" class="editbarDiv"><img src="img/cd-icon-images.png" class="editbarIcon editbarIconLeft"><p class="editbarText">View</p></div>
		<a href="#" id="editbarDownload" download><div class="editbarDiv"><img src="img/cd-icon-download.png" class="editbarIcon editbarIconLeft"><p class="editbarText">Download</p></div></a>
		<div id="editbarUse" onclick="#" class="editbarDiv"><img src="img/cd-icon-use.png" class="editbarIcon editbarIconLeft"><p class="editbarText">Use</p></div>
		<div id="editbarDelete" onclick="#" class="editbarDiv"><img src="img/cd-icon-qtrash.png" class="editbarIcon editbarIconLeft"><p class="editbarText">Delete</p></div>
		<img onclick="hideEditBar();" src="img/cd-icon-close-black.png" class="editbarIcon editbarIconRight">
	</div>
	<div id="updates" class="popout"></div>
    
	<div id="dropzone" class="dropzone" ondragenter="return false;" ondragover="return false;" ondrop="drop(event)">
		<p>
			<img src="img/cd-icon-upload-big.png"><br>
				Drop your files here
		</p>
	</div>
<?php $this->beginBody() ?>

    <?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
