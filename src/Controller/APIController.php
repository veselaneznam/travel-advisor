<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 4/30/2018
 * Time: 10:49 AM
 */

namespace App\Controller;


use App\Services\BoardingCardRepresenter;
use App\Services\BoardingCardServiceInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response as HTTPResponse;
use Symfony\Component\Routing\Annotation\Route;

class APIController extends Controller
{
    const MESSAGE_WRONG = 'Opps! Something went wrong. Please try again later!';
    /**
     * @var BoardingCardServiceInterface
     */
    private $boardingCardService;

    /**
     * @var BoardingCardRepresenter
     */
    private $boardingCardRepresenter;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * APIController constructor.
     * @param BoardingCardServiceInterface $boardingCardService
     * @param BoardingCardRepresenter $boardingCardRepresenter
     * @param LoggerInterface $logger
     */
    public function __construct(
        BoardingCardServiceInterface $boardingCardService,
        BoardingCardRepresenter $boardingCardRepresenter,
        LoggerInterface $logger
    )
    {
        $this->boardingCardService = $boardingCardService;
        $this->boardingCardRepresenter = $boardingCardRepresenter;
        $this->logger = $logger;
    }

    /**
     * List sorted boarding cards instructions.
     *
     *
     * @Route("/api/boarding-cards", methods={"GET"})
     * @return JsonResponse
     */
    public function getCards()
    {
        try {
            return new JsonResponse($this->boardingCardService->getAllCardsAsJsonString(), HTTPResponse::HTTP_OK);

        } catch (\Exception $exception) {
            if($exception->getCode() == HTTPResponse::HTTP_BAD_REQUEST) {
                return new JsonResponse($exception->getMessage(), $exception->getCode());
            }
            $this->logger->error($exception->getMessage());
            return new JsonResponse(self::MESSAGE_WRONG, HTTPResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * List sorted boarding cards instructions.
     *
     *
     * @Route("/api/boarding-cards/sort", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function sortAction(Request $request)
    {
        try {
            $requestBody = json_decode($request->getContent());
            $unsortedBoardingCards = [];
            if (!empty($requestBody)) {
                foreach ($requestBody as $item) {
                    $unsortedBoardingCards[] = $this->boardingCardRepresenter::toDomain($item);
                }
                $sortedBoardingCards = $this->boardingCardService->getSortedCardsAsArray($unsortedBoardingCards);

                return new JsonResponse($sortedBoardingCards, HTTPResponse::HTTP_OK);
            } else {
                return new JsonResponse('You have provided bad request', HTTPResponse::HTTP_BAD_REQUEST);
            }
        } catch (\Exception $exception) {
            if($exception->getCode() == HTTPResponse::HTTP_BAD_REQUEST) {
                return new JsonResponse($exception->getMessage(), $exception->getCode());
            }
            $this->logger->error($exception->getMessage(), $exception->getCode());
            return new JsonResponse(self::MESSAGE_WRONG, HTTPResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * List sorted boarding cards instructions.
     *
     *
     * @Route("/api/boarding-cards/first", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getFirstCardAction(Request $request)
    {
        try {
            $requestBody = json_decode($request->getContent());
            $unsortedBoardingCards = [];
            if (!empty($requestBody)) {
                foreach ($requestBody as $item) {
                    $unsortedBoardingCards[] = $this->boardingCardRepresenter::toDomain($item);
                }
                $firstCard = $this->boardingCardService->getFirstCardAsArray($unsortedBoardingCards);

                return new JsonResponse($firstCard, HTTPResponse::HTTP_OK);
            } else {
                return new JsonResponse('You have provided bad request', HTTPResponse::HTTP_BAD_REQUEST);
            }
        } catch (\Exception $exception) {
            if($exception->getCode() == 400) {
                return new JsonResponse($exception->getMessage(), $exception->getCode());
            }
            $this->logger->error($exception->getMessage(), $exception->getCode());
            return new JsonResponse(self::MESSAGE_WRONG, HTTPResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}