<?php

namespace App\Controller;

use App\Entity\Contactos;
use App\Entity\Provincia;
use App\Repository\ContactosRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactoController extends AbstractController
{
    private $contactos = [
        1 => ["nombre" => "Juan Pérez", "telefono" => "524142432", "email" => "juanp@ieselcaminas.org"],
        2 => ["nombre" => "Ana López", "telefono" => "58958448", "email" => "anita@ieselcaminas.org"],
        5 => ["nombre" => "Mario Montero", "telefono" => "5326824", "email" => "mario.mont@ieselcaminas.org"],
        7 => ["nombre" => "Laura Martínez", "telefono" => "42898966", "email" => "lm2000@ieselcaminas.org"],
        9 => ["nombre" => "Nora Jover", "telefono" => "54565859", "email" => "norajover@ieselcaminas.org"]
    ];

    private $provincias = [
        2 => ["nombre" => "Alicante", "zip" => "12000"],
        3 => ["nombre" => "Valencia", "zip" => "10080"],
        4 => ["nombre" => "Vinaros", "zip" => "11050"],
        5 => ["nombre" => "Nules", "zip" => "12001"]
    ];

    #[Route('/contacto/insertarProvincias', name: 'insertar_provincias')]
    public function insertarProvincia(ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        foreach($this->provincias as $c){
            $provincia = new Provincia();
            $provincia-> setNombre($c["nombre"]);
            $provincia-> setZIP($c["zip"]);
            $entityManager-> persist($provincia);
        }
        try
        {
            $entityManager->flush();
            return new Response ("Provincias insertadas");
        }catch (\Exception $e){
            return new Response("Error insertando objetos.");
        }
    }

    #[Route('/contacto/insertar', name: 'insertar_contacto')]
    public function insertar(ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        foreach($this->contactos as $c){
            $contacto = new Contactos();
            $contacto-> setNombre($c["nombre"]);
            $contacto-> setTelefono($c["telefono"]);
            $contacto-> setemail($c["email"]);
            $entityManager-> persist($contacto);
        }
        try
        {
            $entityManager->flush();
            return new Response ("Contactos insertados");
        }catch (\Exception $e){
            return new Response("Error insertando objetos.");
        }
    }

    #[Route('/contacto/insertarSinProvincia', name: 'insertar_sin_provincia_contacto')]
    public function insertarConProvincia(ManagerRegistry $doctrine): Response{
        $entityManager = $doctrine->getManager();
        $repositorio = $doctrine->getRepository(Provincia::class);
        
        $provincia = $repositorio->findOneBy(["nombre" => "Alicante"]);

        $contacto = new Contactos();
        $contacto->setNombre("Insercion de prueba sin provincia");
        $contacto->setTelefono('9999999');
        $contacto->setEmail('prueba2@caminas.com');
        $contacto->setProvincia($provincia);

        $entityManager->persist($provincia);
        $entityManager->persist($contacto);

        $entityManager->flush();
        return $this->render('ficha_contacto.html.twig', ['contacto' => $contacto]);
    }

    #[Route('/contacto/insertarConProvincia', name: 'insertar_con_provincia_contacto')]
    public function insertarSinProvincia(ManagerRegistry $doctrine): Response{
        $entityManager = $doctrine->getManager();
        
        $provincia = new Provincia();
        $provincia->setNombre('Castellon');
        $provincia->setZIP('12005');
        
        $contacto = new Contactos();
        $contacto->setNombre("Insercion prueba provincia");
        $contacto->setTelefono('7587757');
        $contacto->setEmail('prueba@caminas.com');
        $contacto->setProvincia($provincia);

        $entityManager->persist($provincia);
        $entityManager->persist($contacto);

        $entityManager->flush();
        return $this->render('ficha_contacto.html.twig', ['contacto' => $contacto]);
    }

    #[Route('/contacto/{codigo}', name: 'ficha_contacto')]
    public function ficha(ManagerRegistry $doctrine, $codigo): Response
    {
        $repositorio = $doctrine->getRepository(Contactos::class);
        $contacto = $repositorio->find($codigo);
        
        return $this->render('ficha_contacto.html.twig', 
        ['contacto' => $contacto]);
    }

    #[Route('/contacto/buscar/{texto}', name: 'buscar_contacto')]
    public function buscar(ManagerRegistry $doctrine, $texto): Response
    {
        $repositorio = $doctrine->getRepository(Contactos::class);
        $contacto = $repositorio->findByName($texto);
        
        return $this->render('lista_contacto.html.twig', 
        ['contacto' => $contacto]);
    }

    #[Route('/contacto/update/{id}/{nombre}', name: 'modificar_contacto')]
    public function update(ManagerRegistry $doctrine, $id, $nombre): Response{
        $entityManager = $doctrine->getManager();
        $repositorio = $doctrine->getRepository(Contactos::class);
        $contacto = $repositorio->find($id);
        if ($contacto){
            $contacto->setNombre($nombre);
            try
            {
                $entityManager -> flush();
                return $this-> render('ficha_contacto.html.twig', ['contacto' => $contacto]);

            } catch (\Exception $e){
                return new Response("Error editando objetos");
            }
        }else
            return $this -> render('ficha_contacto.html.twig', ['contacto' => null]);
    }

    #[Route('/contacto/delete/{id}', name: 'eliminar_contacto')]
    public function delete(ManagerRegistry $doctrine, $id): Response{
        $entityManager = $doctrine->getManager();
        $repositorio = $doctrine->getRepository(Contactos::class);
        $contacto = $repositorio->find($id);
        if ($contacto){
            try
            {
                $entityManager->remove($contacto);
                $entityManager->flush();
                return new Response("Contacto eliminado");
            }catch (\Exception $e){
                return new Response("Error eliminando el objeto");
            }
        }else
            return $this->render('ficha_contacto.html.twig', ['contacto' => null]);
    }

}
