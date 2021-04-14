<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class SwaggerController extends BaseController
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Danis Group",
     *      description=" QA Digitalization Api  Documentation",
     *      @OA\Contact(
     *          email="augurs.shailesh@gmail.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      name="Authorization",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 * ),
     *
     *  @OA\Server(
     *      url="http://localhost:8000/api/",
     *      description="QA API Server"
     * )     
     */
     
}
?>