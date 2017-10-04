<?php

namespace AppBundle\Tests\Controller;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TodoControllerControllerTest extends WebTestCase
{
    public function testTodo()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/todo');
    }

}
