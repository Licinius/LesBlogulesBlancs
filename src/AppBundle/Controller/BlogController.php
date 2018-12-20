<?php

namespace AppBundle\Controller;

use AppBundle\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
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
    public function createAction(Request $request)
    {
        $form = $this->createForm(ArticleType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //to_do inserer dans base
            return $this->redirectToRoute('homepage');
        }
        return $this->render('post/create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/created", name="created")
     */
    public function createdAction()
    {
        return $this->render('index/index.html.twig', []);
    }

    /**
     * @Route("/admin/admin", name="Admin")
     */
    public function adminAction()
    {
        return $this->render('post/post.html.twig',[
        "postId"=>1996
    ]);
    }
}
