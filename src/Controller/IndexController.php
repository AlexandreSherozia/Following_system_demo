<?php

/*
 * This file is part of the behat package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Follower;
use App\Entity\Number;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class IndexController extends Controller
{
    private $relationsExists;
    private $obj;

    /**
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/", name="home")
     */
    public function homeAction(Request $request, ValidatorInterface $validator)
    {
        if ($request->isXmlHttpRequest()) {
            $number = new Number();
            $number->setValue((int) $request->get('number'));
            $number->setCreatedAt((new \DateTime())->format('Y-m-d'));
            $errors = $validator->validate($number);

            $json = [];
            $json['number'] = $number->getValue();

            if (count($errors) > 0) {
                /** @var ConstraintViolation $error */
                foreach ($errors as $error) {
                    $json['errors'][] = $error->getMessage();
                }
            }

            if (0 === count($errors)) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($number);
                $em->flush();
                $json['success'] = 'Nombre enregistré';
            }

            return new JsonResponse($json);
        }

        $numbers = $this->getDoctrine()->getManager()->getRepository(Number::class)
            ->findAll();
        $total = 0;
        foreach ($numbers as $number) {
            $total += (int) $number->getValue();
        }

        return $this->render('index/home.html.twig', [
            'total' => $total
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/users", name="users")
     */
    public function listUsers()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('listusers.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @Route("/user/{id}", name="user")
     */
    public function showUser(Request $request, $id, EntityManagerInterface $manager)
    {

        /*dump($id);*/

        $followerUser   = $this->getDoctrine()->getRepository(User::class)->find(1);
        $followedUser   = $this->getDoctrine()->getRepository(User::class)->find((int)$request->get('user'));

        //dump($followerUser);

    //dump((int)$this->getDoctrine()->getRepository(Follower::class)->ifFollowingExists($followerUser, $followedUser));

        if($this->getDoctrine()->getRepository(Follower::class)->ifFollowingExists($followerUser, $followedUser)){

            $this->relationsExists = true;

        } else {

            $this->relationsExists = false;
        }



        if ($request->isXmlHttpRequest()){

            if(!$this->relationsExists){

                $followerObj   = new Follower();

                $followerObj->setFollowed($followedUser);

                $followerObj->setFollower($followerUser);

                $response = true;


                $manager->persist($followerObj);
                $manager->flush();

            } else {

                /*$relation = $this->getDoctrine()->getRepository(Follower::class)->findOneBy(['follower' => $followerUser, 'followed' => $followedUser]);*/
                $relation = $this->getDoctrine()->getRepository(Follower::class)->followingRelation($followerUser,$followedUser);

                $response = false;

                $manager->remove($relation);
                $manager->flush();

            }

            return new JsonResponse($response);

        }


        $userId = $this->getDoctrine()->getRepository(User::class)->find($id);

        $adverts = $this->getDoctrine()->getRepository(Articles::class)->findOneBy(['user' => $userId]);

        /*$follow = $this->getDoctrine()->getRepository(Follower::class)->findBy(['follower'=> $followerUser,'followed'=> $followedUser]);*/
        /*$int = $request->get('user');*/
        $follow = $this->getDoctrine()->getRepository(Follower::class)->findOneBy(['followed' => $userId]);


        /*dump($adverts);

        dump($follow);*/

        return $this->render('user.html.twig', [
            'user' => $userId,
            'follow'=> $follow,
            'adverts'=> $adverts
        ]);
    }
}
