<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Client
 * @package App\Models
 *
 * @OA\Schema(
 *     title="Client",
 *     description="Client model",
 *     @OA\Property(
 *          property="id",
 *          format="int64",
 *          description="ID",
 *          title="ID",
 *          example=1,
 *     ),
 *     @OA\Property(
 *        property="name",
 *        example="Ivan",
 *    ),
 *   @OA\Property(
 *        property="last_name",
 *        example="Ivanov",
 *    ),
 *    @OA\Property(
 *        property="emails",
 *        type="array",
 *        title="Client mailboxes",
 *        @OA\Items(type="string", example="ivanov@usedesc.ru")
 *    ),
 *    @OA\Property(
 *        property="phones",
 *        title="Client phones",
 *        type="array",
 *        @OA\Items(type="string", example="+7(999)9999999")
 *    ),
 *    required={"name", "last_name"},
 * )
 * @property integer $id
 * @property string $name
 * @property string $lastName
 * @property Carbon $created_at
 * @property Carbon $updates_at
 * @property Carbon $deleted_at
 *
 * @property-read Collection|ClientEmail $emails
 * @property-read Collection|ClientPhone $phones
 *
 * @method static Builder|Client newModelQuery()
 * @method static Builder|Client newQuery()
 * @method static Builder|Client query()
 * @method static Builder|Client whereId($value)
 * @method static Builder|Client whereName($value)
 * @method static Builder|Client whereLastName($value)
 * @method static Builder|Client whereCreatedAt($value)
 * @method static Builder|Client whereUpdatedAt($value)
 * @method static Builder|Client whereDeletedAt($value)
 * @mixin Collection
 */
class Client extends Model
{
    use SoftDeletes;

    protected $table = 'clients';
    protected $fillable = ['name', 'last_name'];

    public function emails() {
        return $this->hasMany(ClientEmail::class);
    }

    public function phones() {
        return $this->hasMany(ClientPhone::class);
    }

}
