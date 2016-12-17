<?php
use miloschuman\highcharts\Highcharts;


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


echo Highcharts::widget([
    'options' => [
        'chart' =>[
            'type' => 'pie'
        ],
        'title' => ['text' => Yii::t('app','llt (Low Level Term)')],

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
