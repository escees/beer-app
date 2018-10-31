<?php

declare(strict_types=1);

namespace App\Controller;

use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractApiController extends FOSRestController
{
    protected function createApiResponse($data, int $status, string $group = null): Response
    {
        $view = $this->view($data, $status);
        if ($group) {
            $view->setContext((new Context())->addGroup($group));
        }
        return $this->handleView($view);
    }
}