<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Balance extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function deposit(float $value)
    {
        // dd(gettype($value));
        DB::beginTransaction();

        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount += number_format($value, 2, '.', '');
        $deposit =$this->save();

        $historic = auth()->user()->historics()->create([
            'type' => 'I',
            'amount' => $this->amount,
            'total_before' => $totalBefore,
            'total_after' => $this->amount,
            'date' => date('Ymd'),
        ]);

        if($deposit && $historic){
            DB::commit();

            return true;

        }else{
            DB::rollBack();

            return false;
        }
    }

    public function withdraw(float $value)
    {
        if($this->amount < $value){
            return false;
        }

        DB::beginTransaction();

        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount -= number_format($value, 2, '.', '');
        $deposit =$this->save();

        $historic = auth()->user()->historics()->create([
            'type' => 'O',
            'amount' => $this->amount,
            'total_before' => $totalBefore,
            'total_after' => $this->amount,
            'date' => date('Ymd'),
        ]);

        if($deposit && $historic){
            DB::commit();

            return true;

        }else{
            DB::rollBack();

            return false;
        }
    }

    public function transfer(User $sender, int $value)
    {
        // dd($value);
        DB::beginTransaction();

        // Atualiza o próprio saldo

        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount -= number_format($value, 2, '.', '');
        $transfer = $this->save();

        $historic = auth()->user()->historics()->create([
            'type'                  => 'T',
            'amount'                => $value,
            'total_before'          => $totalBefore,
            'total_after'           => $this->amount,
            'date'                  => date('Ymd'),
            'user_id_transaction'   => $sender->id
        ]);

        // Atualiza o saldo do recebedor

        $senderBalance = $sender->balance()->firstOrCreate([]);
        $totalBeforeSender = $senderBalance->amount ? $senderBalance->amount : 0;
        $senderBalance->amount += number_format($value, 2, '.', '');
        $transferSender = $senderBalance->save();

        $historicSender = $sender->historics()->create([
            'type'                  => 'I',
            'amount'                => $value,
            'total_before'          => $totalBeforeSender,
            'total_after'           => $senderBalance->amount,
            'date'                  => date('Ymd'),
            'user_id_transaction'   => auth()->user()->id,
        ]);

        if ($transfer && $historic && $transferSender && $historicSender){
            DB::commit();

            return true;
        }else{
            DB::rollBack();

            return false;
        }
    }
}
