<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/2
 * Time: 19:09
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

//LuckyController 引用Twig最简单的方式就是集成Symfony的controller基类

class LuckyController extends Controller
{

//    /**
//     * @Route("/lucky/number")
//     */
//    public function numberAction()
//    {
//        $number = mt_rand(0, 100);
//
//        return new Response(
//            '<html><body>Lucky number: '.$number.'</body></html>'
//        );
//    }

//    public function numberAction1()
//    {
//        $number = mt_rand(0, 100);
//
//        return $this->render('lucky/number.html.twig', array('number' => $number));
//    }
//    //创建JSON响应

    /**
     * @route("/api/lucky/number")
     */
    public function apiNumberAction()
    {
        $data = array(
            'lucky_number'  => rand(0, 100),
        );

//        return new Response(
//            json_encode($data),
//            200,
//            array('Content-Type'    => 'application/json')
//        );
        //2,使用JsonResponse
        return new JsonResponse($data);
    }

//    /**
//     * @Route("/lucky/number/{count}")
//     */
//    public function numberAction2($count)
//    {
//        //因为{count}占位符，页面URL变得不一样现在要求 URLs匹配/lucky/number/*,例如 /lucky/number/5
//        $number = array();
//        for($i = 0; $i<$count; $i++){
//            $number[] = rand(0, 100);
//        }
//        $numberList = implode(', ', $number);
//
//        return new Response(
//            '<html><body>Lucky Number: '.$numberList.'</body></html>'
//        );
//    }
    /**
     * @Route("/lucky/number/{count}")
     */
    public function numberAction($count)
    {
        $number = array();
        $lucky = mt_rand(1, 100);
        for($i = 0; $i<$count; $i++){
            $number[] = rand(0, 100);
        }
        $numberList = implode(', ', $number);

        $html = $this->container->get('templating')->render(
          'lucky/number.html.twig',
          array(
              'luckyNumberList' => $numberList,
              'number'          => $lucky
          )
        );

        return new Response($html);
    }
}


















