<?php
/** @var string $active */

use yii\helpers\Url;

$tabs = [
    'common' => [
        'href' => Url::to(['/advertising']),
        'title' => 'Реклама'
    ],
    'banners' => [
        'href' => Url::to(['/advertising/banners']),
        'title' => 'Баннера'
    ],
    'pop-ups' => [
        'href' => '#',
        'title' => 'Pop-ups'
    ],
    'branding' => [
        'href' => '#',
        'title' => 'Брендирование'
    ],
    'ticker' => [
        'href' => Url::to(['/advertising/ticker']),
        'title' => 'Бегущая строка'
    ],
    'links' => [
        'href' => '#',
        'title' => 'Cсылки'
    ]

];

?>
<ul class="nav nav-tabs">
    <?php foreach ($tabs as $key => $tab): ?>
        <li <?php if($key == $active):?> class="active" <?php endif; ?>>
            <a href="<?= $tab['href'] ?>"><?= $tab['title'] ?></a>
        </li>
    <?php endforeach; ?>
</ul>
