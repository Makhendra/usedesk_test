<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ClientEmail
 * @package App\Models
 *
 * @OA\Schema(
 *     title="Email client",
 *     description="model email",
 *     @OA\Property(
 *        property="email",
 *        example="ivanov@usedesk.ru",
 *    ),
 *    required={"email"},
 * )
 * @property integer $id
 * @property string $email
 * @property Carbon $created_at
 * @property Carbon $updates_at
 * @property Carbon $deleted_at
 *
 * @property Client $client
 */
class ClientEmail extends Model
{
    use SoftDeletes;

    protected $table = 'client_emails';
    protected $fillable = ['client_id', 'email'];
    protected $hidden = ['deleted_at'];
    protected $visible = ['email'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
