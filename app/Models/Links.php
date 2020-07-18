<?php


namespace App\Models;

/**
 * @OA\Schema(
 *     title="Links",
 *     @OA\Property(
 *          property="self",
 *          type="string",
 *          example="link-value"
 *     ),
 *     @OA\Property(
 *          property="first",
 *          type="string",
 *          example="http://localhost:8000/api/clients?page=1"
 *     ),
 *     @OA\Property(
 *          property="last",
 *          type="string",
 *          example="http://localhost:8000/api/clients?page=2"
 *     ),
 *     @OA\Property(
 *          property="prev",
 *          example=null
 *     ),
 *     @OA\Property(
 *          property="next",
 *          type="string",
 *          example="http://localhost:8000/api/clients?page=2"
 *     ),
 * )
 */
class Links
{

}