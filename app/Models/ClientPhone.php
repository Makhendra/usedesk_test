<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientPhone
 * @package App\Models
 *
 * @OA\Schema(
 *     title="Телефон клиента",
 *     description="модель телефона",
 *     @OA\Property(
 *        property="phone",
 *        example="+7(999)9999999",
 *    ),
 *    required={"phone"},
 * )
 * @property integer $id
 * @property string $email
 * @property Carbon $created_at
 * @property Carbon $updates_at
 * @property Carbon $deleted_at
 *
 * @property Client $client
 */
class ClientPhone extends Model
{
    protected $table = 'client_phones';
    protected $fillable = ['client_id', 'phone'];

    public function client() {
        return $this->belongsTo(Client::class);
    }
}
