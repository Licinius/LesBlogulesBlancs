<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Constraints\Date;
class BlogController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em ->createQuery(
            'SELECT a
            FROM AppBundle:Article a
            ORDER BY a.published'
        )->setMaxResults(10);
        $articles = $query->getResult();
        return $this->render('index/index.html.twig', ["articles"=>$articles]);
    }

    /**
     * @Route("/post/{postId}", name="post",requirements={"postId"="\d+"})
     */
    public function postAction($postId=1)
    {
        $em= $this->getDoctrine()->getManager();
        $article = $em->find('AppBundle:Article',$postId);
        return $this->render('post/post.html.twig',[
                "article"=>$article
            ]);
    }
    /**
     * @Route("/post/{alias}", name="post")
     */
    public function postAliasAction($alias)
    {
        $em= $this->getDoctrine()->getManager();
        $query = $em ->createQuery(
            'SELECT a
            FROM AppBundle:Article a
            WHERE a.url_alias = :alias
            ORDER BY a.published '
        );
        $query->setParameter('alias',urlencode($alias));
        $article = $query->getResult();
        if($article==null){
            throw $this->createNotFoundException('L\'article avec l\'alias '.$alias.' n\'existe pas ou plus' );
        }
        return $this->render('post/post.html.twig',[
            "article"=>$article[0]
        ]);
    }
    /**
     * @Route("/admin/create", name="create")
     */
    public function createAction(Request $request)
    {
        $this->get('logger')->info("Form created");
        $form = $this->createForm(ArticleType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article = new Article();

            $title = $form->get('Title')->getData();
            $article->setTitle($title);
            $article->setContent($form->get('Description')->getData());

            try {
                $article->setPublished(new \DateTime("now", new \DateTimeZone("Europe/Paris")));
            } catch (\Exception $e) {
                return $this->redirectToRoute('homepage');
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }
        return $this->render('post/create.html.twig', array(
            'form' => $form->createView(),
        ));
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
