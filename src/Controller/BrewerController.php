<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\BrewerRepository;
use FOS\RestBundle\Controller\Annotations\Route;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\Response;

class BrewerController extends AbstractApiController
{
    /**
     * @Route("/api/brewer/list", methods={"GET"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="List of beers",
     *     @SWG\Schema(
     *          type="array",
     *          @SWG\Items(
     *             type="object",
     *             ref=@Model(type=App\Entity\Brewer::class)
     *         )
     *     )
     * )
     * @SWG\Tag(name="Beer")
     *
     * @param BrewerRepository $brewerRepository
     *
     * @return Response
     */
    public function list(BrewerRepository $brewerRepository): Response
    {
        $brewers = $brewerRepository->getAllBrewersWithDetails();

        return $this->createApiResponse($brewers, Response::HTTP_OK);
    }
}