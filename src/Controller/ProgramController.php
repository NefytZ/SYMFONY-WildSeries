<?php

namespace App\Controller;

use App\Entity\Season;
use App\Entity\Episode;
use App\Entity\Program;
use App\Form\ProgramType;
use App\Service\ProgramDuration;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Mime\Email;
use App\Repository\ProgramRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{

    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', [

            'programs' => $programs,

        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, ProgramRepository $programRepository, SluggerInterface $slugger, MailerInterface $mailer): Response
    {
        $program = new Program();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

   if ($form->isSubmitted() && $form->isValid()) {
            $programRepository->save($program, true);
            $email = (new Email())
        ->from($this->getParameter('mailer_from'))
        ->to('your_email@example.com')
        ->subject('Une nouvelle série vient d\'être publiée !')
        ->html($this->renderView('Program/newProgramEmail.html.twig', ['program' => $program]));

        $mailer->send($email);
            $this->addFlash('success', 'Le nouveau programme a été crée !');
        
            return $this->redirectToRoute('program_index', [], Response::HTTP_SEE_OTHER);
    }
    return $this->renderForm('program/new.html.twig', [
        'program' => $program,
        'form' => $form,
    ]);
    }

    #[Route('/show/{id}', requirements: ['id' => '\d+'], name: 'show')]

    public function show(Program $program, ProgramDuration $programDuration): Response

    {
        // same as $program = $programRepository->find($id)

        return $this->render('program/show.html.twig', [

            'program' => $program,
            'programDuration' => $programDuration->calculate($program)

        ]);
    }

    #[Route('/{program}/seasons/{season}', requirements: ['id' => '\d+'], name: 'season_show')] 
    #[Entity('program', options: ['mapping' => ['program' => 'id']])] 
    #[Entity('season', options: ['mapping' => ['season' => 'id']])]
    public function showSeason(Season $season, Program $program): Response
    {

        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season
        ]);
    }
    #[Route('/program/{program}/season/{season}/episode/{episode}', requirements: ['id' => '\d+'], name: 'episode_show')] 
    public function showEpisode(Program $program, Season $season, Episode $episode): Response
    {
        return $this->render('program/episode_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episode' => $episode
        ]);
    }
}