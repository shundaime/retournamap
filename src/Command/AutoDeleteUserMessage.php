<?php


namespace App\Command;

use App\Entity\ContactMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class AutoDeleteUserMessage extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:clear-message';

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * AutoDeleteUserMessage constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Delete user message in Database.')
            ->setHelp('This command allows you to delete old message')
            ->addArgument('durationInMonths', InputArgument::REQUIRED, 'Indiquez un nombre de mois')
        ;
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $months = (int) $input->getArgument('durationInMonths');

        // On récupère un array de ContactMessages php bin/console app:clear-message
        $messages = $this->em->getRepository(ContactMessage::class)->findAllLowerThanDate(new \DateTime('-'.$months.' month'));
        $numDeletedMessages = count($messages);

        $output->writeln('Nombre de messages à supprimer : '.$numDeletedMessages.'.');

        foreach ($messages as $message) {
            $output->writeln('Suppression du message #'.$message->getId().' daté du : '.$message->getDate()->format('d/m/Y H:i:s'));
            $this->em->remove($message); // Prépare la suppression du message
        }

        // Execute la requête SQL
        $this->em->flush();

        $output->writeln('Fin de la suppression, nombre de messages supprimés : '.$numDeletedMessages.'.');
    }
}