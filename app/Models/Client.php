<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
 * @package App\Models
 *
 * @OA\Schema(
 *     title="Клиент",
 *     description="модель клиента",
 *     @OA\Property(
 *          property="id",
 *          format="int64",
 *          description="ID",
 *          title="ID",
 *          example=1,
 *     ),
 *     @OA\Property(
 *        property="name",
 *        example="Иван",
 *    ),
 *   @OA\Property(
 *        property="last_name",
 *        example="Иванов",
 *    ),
 *    @OA\Property(
 *        property="emails",
 *        type="array",
 *        title="Почтовые ящики клиента",
 *        @OA\Items(ref="#/components/schemas/ClientEmail")
 *    ),
 *    @OA\Property(
 *        property="phones",
 *        title="Телефоны клиента",
 *        type="array",
 *        @OA\Items(ref="#/components/schemas/ClientPhone")
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
    protected $table = 'clients';
    protected $fillable = ['name', 'last_name'];

    public function emails() {
        return $this->hasMany(ClientEmail::class);
    }

    public function phones() {
        return $this->hasMany(ClientPhone::class);
    }
}
