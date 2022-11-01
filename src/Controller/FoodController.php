<?php


namespace App\Controller;

use App\Entity\Food;
use App\Entity\Ingredients;
use App\Entity\Tags;
use App\Form\SearchForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FoodController extends AppController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage()
    {
        return $this->render('food/index.html.twig');
    }

    /**
     * @Route("/show", name="app_show")
     */
    public function show(Request $request)
    {

        $form = $this->createForm(SearchForm::class);
        $form->handleRequest($request);
        if ($form->isSubmitted())
        {
            $input = $form->getData()['input'];
            $search = $this->manager->getRepository(Food::class)
                ->search($input,);

            return $this->render("food/homepage.html.twig", [
                'foods' => $this->paginate($search, $request, $form->get('search')->isClicked()),
                'form' => $form->createView(),
            ]);
        }

        $foods = $this->manager->getRepository(Food::class)->findAllFood();

        if(isset($_GET['lang']))
        {
            $locale = $_GET['lang'];
            $this->translator->setLocale($locale);
        }

        if(isset($_GET['category']))
        {
            $category = $_GET['category'];
            if($category == 'NULL'){
                $foods = $this->manager->getRepository(Food::class)
                    ->findBy(['category' => null]);
            }elseif($category == '!NULL'){
                $foods = $this->manager->getRepository(Food::class)->findAllFood();
            }else{
                $explode = explode(",",$category);
                $foods = $this->manager->getRepository(Food::class)
                    ->findBy(['category' => $explode]);
            }
        }

        if(isset($_GET['per_page']))
        {
            $per_page = $_GET['per_page'];
            $foodsPaginate = $this->paginate($foods,$request,false,$per_page);
        }else{
            $foodsPaginate = $this->paginate($foods,$request,false,5);
        }

        return $this->render('food/homepage.html.twig', [
            'foods' => $foodsPaginate,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/show/category/{slug}", name="app_category")
     */
    public function category(Food $food)
    {
        $ingredients = $this->manager->getRepository(Ingredients::class)
            ->findBy(['food' => $food]);

        $tags = $this->manager->getRepository(Tags::class)
            ->findBy(['food' => $food]);

        if(isset($_GET['lang'])){
            $locale = $_GET['lang'];
            $this->translator->setLocale($locale);
        }

        return $this->render('food/category.html.twig', [
            'food' => $food,
            'ingredients' => $ingredients,
            'tags' => $tags
            ]);
    }
}