<?php
echo $this->render('@bedezign/yii2/audit/views/_audit_trails', [
    // model to display audit trais for, must have a getAuditTrails() method
    'query' => $model->getIcsrTrails(),

    // which columns to show
    'columns' => ['user_id',  'action', 'field','old_value', 'new_value', 'created'],

]);
