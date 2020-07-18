<?php


namespace App\Models;

/**
 *
 * @OA\Schema(
 *     title="Meta",
 *     @OA\Property(
 *          property="current_page",
 *          type="integer",
 *          example=1,
 *     ),
 *     @OA\Property(
 *          property="from",
 *          type="integer",
 *          example=1
 *     ),
 *     @OA\Property(
 *          property="last_page",
 *          type="integer",
 *          example=2
 *     ),
 *     @OA\Property(
 *          property="path",
 *          type="string",
 *          example="http://localhost:8000/api/clients"
 *     ),
 *     @OA\Property(
 *          property="per_page",
 *          type="integer",
 *          example=10
 *     ),
 *     @OA\Property(
 *          property="to",
 *          type="integer",
 *          example=10
 *     ),
 *     @OA\Property(
 *          property="total",
 *          type="integer",
 *          example=20
 *     )
 * )
 */
class Meta
{

}