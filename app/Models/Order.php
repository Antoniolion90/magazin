<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;

    protected $table = 'orders';
    protected $guarded = false;

    const STATUS_NOPAY = '1';
    const STATUS_PAY = '2';

    public static function getStatus()
    {
        return[
            self::STATUS_NOPAY => 'Не оплачено',
            self::STATUS_PAY => 'Оплачен',
        ];
    }

    public function getStatusTitleAttribute() {
        return self::getStatus()[$this->payment_status];
    }

}
