<?php

/** @var yii\web\View $this */

/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => '@web/favicon.ico']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => '<img style="border-radius:20px;" src="images/logo.jpg" class="img-responsive"/>Неоновый дом',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'О нас', 'url' => ['/site/index']],
            ['label' => 'Каталог', 'url' => ['/products']],
            ['label' => 'Где нас найти', 'url' => ['/site/contact']],
            ['label' => 'Корзина', 'url' => ['/basket/index'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => 'Заказы', 'url' => ['/order/index'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => 'Регистрация', 'url' => ['/site/register'], 'visible' => Yii::$app->user->isGuest],
            Yii::$app->user->isGuest
                ? ['label' => 'Авторизация', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                . Html::beginForm(['/site/logout'])
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'nav-link btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div style="font-size:20px;margin-top:30px" class="col-md-6 text-center text-md-start">&copy; Неоновый дом <?= date('Y') ?></div>
            <img style="width:400px; height: 100px;" src="images/ikonki.png" alt="">
           
        </div>
    </div>
</footer>
<style>
 
</style>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
