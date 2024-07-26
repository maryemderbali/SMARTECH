<?php

namespace App\Test\Controller;

use App\Entity\Enchere;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EnchereControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/enchere/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Enchere::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Enchere index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'enchere[id]' => 'Testing',
            'enchere[description]' => 'Testing',
            'enchere[datedebut]' => 'Testing',
            'enchere[datefin]' => 'Testing',
            'enchere[offreInitial]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Enchere();
        $fixture->setId('My Title');
        $fixture->setDescription('My Title');
        $fixture->setDatedebut('My Title');
        $fixture->setDatefin('My Title');
        $fixture->setOffreInitial('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Enchere');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Enchere();
        $fixture->setId('Value');
        $fixture->setDescription('Value');
        $fixture->setDatedebut('Value');
        $fixture->setDatefin('Value');
        $fixture->setOffreInitial('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'enchere[id]' => 'Something New',
            'enchere[description]' => 'Something New',
            'enchere[datedebut]' => 'Something New',
            'enchere[datefin]' => 'Something New',
            'enchere[offreInitial]' => 'Something New',
        ]);

        self::assertResponseRedirects('/enchere/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getId());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getDatedebut());
        self::assertSame('Something New', $fixture[0]->getDatefin());
        self::assertSame('Something New', $fixture[0]->getOffreInitial());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Enchere();
        $fixture->setId('Value');
        $fixture->setDescription('Value');
        $fixture->setDatedebut('Value');
        $fixture->setDatefin('Value');
        $fixture->setOffreInitial('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/enchere/');
        self::assertSame(0, $this->repository->count([]));
    }
}
