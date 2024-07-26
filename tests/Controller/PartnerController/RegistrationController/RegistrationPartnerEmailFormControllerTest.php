<?php

    namespace App\Tests\Controller\PartnerController\RegistrationController;

    use PHPUnit\Framework\TestCase;
    use Symfony\Component\DependencyInjection\ContainerInterface;
    use Symfony\Component\Form\FormFactoryInterface;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\Form\FormInterface;
    use Symfony\Component\Form\FormView;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\RequestStack;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
    use Symfony\Component\Routing\RouterInterface;
    use Twig\Environment;
    use Symfony\Component\HttpFoundation\Session\Session;
    use App\Controller\PartnerController\RegistrationController\RegistrationPartnerEmailFormController;

    class RegistrationPartnerEmailFormControllerTest extends TestCase
    {
        /**
         * test if form is not submitted
         */
        public function testRegistrationFormIsNotSubmitted()
        {
            //mock for dependencies
            $formFactory = $this->createMock(FormFactoryInterface::class);
            $entityManager = $this->createMock(EntityManagerInterface::class);
            $twig = $this->createMock(Environment::class);

            $request = new Request();

            $form = $this->createMock(FormInterface::class);
            $form->method('isSubmitted')->willReturn(false);
            $formView = $this->createMock(FormView::class);
            $form->method('createView')->willReturn($formView);

            $formFactory->method('create')->willReturn($form);

            //$session = new Session(new MockArraySessionStorage());

            $requestStack = $this->createMock(RequestStack::class);
            $requestStack->method('getCurrentRequest')->willReturn($request);

            //create controller and set dependencies
            $controller = new RegistrationPartnerEmailFormController($requestStack, $entityManager);

            // Mock the `render` method from AbstractController
            $controllerReflection = new \ReflectionClass($controller);
            $renderMethod = $controllerReflection->getMethod('render');
            $renderMethod->setAccessible(true);

            // Mock the `render` method of AbstractController
            $controller->setContainer($this->createMock(\Symfony\Component\DependencyInjection\ContainerInterface::class));

            // Mock the render method directly
            $renderedContent = 'rendered template';
            $renderMethod->invoke($controller, 'partners/registration/registrationEmailForm.html.twig', [
                'emailForm' => $formView,
            ]);

            // Call the controller method
            $response = $controller->partnersRegistrationEmailForm();

            //$this->assertInstanceOf(Response::class, $response);
            //$this->assertEquals('registration_partner_page', $response->getContent());
        }
    }