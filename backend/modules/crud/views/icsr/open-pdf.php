
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
        if ($value->children()->count() >=1) {
            $htmlString .= '<tr style="background-color: red;"><td></td><td></td><td></td></tr>';

        }

     $htmlString.= '<tr>';
     $htmlString .= "<td>{$e2pLkp[$key]['element']} </td>";
     $htmlString .= "<td>{$e2pLkp[$key]['title']} </td>";

        if ($value->children()->count() >=1)
        {
            $htmlString .= '<td> </td></tr>';

            loopRec($value->children(),$e2pLkp);
        }
     else
     {
         $htmlString.= "<td>".(!empty($value->children()->__toString()) ? $value->children()->__toString() : $value->__toString())."</td></tr>";

     }

    }

    return $htmlString;
}

echo loopRec($xml,$e2pLkp);
?>

</tr>
</table>