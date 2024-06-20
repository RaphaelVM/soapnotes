<?php

namespace App\Livewire\Notes;

use App\Models\Category;
use App\Models\Note;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Create extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(80),
                RichEditor::make('content')
                    ->required()
                    ->toolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'orderedList',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                    ])
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('notes'),
                Select::make('category_id')
                    ->label('Category')
                    ->multiple()
                    ->options(Category::all()->pluck('name', 'id')),
            ])
            ->statePath('data')
            ->model(Note::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        DB::beginTransaction();
        try {
            $note = Note::create($data);
            $this->note->categories()->attach($data['category_id']);

            Notification::make()
                ->title('Saved successfully')
                ->success()
                ->send();

            DB::commit();

            $this->redirectRoute('notes.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Notification::make()
                ->title('An error occurred')
                ->danger()
                ->send();

            return;
        }
    }

    public function render(): View
    {
        return view('livewire.notes.create');
    }
}
