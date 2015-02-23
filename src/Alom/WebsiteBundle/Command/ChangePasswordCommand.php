<?php

namespace Alom\WebsiteBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ChangePasswordCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('user:change_password')
            ->setDescription('Change password for admin')
            ->addArgument('password', InputArgument::REQUIRED, 'your new password')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $newPassword = $input->getArgument('password');

        $em = $this->getContainer()->get('doctrine')->getManager();
        $admin = $em->getRepository('AlomWebsiteBundle:User')->findOneBy(array('username' => 'admin'));
        $factory = $this->getContainer()->get('security.encoder_factory');
        $encoder = $factory->getEncoder($admin);
        $newPassword = $encoder->encodePassword($newPassword, $admin->regenerateSalt());
        $admin->setPassword($newPassword);
        $em->persist($admin);
        $em->flush();

        $output->writeln('Successfully changed.');
    }
}