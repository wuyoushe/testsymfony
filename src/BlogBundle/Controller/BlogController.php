<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/3
 * Time: 9:25
 */

namespace BlogBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class BlogController extends Controller
{
    /**
     * @Route("/blog/number/{count}")
     */
    public function numberAction($count)
    {
        $number = array();
        for($i = 0; $i<$count; $i++){
            $number[] = rand(0, 100);
        }
        $numberList = implode(', ', $number);

        $html = $this->container->get('templating')->render(
            'lucky/number.html.twig',
            array('luckyNumberList' => $numberList)
        );

        // return $this->render(
        //'lucky/number.html/twig',
        //array('luckyNumberList'=>$numberList)
        //);
        return new Response($html);
    }
}
























