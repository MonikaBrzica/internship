<?php

namespace App\DataFixtures;

use App\Entity\JobApplications;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JobAppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $job_app = new JobApplications();
		$job_app->setFirstName('Monika');
        $job_app->setLastName('Brzica');
        $job_app->setEmail('brzicamona@gmail.com');
        $job_app->setMessage('Prijava za posao!');
        $job_app->setfilename('Monika_Brzica_CV_1618230195.pdf');
        $job_app->setarchived(0);
        $manager->persist($job_app);
         
		$job_app1 = new JobApplications();
		$job_app1->setFirstName('Antonio');
        $job_app1->setLastName('Markić');
        $job_app1->setEmail('antonio@gmail.com');
        $job_app1->setMessage('Prijava za posao!');
        $job_app1->setfilename('Antonio_Markić_CV_1018230190.pdf');
        $job_app1->setarchived(0);
        $manager->persist($job_app1);
		
		$job_app2 = new JobApplications();
		$job_app2->setFirstName('Frano');
        $job_app2->setLastName('Šarić');
        $job_app2->setEmail('frano@gmail.com');
        $job_app2->setMessage('Prijava za posao!');
        $job_app2->setfilename('Frano_Šarić_CV_1118230191.pdf');
        $job_app2->setarchived(0);
        $manager->persist($job_app2);
		
		$job_app3 = new JobApplications();
		$job_app3->setFirstName('Pero');
        $job_app3->setLastName('Perić');
        $job_app3->setEmail('pero@gmail.com');
        $job_app3->setMessage('Prijava za posao!');
        $job_app3->setfilename('Pero_CV_1218230192.pdf');
        $job_app3->setarchived(1);
        $manager->persist($job_app3);
		
		$job_app4 = new JobApplications();
		$job_app4->setFirstName('Ana');
        $job_app4->setLastName('Anić');
        $job_app4->setEmail('ana@gmail.com');
        $job_app4->setMessage('Prijava za posao!');
        $job_app4->setfilename('Ana_CV_1318230193.pdf');
        $job_app4->setarchived(1);
        $manager->persist($job_app4);
		
        $manager->flush();
    }
}