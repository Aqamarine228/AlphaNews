<?php

namespace Aqamarine\AlphaNews\Console;

use Aqamarine\AlphaNews\Console\Views\MediaFolderCreateFolderModalMakeViewCommand;
use Aqamarine\AlphaNews\Console\Views\MediaFolderIndexMakeViewCommand;
use Aqamarine\AlphaNews\Console\Views\MediaFolderPreviewMakeViewCommand;
use Aqamarine\AlphaNews\Console\Views\MediaFolderUploadImageModalMakeViewCommand;
use Aqamarine\AlphaNews\Console\Views\PostActionsViewMakeCommand;
use Aqamarine\AlphaNews\Console\Views\PostAddToTopViewMakeCommand;
use Aqamarine\AlphaNews\Console\Views\PostCategoryCreateViewMakeCommand;
use Aqamarine\AlphaNews\Console\Views\PostCategoryEditViewMakeCommand;
use Aqamarine\AlphaNews\Console\Views\PostCategoryFormViewMakeCommand;
use Aqamarine\AlphaNews\Console\Views\PostCategoryIndexViewMakeCommand;
use Aqamarine\AlphaNews\Console\Views\PostCategoryTranslationsFormViewMakeCommand;
use Aqamarine\AlphaNews\Console\Views\PostCategoryViewMakeCommand;
use Aqamarine\AlphaNews\Console\Views\PostContentFormViewMakeCommand;
use Aqamarine\AlphaNews\Console\Views\PostCropImageModalMakeCommand;
use Aqamarine\AlphaNews\Console\Views\PostEditViewMakeCommand;
use Aqamarine\AlphaNews\Console\Views\PostImageViewMakeCommand;
use Aqamarine\AlphaNews\Console\Views\PostIndexViewMakeCommand;
use Aqamarine\AlphaNews\Console\Views\PostMediaTypeViewMakeCommand;
use Aqamarine\AlphaNews\Console\Views\PostPublishViewMakeCommand;
use Aqamarine\AlphaNews\Console\Views\PostShortContentFormViewMakeCommand;
use Aqamarine\AlphaNews\Console\Views\PostStatusViewMakeCommand;
use Aqamarine\AlphaNews\Console\Views\PostTagCreateViewMakeCommand;
use Aqamarine\AlphaNews\Console\Views\PostTagFormViewMakeCommand;
use Aqamarine\AlphaNews\Console\Views\PostTagIndexMakeViewCommand;
use Aqamarine\AlphaNews\Console\Views\PostTagsViewMakeCommand;
use Aqamarine\AlphaNews\Console\Views\PostTagTranslationsEditViewMakeCommand;
use Aqamarine\AlphaNews\Console\Views\PostTagTranslationsFormViewMakeCommand;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class GenerateViewsCommand extends Command
{
    protected $name = 'alphanews:generate-views';

    protected $description = 'Generates all needed views.';

    public function handle(): int
    {
        $module = $this->argument('module');
        $this->generateMediaFolderViews($module);
        $this->generatePostViews($module);
        $this->generatePostCategoryViews($module);
        $this->generatePostTagViews($module);
        return 0;
    }

    private function generateMediaFolderViews(string $module): void
    {
        $this->call(MediaFolderCreateFolderModalMakeViewCommand::class, ['module' => $module]);
        $this->call(MediaFolderIndexMakeViewCommand::class, ['module' => $module]);
        $this->call(MediaFolderPreviewMakeViewCommand::class, ['module' => $module]);
        $this->call(MediaFolderUploadImageModalMakeViewCommand::class, ['module' => $module]);
    }

    private function generatePostViews(string $module): void
    {
        $this->call(PostActionsViewMakeCommand::class, ['module' => $module]);
        $this->call(PostAddToTopViewMakeCommand::class, ['module' => $module]);
        $this->call(PostContentFormViewMakeCommand::class, ['module' => $module]);
        $this->call(PostCropImageModalMakeCommand::class, ['module' => $module]);
        $this->call(PostEditViewMakeCommand::class, ['module' => $module]);
        $this->call(PostImageViewMakeCommand::class, ['module' => $module]);
        $this->call(PostIndexViewMakeCommand::class, ['module' => $module]);
        $this->call(PostMediaTypeViewMakeCommand::class, ['module' => $module]);
        $this->call(PostPublishViewMakeCommand::class, ['module' => $module]);
        $this->call(PostShortContentFormViewMakeCommand::class, ['module' => $module]);
        $this->call(PostStatusViewMakeCommand::class, ['module' => $module]);
        $this->call(PostTagsViewMakeCommand::class, ['module' => $module]);
        $this->call(PostCategoryViewMakeCommand::class, ['module' => $module]);
    }

    private function generatePostCategoryViews(string $module): void
    {
        $this->call(PostCategoryCreateViewMakeCommand::class, ['module' => $module]);

        $this->call(
            PostCategoryEditViewMakeCommand::class,
            ['module' => $module, '--translations' => $this->option('translations')]
        );
        $this->call(
            PostCategoryFormViewMakeCommand::class,
            ['module' => $module, '--translations' => $this->option('translations')]
        );
        $this->call(
            PostCategoryIndexViewMakeCommand::class,
            ['module' => $module, '--translations' => $this->option('translations')]
        );

        if ($this->option('translations')) {
            $this->call(PostCategoryTranslationsFormViewMakeCommand::class, ['module' => $module]);
        }
    }

    private function generatePostTagViews(string $module): void
    {
        $this->call(
            PostTagIndexMakeViewCommand::class,
            ['module' => $module, '--translations' => $this->option('translations')]
        );

        if ($this->option('translations')) {
            $this->call(PostTagTranslationsEditViewMakeCommand::class, ['module' => $module]);
            $this->call(PostTagTranslationsFormViewMakeCommand::class, ['module' => $module]);
            return;
        }

        $this->call(PostTagCreateViewMakeCommand::class, ['module' => $module]);
        $this->call(PostTagFormViewMakeCommand::class, ['module' => $module]);
    }

    protected function getArguments(): array
    {
        return [
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }

    public function getOptions(): array
    {
        return [
            ['translations', 't', InputOption::VALUE_NONE, 'Generates translation files']
        ];
    }
}
