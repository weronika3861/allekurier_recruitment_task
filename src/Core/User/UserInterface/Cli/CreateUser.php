<?php

namespace App\Core\User\UserInterface\Cli;

use App\Core\User\Application\Command\CreateUser\CreateUserCommand;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsCommand(
    name: 'app:user:create',
    description: 'Dodawanie nowego użytkownika'
)]
class CreateUser extends Command
{
    public function __construct(
        private readonly MessageBusInterface $bus,
        private readonly ValidatorInterface $validator
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $email = $input->getArgument('email');

        $emailConstraint = new Assert\Collection([
            'email' => [
                new Assert\NotBlank(['message' => 'Email nie może być pusty.']),
                new Assert\Email(['message' => 'Email "{{ value }}" nie jest poprawny.']),
            ]
        ]);

        $violations = $this->validator->validate(['email' => $email], $emailConstraint);

        if (count($violations) > 0) {
            dump ('test');
            foreach ($violations as $violation) {
                $output->writeln($violation->getMessage());
            }

            return Command::INVALID;
        }

        $this->bus->dispatch(new CreateUserCommand(
            $input->getArgument('email')
        ));

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this->addArgument('email', InputArgument::REQUIRED);
    }
}
