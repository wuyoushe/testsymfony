<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/3
 * Time: 9:25
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;


class BlogController extends Controller
{
//    /**
//     * Mathches /blog/exactly/精确的匹配了/blog
//     * @Route("/blog/{productId}", name="blog_list", requirements={"page": "\d+"})
//     */
//    public function listAction($productId = 1)
//    {
//        $repository = $this->getDoctrine()->getRepository('AppBundle:Product');
//        var_dump($repository);
//        $product = $repository->find($productId);
//        var_dump($productId);
////        echo '<pre>';
////        var_dump($product);
////        echo '<br/>';
//        return new Response(
//            '<html><body>Lucky number: 111 </body></html>'
//        );
//    }

    /**
     * Matches /blog/* /匹配的是/blog/*
     *
     * @Route("/blog/{productId}", name="blog_show",requirements={"page": "\d+"})
     */
    public function showAction($productId){
        var_dump($productId);
        $product = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->find($productId);

        if(!$product)
        {
            throw $this->createNotFoundException(
              'No product found for id'.$productId
            );
        }
        $repository = $this->getDoctrine()->getRepository('AppBundle:Product');



// query for a single product by its primary key (usually "id")
// 通过主键（通常是id）查询一件产品
        $product = $repository->find($productId);

// dynamic method names to find a single product based on a column value
// 动态方法名称，基于字段的值来找到一件产品
        //$product = $repository->findOneById($productId);
        //$product = $repository->findOneByName('Keyboard');

// dynamic method names to find a group of products based on a column value
// 动态方法名称，基于字段值来找出一组产品
        //$products = $repository->findByPrice(19.99);

// find *all* products / 查出 *全部* 产品
        //$products = $repository->findAll();
//        return new Response(
//            '<html><body>Lucky number: 111 </body></html>'
//        );
        //渲染模板 render()方法可以用来渲染模板并可以把输出的内容放到你的Response对象
        return $this->render('hello/index.html/twig', array('name'  => $product), 302);
    }

    /**
     * Mathches /blog/exactly/精确的匹配了/blog
     * @Route("/blog/update/{productId}", name="blog_list", requirements={"page": "\d+"})
     */

    public function updateAction($productId)
    {
        $em = $this->getDoctrine()->getManager();
       $product = $em->getRepository('AppBundle:Product')->find($productId);

       if(!$product){
           throw $this->createNotFoundException(
               'No product found for id'. $productId
           );
       }

       $product->setName('New product name!');
       $em->flush();

       return $this->redirectToRoute('blog_list');
    }
}
























