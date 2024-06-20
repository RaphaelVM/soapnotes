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
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Edit extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Note $record;

    public function mount($uuid): void
    {
        $this->record = Note::getByUUID($uuid);
        $this->form->fill([
            'title' => $this->record->title,
            'content' => $this->record->content,
            'category_id' => $this->record->categories->pluck('id')->toArray(),
        ]);
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
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $this->record->categories()->detach();
        $this->record->categories()->attach($data['category_id']);
        $this->record->update($data);

        $this->redirectRoute('notes.index');
    }

    public function render(): View
    {
        return view('livewire.notes.edit');
    }
}
