<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\Customer;
use App\EntityRepository\CustomerRepository;
use App\Model\Message;
use App\Service\EmailSender;
use App\Service\Messenger;
use App\Service\SMSSender;
use App\Service\Validator;
use App\Service\WeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 */
class CustomerController extends AbstractController
{
    public function __construct(
        private CustomerRepository $repository
    )
    {
    }

    /**
     * @Route("/api/customer/{code}/notifications", name="customer_notifications", methods={"POST"})
     */
    public function notifyCustomer(string $code, Request $request): Response
    {
        $requestData = json_decode($request->getContent(), true);

        /** @var Customer $customer */
        $customer = $this->repository->findOneBy(['code' => $code]);

        $message = new Message();
        $message->setBody($requestData['body']);
        $message->setType($customer->getNotificationType());

        $messenger = new Messenger([new EmailSender(), new SMSSender()]);
        $messenger->send($message);

        return new Response("OK");
    }
}
