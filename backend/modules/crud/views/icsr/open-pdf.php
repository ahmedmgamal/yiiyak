
<table border="1">
    <tr>
        <th><?= Yii::t('app','Element');?></th>
        <th><?= Yii::t('app','Title');?></th>
        <th><?= Yii::t('app','Value');?></th>
    </tr>
<tr>

<?php
$htmlString = '';
function loopRec ($obj,$e2pLkp,$elementsLkp)
{
   global  $htmlString;

    foreach ($obj as $key => $value)
    {

       if (   $value->children()->count() >= 1 || !empty($value->__toString())  ) {
            if ($value->children()->count() >= 1) {
                $htmlString .= '<tr style="background-color: red;"><td></td><td></td><td></td></tr>';
            }

            $htmlString .= '<tr>';
            $htmlString .= "<td>{$e2pLkp[$key]['element']} </td>";
            $htmlString .= "<td>{$e2pLkp[$key]['title']} </td>";

            if ($value->children()->count() >= 1) {
                $htmlString .= '<td> </td></tr>';

                loopRec($value->children(), $e2pLkp,$elementsLkp);
            } else {
                $htmlString .= "<td>" . (!empty($value->children()->__toString()) ?
                        (
                            isset($elementsLkp[$key][trim($value->children()->__toString())]) ?
                            $elementsLkp[$key][trim($value->children()->__toString())] : $value->children()->__toString()
                        ) :
                        (
                        isset($elementsLkp[$key][trim($value->__toString())]) ?
                            $elementsLkp[$key][trim($value->__toString())] : $value->__toString()
                        )
                        ) . "</td></tr>";

            }
        }

    }

    return $htmlString;
}

echo loopRec($xml,$e2pLkp,$elementsLkp);
?>

</tr>
</table>