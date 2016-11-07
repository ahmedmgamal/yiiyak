<?php
use yii\helpers\Url;

?>
<h3> please follow this link to reset your password   <a href="<?= Url::to(['site/reset-password','token' => $user->password_reset_token],true);?>"> Click Here</a> </h3>

<br>