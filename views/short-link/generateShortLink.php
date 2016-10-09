<?php
use yii\bootstrap\ActiveForm;
use app\models\widgets\AjaxSubmitButton;

$form = ActiveForm::begin([
    'id' => 'url-generate-form',
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'template' => "<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
    ],
]); ?>

<?= $form->field($oModel, 'sUrl')->textInput(['autofocus' => true]) ?>


<div class="form-group">
    <div class="col-lg-12">
        <?php
        AjaxSubmitButton::begin([
            'label' => 'Shorten Link',
            'ajaxOptions' =>
                [
                    'type' => 'POST',
                    'cache' => false,
                    'beforeSend' => new \yii\web\JsExpression('function( xhr ) {
                                return true;
                            }'),
                    'success' => new \yii\web\JsExpression('function(html){
                                if (html["status"] =="error"){
                                var messages=html["messages"]
                                    jQuery.each(messages, function(i, val) {
                                        $("div.field-"+i).addClass("has-error");
                                        $("div.field-"+i).removeClass("has-success");
                                        $("div.field-"+i).find("p.help-block").html(messages[i][0]);
                                    });
                                }else{
                                $("#shortlinkform-surl").val(html);
                                 $("#shortlinkform-surl").select();
                                }
                            }'),
                ],
            'options' => ['type' => 'submit', 'class' => 'btn btn-primary'],
        ]);
        AjaxSubmitButton::end();
        ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
