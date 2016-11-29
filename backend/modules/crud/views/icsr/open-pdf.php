
<table border="1">
    <tr>
        <th><?= Yii::t('app','Element');?></th>
        <th><?= Yii::t('app','Title');?></th>
        <th><?= Yii::t('app','Value');?></th>
    </tr>
<tr>

<?php
$htmlString = '';
function loopRec ($obj,$e2pLkp)
{
   global  $htmlString;

    foreach ($obj as $key => $value)
    {

     $htmlString .= '<tr>';
     $htmlString .= "<td>{$e2pLkp[$key]['element']} </td>";
     $htmlString .= "<td>{$e2pLkp[$key]['title']} </td>";

        if (is_object($value))
        {
            $htmlString .= '<td> </td></tr>';
            loopRec($value,$e2pLkp);
        }
     else
     {
         $htmlString.= "<td>{$value}</td></tr>";

     }
    }

    return $htmlString;
}
foreach ($xml as $key => $tag)
{
?>
    <tr>
        <td><?= $e2pLkp[$key]['element']?></td>
        <td><?= $e2pLkp[$key]['title']?></td>
        <?php
        if (is_object($tag))
        {
            echo '<td> </td></tr>';
           echo   loopRec($tag,$e2pLkp);

        }
        else
        {

            echo "<td>{$tag}</td></tr>";
        }
        ?>

<?php

}

?>

</tr>
</table>