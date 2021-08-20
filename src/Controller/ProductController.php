<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ClientRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/producto/{id}", name="producto.index")
     */
    public function index(Product $product): Response
    {
            return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'producto'=>$product
        ]);
    }

    /**
     * @Route("/adicionarProducto",name="producto.adicionar")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function AddProduct(Request $request): Response
    {

        $product = new Product();
        $form = $this->createForm(ProductType::class,$product);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            $this->addFlash('success','Producto insertado correctamente');
            return $this->redirectToRoute('tienda.index');
        }

        return $this->render('product/AddProduct.html.twig',[
         'product'=>$product,
         'form'=>$form->createView(),
     ]);
    }

    /**
     * @Route("/editarProducto/{id}", name="producto.editar",methods={"GET","POST"})
     * @param Request $request
     * @param Product $product
     * @return Response
     */
    function EditProduct(Request $request,Product $product): Response
    {
        $form = $this->createForm(ProductType::class,$product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success','Producto editado correctamente');
            return $this->redirectToRoute('tienda.index');
        }
        return $this->render('product/editProduct.html.twig',[
            'producto'=>$product,
            'form'=>$form->createView(),
        ]);
    }


    /**
     * @Route("/{id}",name="producto.eliminar",methods={"DELETE"})
     * @param Request $request
     * @param Product $product
     * @return Response
     */
    function DeleteProduct(Request $request, Product $product):Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }
     return $this->render('product/index.html.twig');
    }


    /**
     * @Route("/detalles/{id}",name="producto.detalles")
     * @param Product $product
     * @return Response
     */
    function ProductDetails(Product $product):Response
    {
    return $this->render('product/details.html.twig',[
        'producto'=>$product,
    ]);
    }

    /**
     * @Route("/compra/{id}",name="producto.compra")
     * @param Product $product
     * @param Request $request
     * @return Response
     */
    function MakeShop(Product $product, Request $request):Response{

      $client = $this->getUser();
      $form = $this->createFormBuilder()
        ->add('CantCompra',TextType::class,['attr'=>['class'=>'form-control'],'label'=>'Cantidad a comprar'])
          ->getForm();
     $form->handleRequest($request);
     if($form->isSubmitted()&& $form->isValid()){
         /*$data = $form->getData();*/
         /*$product->setCant($data['CantCompra']);*/
         $product->setCant(999999);

        /* $CantRebaja = $data['CantCompra'];
         if($product->getCant()<$CantRebaja){
             $product->setCant(0);
             $cantidadRest = $CantRebaja - $product->getCant();
         }
         else{
             $product->setCant($product->getCant()-$CantRebaja);
         }*/
         $em = $this->getDoctrine()->getManager();
         $em->flush();
         return $this->redirectToRoute('tienda.index');
     }
     return $this->render('product/MakeShop.html.twig',
     [
         'form'=>$form->createView(),
         'producto'=>$product,
         'cliente'=>$client,

     ]);
    }
}
