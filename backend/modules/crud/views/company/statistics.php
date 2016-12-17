<?php
use miloschuman\highcharts\Highcharts;

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
