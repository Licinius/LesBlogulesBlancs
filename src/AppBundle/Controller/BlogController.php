<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em ->createQuery(
            'SELECT a
            FROM AppBundle:Article a
            ORDER BY a.published'
        )->setMaxResults(10);
        $products = $query->getResult();
        return $this->render('index/index.html.twig', ["products"=>$products]);
    }

    /**
     * @Route("/post/{postId}", name="post",requirements={"postId"="\d+"})
     */
    public function postAction($postId=1)
    {
        return $this->render('post/post.html.twig',[
                "postId"=>$postId
            ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function createAction()
    {
        return $this->render('post/create.html.twig',[]);
    }

    /**
     * @Route("/created", name="created")
     */
    public function createdAction()
    {
        return $this->render('index/index.html.twig', []);
    }
}
