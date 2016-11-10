<?
use yii\bootstrap\Modal;
?>
<?
Modal::begin([
    'header' => '<h2>Выбор города</h2>',
    'options' => [
        'tabindex' => false,
        'id' => 'geo-modal',
        'style' => 'z-index: 1050;'
    ]
]);
    echo $this->render('modal-content');
Modal::end();
?>