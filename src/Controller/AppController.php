<?php

namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Translation\TranslatorInterface;

class AppController extends AbstractController
{
    public function __construct(EntityManagerInterface $manager,
                                TranslatorInterface $translator,
                                PaginatorInterface $paginator)
    {
        $this->manager = $manager;
        $this->translator = $translator;
        $this->paginator = $paginator;
    }

    /**
     * @param $queryBuilder
     * @param Request $request
     * @param bool $reset
     * @param int $limit
     * @param bool $izvodi
     * @return PaginationInterface
     */
    public function paginate($queryBuilder, Request $request, $reset = false, $limit = 20 , $izvodi = false)
    {
        $session = $request->getSession();

        $pageNum = $this->setLastPage($request);

        if ($izvodi) {
            $session->set('page', 1);
            $pageNum = 1;
        }
        $page = $request->query->getInt('page', $pageNum);


        if ($reset == true) {
            $page = 1;
        }

        return $this->getPaginator()->paginate(
            $queryBuilder,
            $page,
            $request->query->getInt('limit', $limit)
        );
    }

    /**
     * @return \Knp\Component\Pager\Paginator|object
     */
    public function getPaginator()
    {
        return $this->paginator;
    }

    /**
     * @return int
     */
    private function getLastPage(Request $request)
    {
        $session = $request->getSession();

        $pageNumber = $session->get('page');

        $getPage = $_GET['page'] ?? $pageNumber;

        $session->set('page', $getPage);

        return (int) $pageNumber;
    }

    /**
     * @return int
     * @param $request Request
     */
    private function setLastPage(Request $request)
    {
        if ($this->getLastPage($request) == null) {
            $pageNum = 1;
        } else {
            $pageNum = $this->getLastPage($request);
        }
        return $pageNum;
    }

}