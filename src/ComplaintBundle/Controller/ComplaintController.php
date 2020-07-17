<?php

namespace ComplaintBundle\Controller;

use ComplaintBundle\Entity\Complaint;
use ComplaintBundle\Entity\Type;
use ComplaintBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ComplaintController extends Controller
{

    public function addAction(Request $request,$iduser,$idType) {
        $data=$request->getContent();
        $complaint = $this->get('jms_serializer')->deserialize($data,Complaint::class,'json');
        $em = $this->getDoctrine()->getManager();
        $user=$em->getRepository(User::class)->find($iduser);
        $type=$em->getRepository(Type::class)->find($idType);
        $complaint->setIduser($user);
        $complaint->setIdtype($type);
        $em->persist($complaint);
        $em->flush();
        return new Response('Complaint added successfully',201);
    }

     public function getComplaintByIdAction(Complaint $complaint){
         $data=$this->get('jms_serializer')->serialize($complaint,'json');
         $response= new Response($data);
         return $response;
        }
    public function getComplaintsAction(){
        $complaints = $this->getDoctrine()->getRepository('ComplaintBundle:Complaint')->findAll();
        $data=$this->get('jms_serializer')->serialize($complaints,'json');
        $response= new Response($data);
        return $response;
    }
    public function updateComplaintAction(Request $request , $id){
        $em=$this->getDoctrine()->getManager();
        $complaint=$em->getRepository(Complaint::class)->find($id);
        $data=$request->getContent();
        $newComp=$this->get('jms_serializer')->deserialize($data,Complaint::class,'json');
        $complaint->setDate($newComp->getDate());
        $complaint->setDescription($newComp->getDescription());
        $complaint->setImage($newComp->getImage());
        $em->persist($complaint);
        $em->flush();
        return new Response('Complaint updated successfully',201);

    }
public function deleteComplaintAction(Request $request)
{
    $id=$request->get('id');
    $em=$this->getDoctrine()->getManager();
    $complaint=$em->getRepository(Complaint::class)->find($id);
    $em->remove($complaint);
    $em->flush();
    return new JsonResponse(['Message'=>'Complaint deleted with success!'],200);

}






}
