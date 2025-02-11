<?php

namespace App\Controller;

use App\DTO\ContactDTO;
use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;

final class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index( Request $request , MailerInterface $mailer): Response
    {


    /** @var User */
    $user = $this->getUser();
    if($user) {
        $candidate = $user->getCandidat();

        $data = new ContactDTO;
       
        $data->prenom = $candidate->getName();
    } 

    $form = $this->createForm(ContactType::class, $data);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        try {
            $mail = (new TemplatedEmail())
                ->from($data->email)
                ->to('support@luxury-services.com')
                ->subject('Demande de contact')
                ->htmlTemplate('emails/contact.html.twig')
                ->context(['data' => $data]);


            $mailer->send($mail);
            $this->addFlash('success', 'Your message has been sent successfully.');
            return $this->redirectToRoute('app_contact');
        } catch (\Exception $e) {
            $this->addFlash('danger', 'An error occurred while sending the message : ' . $e->getMessage());
            return $this->redirectToRoute('app_contact');
        }
    }




        
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}



// faire le controller pour la formulaire de contact 
