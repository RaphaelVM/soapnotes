<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(25),
            ])
            ->statePath('data')
            ->model(Category::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $category = Category::firstOrCreate($data);

        if ($category->wasRecentlyCreated) {
            Notification::make()
                ->title('Saved successfully')
                ->success()
                ->send();

            $this->redirectRoute('categories.index');
        }

        Notification::make()
            ->title('Category already exists')
            ->danger()
            ->send();
    }

    public function render(): View
    {
        return view('livewire.categories.create');
    }
}
