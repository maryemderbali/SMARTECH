<?php

namespace App\Test\Controller;

use App\Entity\Job;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JobControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/job/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Job::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Job index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'job[type]' => 'Testing',
            'job[metierouproduit]' => 'Testing',
            'job[description]' => 'Testing',
            'job[photos]' => 'Testing',
            'job[nomcategorie]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Job();
        $fixture->setType('My Title');
        $fixture->setMetierouproduit('My Title');
        $fixture->setDescription('My Title');
        $fixture->setPhotos('My Title');
        $fixture->setNomcategorie('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Job');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Job();
        $fixture->setType('Value');
        $fixture->setMetierouproduit('Value');
        $fixture->setDescription('Value');
        $fixture->setPhotos('Value');
        $fixture->setNomcategorie('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'job[type]' => 'Something New',
            'job[metierouproduit]' => 'Something New',
            'job[description]' => 'Something New',
            'job[photos]' => 'Something New',
            'job[nomcategorie]' => 'Something New',
        ]);

        self::assertResponseRedirects('/job/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getType());
        self::assertSame('Something New', $fixture[0]->getMetierouproduit());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getPhotos());
        self::assertSame('Something New', $fixture[0]->getNomcategorie());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Job();
        $fixture->setType('Value');
        $fixture->setMetierouproduit('Value');
        $fixture->setDescription('Value');
        $fixture->setPhotos('Value');
        $fixture->setNomcategorie('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/job/');
        self::assertSame(0, $this->repository->count([]));
    }
}
