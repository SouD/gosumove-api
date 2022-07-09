<?php
declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidatesWhenResolvedTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractAutoValidatingCommand extends Command
{
    use ValidatesWhenResolvedTrait;

    /**
     * @var Validator
     */
    protected $validator;

    /**
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /*
         * Ideally I would have liked to use the \Illuminate\Contracts\Validation\ValidatesWhenResolved interface
         * but it seeems like the console command input is not yet present directly after resolving, so we call
         * the validation logic from here instead.
         */
        $this->validateResolved();

        return parent::execute($input, $output);
    }

    protected function getValidatorInstance(): Validator
    {
        if ($this->validator) {
            return $this->validator;
        }

        $container = \resolve(Container::class);

        $this->validator = $container->make(ValidationFactory::class)
            ->make(
                data: $this->validationData(),
                rules: $container->call([$this, 'rules']),
                messages: $this->messages(),
                customAttributes: $this->attributes()
            )
            ->stopOnFirstFailure();

        return $this->validator;
    }

    public function validationData(): array
    {
        return \array_merge(
            $this->arguments(),
            $this->options()
        );
    }

    public function messages(): array
    {
        return [];
    }

    public function attributes(): array
    {
        return [];
    }
}
