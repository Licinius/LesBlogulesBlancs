<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
class CrudController extends Controller
{


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
     * @Route("/admin/delete/{postId}", name="delete",requirements={"postId"="\d+"})
     */
    public function deleteAction($postId){
        $em = $this->getDoctrine()->getManager();
        $article = $em->find("AppBundle:Article",$postId);
        if($article!=null){
            $em->remove($article);
            $em->flush();

        }
        return $this->redirectToRoute('homepage');
    }
    /**
     * @Route("/admin/edit/{postId}", name="edit",requirements={"postId"="\d+"})
     */
    public function EditAction(Request $request,$postId)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->find("AppBundle:Article", $postId);
        $this->get('logger')->info("Form created");
        $form = $this->createForm(ArticleType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $title = $form->get('Title')->getData();
            $article->setTitle($title);
            $article->setContent($form->get('Description')->getData());
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('post',["alias"=>$article->getUrlAlias()]);
        }else{
            $form->get("Title")->setData($article->getTitle());
            $form->get("Description")->setData($article->getContent());
        }
        return $this->render('post/create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
