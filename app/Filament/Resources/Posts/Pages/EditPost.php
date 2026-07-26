<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected ?string $primaryCategory = null;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->primaryCategory = $data['primary_category'] ?? null;

        unset($data['primary_category']);

        return $data;
    }

    protected function afterSave(): void
    {
        if ($this->record) {
            $this->record->syncPrimaryCategory($this->primaryCategory);
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        $post = $this->record;

        return Notification::make()
            ->title('Saved successfully')
            ->success()
            ->body('Changes to the post have been saved.')
            ->actions([
                Action::make('view')
                    ->button()
                    ->url(route('posts.show', $post), shouldOpenInNewTab: true),
                Action::make('undo')
                    ->color('gray')
                    ->dispatch('undoEditingPost', [$post->id])
                    ->close(),
            ])
            ->broadcast(Auth::user());
    }
}
