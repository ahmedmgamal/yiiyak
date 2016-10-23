<?php
namespace backend\modules\crud\traits;


trait checkSignal {

    public function isSignaled ($signaledItemsArr, $checkColumn)
    {
        foreach ($signaledItemsArr as $key => $row)
        {
            if ($row[$checkColumn] == $this->id)
            {
                return 1;
            }
        }
        return 0;
    }
}