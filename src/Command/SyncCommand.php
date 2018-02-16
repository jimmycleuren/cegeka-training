<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Psr\Log\LoggerInterface;
use App\Entity\Hotel;
use App\Entity\Flight;

class SyncCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'sync';

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
        
        parent::__construct();
    }
    
    protected function configure()
    {
        $this
            ->setDescription('Synchronize data from other agencies')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        
        $this->em = $this->getContainer()->get('doctrine')->getManager();
        $agencies = $this->em->getRepository("App:Agency")->findAll();
        
        foreach($agencies as $agency) {
            
            $this->syncHotels($agency, $io);
            $this->syncFlights($agency, $io);
        }

        $io->success('Data synchronized from '.count($agencies).' agencies');
    }
    
    private function syncHotels($agency, $io)
    {
        $url = $agency->getUrl()."/hotels.json";
        $io->writeln("Requesting $url");
        $guzzle = $this->getContainer()->get('eight_points_guzzle.client.agency_api');
        $json = $guzzle->get($url)->getBody();
        $data = json_decode($json);
        if ($data) {
            foreach($data as $hotel) {
                if ($hotel->owned) {
                    $entity = $this->em->getRepository("App:Hotel")->findOneBy(array('agency' => $agency, 'remoteId' => $hotel->id));
                    if (!$entity) {
                        $entity = new Hotel();
                        $entity->setAgency($agency);
                        $entity->setRemoteId($hotel->id);
                    }
                    $entity->setName($hotel->name);
                    $entity->setLocation($hotel->location);
                    $entity->setStart(new \DateTime($hotel->start));
                    $entity->setEnd(new \DateTime($hotel->end));
                    $entity->setStars($hotel->stars);
                    $entity->setPrice($hotel->price);
                    $entity->setOwned(false);
                    
                    $this->em->persist($entity);
                }
            }
            $this->em->flush();
        } else {
            $io->error("Could not decode json from $url");
        }
    }
    
    private function syncFlights($agency, $io)
    {
        $url = $agency->getUrl()."/flights.json";
        $io->writeln("Requesting $url");
        $guzzle = $this->getContainer()->get('eight_points_guzzle.client.agency_api');
        $json = $guzzle->get($url)->getBody();
        $data = json_decode($json);
        if ($data) {
            foreach($data as $flight) {
                if ($flight->owned) {
                    $entity = $this->em->getRepository("App:Flight")->findOneBy(array('agency' => $agency, 'remoteId' => $flight->id));
                    if (!$entity) {
                        $entity = new Flight();
                        $entity->setAgency($agency);
                        $entity->setRemoteId($flight->id);
                    }
                    $entity->setAirline($flight->airline);
                    $entity->setFrom($flight->from);
                    $entity->setTo($flight->to);
                    $entity->setStart(new \DateTime($flight->start));
                    $entity->setEnd(new \DateTime($flight->end));
                    $entity->setDuration($flight->duration);
                    $entity->setTimeofday(new \DateTime($flight->timeofday));
                    $entity->setPrice($flight->price);
                    $entity->setOwned(false);
                    
                    $this->em->persist($entity);
                }
            }
            $this->em->flush();
        } else {
            $io->error("Could not decode json from $url");
        }
    }
}
