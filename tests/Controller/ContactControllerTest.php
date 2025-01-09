<?php

namespace App\Tests\Controller;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ContactControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/contact/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Contact::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Contact index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'contact[lastname]' => 'Testing',
            'contact[firstname]' => 'Testing',
            'contact[number]' => 'Testing',
            'contact[mail]' => 'Testing',
            'contact[picture]' => 'Testing',
            'contact[groups]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Contact();
        $fixture->setLastname('My Title');
        $fixture->setFirstname('My Title');
        $fixture->setNumber('My Title');
        $fixture->setMail('My Title');
        $fixture->setPicture('My Title');
        $fixture->setGroups('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Contact');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Contact();
        $fixture->setLastname('Value');
        $fixture->setFirstname('Value');
        $fixture->setNumber('Value');
        $fixture->setMail('Value');
        $fixture->setPicture('Value');
        $fixture->setGroups('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'contact[lastname]' => 'Something New',
            'contact[firstname]' => 'Something New',
            'contact[number]' => 'Something New',
            'contact[mail]' => 'Something New',
            'contact[picture]' => 'Something New',
            'contact[groups]' => 'Something New',
        ]);

        self::assertResponseRedirects('/contact/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getLastname());
        self::assertSame('Something New', $fixture[0]->getFirstname());
        self::assertSame('Something New', $fixture[0]->getNumber());
        self::assertSame('Something New', $fixture[0]->getMail());
        self::assertSame('Something New', $fixture[0]->getPicture());
        self::assertSame('Something New', $fixture[0]->getGroups());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Contact();
        $fixture->setLastname('Value');
        $fixture->setFirstname('Value');
        $fixture->setNumber('Value');
        $fixture->setMail('Value');
        $fixture->setPicture('Value');
        $fixture->setGroups('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/contact/');
        self::assertSame(0, $this->repository->count([]));
    }
}
