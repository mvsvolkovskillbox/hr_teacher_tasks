<?php

namespace App\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Security("is_granted('ROLE_ADMIN_TAG') or is_granted('ROLE_ADMIN_COMMENT')")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }
}
