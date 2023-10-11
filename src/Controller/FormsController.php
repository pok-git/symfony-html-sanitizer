<?php

namespace App\Controller;

use App\Form\ActivityRichTextModelFormType;
use App\Form\ActivityRichTextModelSanitizeFormType;
use App\Model\ActivityRichTextModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormsController extends AbstractController
{
    #[Route('/form_model', name: 'form_model')]
    public function form_model(Request $request): Response
    {
        $title = "";
        $content = "";
        $activityRichTextModel = new ActivityRichTextModel();
        $form = $this->createForm(ActivityRichTextModelSanitizeFormType::class, $activityRichTextModel);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $act = $form->getData();
            $title = $act->getTitle();
            $content = $act->getContent();
        }
        return $this->render('form/actModel.html.twig', [
            'form' => $form,
            'title' => $title,
            'content' => $content,
        ]);
    }


    #[Route('/form_model_m', name: 'form_model_m')]
    public function form_model_m(Request $request,
                                 HtmlSanitizerInterface $appPostSanitizer,
                                 HtmlSanitizerInterface $appCleanSanitizer): Response
    {
        $title = "";
        $content = "";
        $contentClean = "";
        $contentPost = "";
        $activityRichTextModel = new ActivityRichTextModel();
        $form = $this->createForm(ActivityRichTextModelFormType::class, $activityRichTextModel);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $act = $form->getData();
            $title = $act->getTitle();
            $content = $act->getContent();

            //$unsafeContents = $request->request->get('post_contents');
            $title = $appCleanSanitizer->sanitize($title);
            $contentClean = $appCleanSanitizer->sanitize($content);
            $contentPost = $appPostSanitizer->sanitize($content);
            //dd($content,$content1, $content2);
        }

        return $this->render('form/actModelM.html.twig', [
            'form' => $form,
            'title' => $title,
            'content' => $content,
            'contentClean' => $contentClean,
            'contentPost' => $contentPost,
        ]);
    }






}