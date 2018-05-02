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
use Symfony\Component\Routing\Annotation\Route;

class APIController extends Controller
{
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
     * @Route("/api/boarding-cards/sort", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function sortAction(Request $request)
    {
        try {
            $requestBody = json_decode($request->getContent());
            if (!empty($requestBody)) {
                foreach ($requestBody as $item) {
                    $unsortedBoardingCards[] = $this->boardingCardRepresenter::toDomain($item);
                }
                $sortedBoardingCards = $this->boardingCardService->sort($unsortedBoardingCards);

                return new JsonResponse($sortedBoardingCards, 200);
            } else {
                return new JsonResponse('You have provided bad request', 400);
            }
        } catch (\Exception $exception) {
            if($exception->getCode() == 400) {
                return new JsonResponse($exception->getMessage(), $exception->getCode());
            }
            $this->logger->error($exception->getMessage(), $exception->getCode());
        }
    }
}