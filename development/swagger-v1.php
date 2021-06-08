<?php
/**
 * @SWG\Swagger(
 *     schemes={"http"},
 *     host=API_HOST,
 *     basePath="/",
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="Laravel Project",
 *         description="Mẫu tích hợp Swagger + Jwt cho api, email: lucnn@ttc-solutions.com, phone: 0961196368",
 *         termsOfService="",
 *         @SWG\Contact(
 *             email="lucnn@ttc-solutions.com"
 *         ),
 *     ),
 * )
 */

/**
 * @SWG\SecurityScheme(
 *      securityDefinition="http_bearer_auth",
 *      type="apiKey",
 *      in="header",
 *      name="Authorization"
 * )
 */
