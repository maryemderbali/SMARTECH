<?php

namespace App\Test\Controller;

use App\Entity\Service;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ServiceControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/service/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Service::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Service index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'service[nomservice]' => 'Testing',
            'service[datecreation]' => 'Testing',
            'service[location]' => 'Testing',
            'service[prix]' => 'Testing',
            'service[timeavailable]' => 'Testing',
            'service[fkIdcategorie]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Service();
        $fixture->setNomservice('My Title');
        $fixture->setDatecreation('My Title');
        $fixture->setLocation('My Title');
        $fixture->setPrix('My Title');
        $fixture->setTimeavailable('My Title');
        $fixture->setFkIdcategorie('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Service');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Service();
        $fixture->setNomservice('Value');
        $fixture->setDatecreation('Value');
        $fixture->setLocation('Value');
        $fixture->setPrix('Value');
        $fixture->setTimeavailable('Value');
        $fixture->setFkIdcategorie('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'service[nomservice]' => 'Something New',
            'service[datecreation]' => 'Something New',
            'service[location]' => 'Something New',
            'service[prix]' => 'Something New',
            'service[timeavailable]' => 'Something New',
            'service[fkIdcategorie]' => 'Something New',
        ]);

        self::assertResponseRedirects('/service/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNomservice());
        self::assertSame('Something New', $fixture[0]->getDatecreation());
        self::assertSame('Something New', $fixture[0]->getLocation());
        self::assertSame('Something New', $fixture[0]->getPrix());
        self::assertSame('Something New', $fixture[0]->getTimeavailable());
        self::assertSame('Something New', $fixture[0]->getFkIdcategorie());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Service();
        $fixture->setNomservice('Value');
        $fixture->setDatecreation('Value');
        $fixture->setLocation('Value');
        $fixture->setPrix('Value');
        $fixture->setTimeavailable('Value');
        $fixture->setFkIdcategorie('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/service/');
        self::assertSame(0, $this->repository->count([]));
    }
}
