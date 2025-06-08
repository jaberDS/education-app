<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Etudiant;
use App\Entity\Filiere;
use App\Entity\Enseignant;
use App\Entity\Module;
use App\Entity\Note;
use App\Entity\Semestre;
use App\Entity\User;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin_dashboard')]
    public function index(): Response
    {
        // Redirection possible vers un CRUD spécifique (optionnel)
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(YourCrudController::class)->generateUrl());

        // Sinon, affichage du tableau de bord par défaut :
        return $this->render('admin/admin_dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Gestion Exams')
            ->setFaviconPath('build/images/favicon.png')
            ->renderContentMaximized()
            ->renderSidebarMinimized();
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->setName($user->getUserIdentifier())
            ->setGravatarEmail($user->getEmail())
            ->displayUserAvatar(true);
    }

    public function configureAssets(): Assets
    {
        return Assets::new()->addCssFile('build/css/admin.css');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Filiere', 'fas fa-list', Filiere::class);
        yield MenuItem::linkToCrud('Semestre', 'fas fa-list', Semestre::class);
        yield MenuItem::linkToCrud('Enseignant', 'fas fa-list', Enseignant::class);
        yield MenuItem::linkToCrud('Module', 'fas fa-list', Module::class);
        yield MenuItem::linkToCrud('Etudiant', 'fas fa-list', Etudiant::class);
        yield MenuItem::linkToCrud('Note', 'fas fa-list', Note::class);
        yield MenuItem::linkToCrud('User', 'fas fa-list', User::class);
    }
}
