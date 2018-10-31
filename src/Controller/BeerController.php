<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Beer;
use App\Service\Fetcher\BeerFetcher;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Request\ParamFetcher;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class BeerController extends AbstractApiController
{
    /**
     * @Route("/api/beer/list", methods={"GET"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="List of beers",
     *     @SWG\Schema(
     *          type="array",
     *          @SWG\Items(
     *             type="object",
     *             ref=@Model(type=App\Entity\Beer::class)
     *         )
     *     )
     * )
     *
     * @SWG\Parameter(
     *     name="search",
     *     in="query",
     *     required=false,
     *     type="string",
     *     description="query search"
     * )
     *
     * @SWG\Parameter(
     *     name="sort_field",
     *     in="query",
     *     required=false,
     *     type="string",
     *     description="sort field",
     * )
     *
     * @SWG\Parameter(
     *     name="sort_dir",
     *     in="query",
     *     required=false,
     *     type="string",
     *     description="sort dir",
     * )
     *
     * @SWG\Tag(name="Beer")
     *
     * @param ParamFetcher $paramFetcher
     * @param BeerFetcher $beerFetcher
     *
     * @Rest\QueryParam(name="search", description="search", allowBlank=false, default="")
     * @Rest\QueryParam(name="sort_field", allowBlank=false, requirements="(name|brewer_id|country|type|price)", default="name", description="Sort")
     * @Rest\QueryParam(name="sort_dir", allowBlank=false, requirements="(asc|desc)", default="asc", description="Sort")
     *
     * @return Response
     */
    public function list(ParamFetcher $paramFetcher, BeerFetcher $beerFetcher): Response
    {
        $beers = $beerFetcher->fetch(
            $paramFetcher->get('search'),
            $paramFetcher->get('sort_field'),
            $paramFetcher->get('sort_dir')
        );

        return $this->createApiResponse($beers, Response::HTTP_OK);
    }

    /**
     * @Route("/api/beer/{id}", methods={"GET"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Show beer",
     *     @SWG\Schema(
     *         type="object",
     *         ref=@Model(type=Beer::class, groups={"show"})
     *     )
     * )
     * @SWG\Response(
     *     response=404,
     *     description="Not found"
     * )
     *
     * @SWG\Tag(name="Beer")
     *
     * @param Beer $beer
     *
     * @return Response
     */
    public function show(Beer $beer): Response
    {
        return $this->createApiResponse($beer, Response::HTTP_OK);
    }

}