<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrizeResource\Pages;
use App\Filament\Resources\PrizeResource\RelationManagers;
use App\Models\Prize;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PrizeResource extends Resource
{
    protected static ?string $model = Prize::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('vol')
                    ->numeric(),
                Forms\Components\TextInput::make('award')
                    ->label('상품')
                    ->maxLength(255),
                Forms\Components\TextInput::make('name')
                    ->label('이름')
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('이메일')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->label('연락처')
                    ->tel()
                    ->required()
                    ->maxLength(13),
                Forms\Components\TextInput::make('wip')
                    ->label('IP주소')
                    ->maxLength(255),
                Forms\Components\TextInput::make('agree')
                    ->label('약관동의')
                    ->required()
                    ->numeric()
                    ->default(1),
                Forms\Components\TextInput::make('success')
                    ->label('성공여부')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('counts')
                    ->label('등록수')
                    ->numeric(),
                Forms\Components\TextInput::make('device')
                    ->label('기기종류')
                    ->maxLength(255),
                    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('vol')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('award')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('이름')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('이메일')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('연락처')
                    ->searchable(),
                Tables\Columns\TextColumn::make('wip')
                    ->label('IP주소')
                    ->searchable(),
                Tables\Columns\TextColumn::make('device')   
                    ->label('기기종류')
                    ->searchable(),
                Tables\Columns\TextColumn::make('agree')
                    ->label('약관동의')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('success')
                    ->label('성공여부')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('counts')
                    ->label('등록수')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('등록일')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('수정일')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrizes::route('/'),
            'create' => Pages\CreatePrize::route('/create'),
            'edit' => Pages\EditPrize::route('/{record}/edit'),
        ];
    }
}
