<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{


    #[Route('/', name: 'home')]
    public function index(): Response
    {

        $sample1 = 'Safe Content 1
&lt;div&gt; Unsafe Content 1 &lt;/div&gt;
&lt;!-- [if gte mso 9]&gt;&lt;xml&gt;
 &lt;o:OfficeDocumentSettings&gt;&lt;o:RelyOnVML/&gt;&lt;o:AllowPNG/&gt;&lt;/o:OfficeDocumentSettings&gt;
&lt;/xml&gt;&lt;![endif]--&gt;';

        $sample2 = 'Safe Content 2
&lt;div&gt; Unsafe Content 2 &lt;/div&gt;
&lt;script&gt;// &lt;![CDATA[
    (function(i,s,o,g,r,a,m){var ql=document.querySelectorAll(&#039;A[quiz],DIV[quiz]&#039;);
// ]]&gt;&lt;/script&gt;';




        return $this->render('home/home.html.twig', [
            'sample1' => $sample1,
            'sample2' => $sample2,
        ]);
    }




}
