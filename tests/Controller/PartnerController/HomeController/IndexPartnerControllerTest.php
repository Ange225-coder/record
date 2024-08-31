<?php

    namespace App\Tests\Controller\PartnerController\HomeController;

    use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

    class IndexPartnerControllerTest extends WebTestCase
    {
        public function testIndexPartnerIsUp()
        {
            $client = static::createClient();
            $urlGenerator = $client->getContainer()->get('router.default');
            $crawler = $client->request(Request::METHOD_GET, $urlGenerator->generate('partner_home'));

            $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        }
    }