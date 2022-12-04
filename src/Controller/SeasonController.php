<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Repository\EpisodeRepository;
use App\Repository\SeasonRepository;
use App\Repository\ProgramRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/saison', name: 'season_')]
class SeasonController extends AbstractController
{

    #[Route('/show/{id<^[0-9]+$>}', name: 'index')]
    public function index(int $id, SeasonRepository $seasonRepository, ProgramRepository $programRepository, EpisodeRepository $episodeRepository): Response
    {
        $season = $seasonRepository->findOneBy(['id' => $id]);
        $program = $programRepository->findOneBy(['id' => $id]);
        $episode = $episodeRepository->findBy(['season' => $id]);
      

        return $this->render('season/index.html.twig', [

            'season' => $season,
            'program' => $program,
            'episode' => $episode,

        ]);
    }

}