<?php
use miloschuman\highcharts\Highcharts;
$this->title = Yii::t('app','Statistics');
?>
<div class="row">
<div class="col-md-6">
<?php

echo Highcharts::widget([
    'options' => [
        'chart' =>[
            'type' => 'pie'
        ],
        'title' => ['text' => Yii::t('app','Icsrs In Drugs')],

        'plotOptions' => [

            'pie' => [
                'dataLabels' => [
                    'enabled' => true,
                    'format' => '<b>{point.name}</b>: {point.percentage:.1f} %'
                ]
            ]
        ],
        'series' => [
            ['name' => 'Icsrs',
                'data' => $drugsWithIcsrs
            ],

        ]
    ]
]);
?>
</div>


<div class="col-md-6">
    <?php

echo Highcharts::widget([
    'options' => [
        'chart' =>[
            'type' => 'pie'
        ],
        'title' => ['text' => Yii::t('app','llt (Low Level Term) over icsrs')],

        'plotOptions' => [

            'pie' => [
                'dataLabels' => [
                    'enabled' => true,
                    'format' => '<b>{point.name}</b>: {point.percentage:.1f} %'
                ]
            ]
        ],
        'series' => [
            [
                'name' => 'Icsrs',
                'data' => $meddraLltWithIcsrs

            ],

        ]
    ]
]);
?>
</div>
</div>


<div class="row">
    <div class="col-md-6">
        <?php

        echo Highcharts::widget([
            'options' => [
                'chart' =>[
                    'type' => 'pie'
                ],
                'title' => ['text' => Yii::t('app','pt (Prefered Term) over Icsrs')],

                'plotOptions' => [

                    'pie' => [
                        'dataLabels' => [
                            'enabled' => true,
                            'format' => '<b>{point.name}</b>: {point.percentage:.1f} %'
                        ]
                    ]
                ],
                'series' => [
                    [
                        'name' => 'Icsrs',
                        'data' => $meddraPtWithIcsrs

                    ],

                ]
            ]
        ]);
        ?>

    </div>


    <div class="col-md-6">
        <?php

        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => Yii::t('app', 'Icsrs Per Month')],
                'xAxis' => [
                    'categories' =>  $icsrsPerMonth['monthNames']
                ],
                'yAxis' => [
                    'title' => ['text' => 'Icsrs Number']
                ],
                'series' => [
                    ['name' => 'Icsrs', 'data' =>$icsrsPerMonth['icsrsNumbers'] ]

                ]
            ]
        ]);
        ?>

    </div>

</div>
<hr>

<div class="row">
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading"><?= Yii::t('app','Company Summary');?></div>
    <table class="table">
        <tr>
            <th>total number of</th>
            <th><?= Yii::t('app','Users');?></th>
            <th><?= Yii::t('app','Drugs');?></th>
            <th><?= Yii::t('app','Icsrs');?></th>



        </tr>
        <tr>
            <td></td>
            <td><?=$totalUsers;?> <?= Yii::t('app','of') ?> <?= $limitsArr['user']['limit']?></td>
            <td><?=$totalDrugs;?> <?= Yii::t('app','of') ?> <?= $limitsArr['drug']['limit']?></td>
            <td><?= $totalIcsrs?></td>
        </tr>

    </table>
</div>
</div>

<hr>

<div class="row">
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading"><?= Yii::t('app','Products Important Dates');?></div>
        <table class="table">
            <tr>

                <th><?= Yii::t('app','Generic Name');?></th>
                <th><?= Yii::t('app','Trade Name');?></th>
                <th><?= Yii::t('app','Next PBRER Date');?></th>
                <th><?= Yii::t('app','RMP First Deadline');?></th>




            </tr>

            <?php foreach ($companyDrugs as $key => $obj)
            {?>
            <tr>
                <td><?= $obj->generic_name?></td>
                <td><?= $obj->trade_name?></td>
                <td><?= $obj->next_prsu_date?></td>
                <td><?= $obj->rmp_first_deadline?></td>
            </tr>
            <?php }?>

        </table>
    </div>
</div>
