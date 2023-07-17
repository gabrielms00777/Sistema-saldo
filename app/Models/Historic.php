<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Historic extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'amount', 'total_before', 'total_after', 'user_id_transaction', 'date'];

    public function type($type = null)
    {
        $types = [
            'I' => 'Entrada',
            'O' => 'Saida',
            'T' => 'Transferência'
        ];

        if(!$type)
            return $types;

        if($this->user_id_transaction != null && $type == 'I')
            return 'Recebido';

        return $types[$type];
    }

    protected function date(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d/m/Y'),
            // get: fn ($value) => get: fn ($value) => date_format($value, 'd/m/Y'),
        );
    }

    public function userSender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_transaction');
    }
}
