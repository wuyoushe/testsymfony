<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }


    /**
     * @Route("/create/data")
     */
    public function createAction()
    {
        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(19.99);
        $product->setDescription('Ergonomic and stylish!');

        $em = $this->getDoctrine()->getManager();

        //告诉Doctrine希望最终存储product对象
        $em->persist($product);
        //真正执行语句（如insert 查询）
        $em->flush();

        return new Response('Saved new product with id'.$product->getId());
    }

    /**
     * @Route("/show/{productId}", name="blog_show", requirements={"page":"\d+"})
     */


    public function showAction($productId)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()->getRepository('AppBundle:Product')->find($productId);

        if(!$product){
            throw $this->createNotFoundException(
                'No product found for id'.$productId
            );
        }

        //跟新产品名称
        $product->setName('New product name!');
        $em->flush();

        echo '<pre>';
        var_dump($product);
        return new Response(
            '<html><body>Lucky Number: '.$productId.'</body></html>'
        );
    }

}





















