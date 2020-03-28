<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TransactionPivot extends Pivot
{
    protected $table = "item_transaction";
}
