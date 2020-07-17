<?php

namespace ComplaintBundle\Controller;

use ComplaintBundle\Entity\Type;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TypeController extends Controller
{
    public function addTypeAction(Request $request)
    {
        $data = $request->getContent();
        $complaint = $this->get('jms_serializer')->deserialize($data, Type::class, 'json');
        $em = $this->getDoctrine()->getManager();
        $em->persist($complaint);
        $em->flush();
        return new Response('Type added successfully', 201);
    }

    public function getTypeByIdAction(Type $type)
    {
        $data = $this->get('jms_serializer')->serialize($type, 'json');
        $response = new Response($data);
        return $response;
    }

    public function getAllTypesAction()
    {
        $type= $this->getDoctrine()->getRepository('ComplaintBundle:Type')->findAll();
        $data = $this->get('jms_serializer')->serialize($type, 'json');
        $response = new Response($data);
        return $response;
    }
    public function updateTypeAction(Request $request , $id){
        $em=$this->getDoctrine()->getManager();
        $type=$em->getRepository(Type::class)->find($id);
        $data=$request->getContent();
        $new=$this->get('jms_serializer')->deserialize($data,Type::class,'json');
        $type->setLabel($new->getLabel());
        $em->persist($type);
        $em->flush();
        return new Response('Type updated successfully',201);

    }
    public function deleteTypeAction(Request $request)
    {
        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $type=$em->getRepository(Type::class)->find($id);
        $em->remove($type);
        $em->flush();
        return new JsonResponse(['Message'=>'Type deleted with success!'],200);

    }

}