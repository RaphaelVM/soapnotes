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

class Edit extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Category $record;

    public function mount($uuid): void
    {
        $this->record = Category::getByUUID($uuid);
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(25),
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $existingRecord = Category::where('name', $data['name'])->first();

        if ($existingRecord && $existingRecord->id !== $this->record->id) {
            // Handle the case where a record with the same name already exists
            Notification::make()
                ->title('Category already exists')
                ->danger()
                ->send();

            return;
        }

        $this->record->update($data);

        $this->redirectRoute('categories.index');
    }

    public function render(): View
    {
        return view('livewire.categories.edit');
    }
}
