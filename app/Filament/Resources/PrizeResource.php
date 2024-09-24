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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
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
                Tables\Columns\TextColumn::make('id')
                ->label('ID')
                ->numeric()
                ->sortable(),
                Tables\Columns\TextColumn::make('vol')
                ->label('볼륨')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('award')
                    ->label('상품')
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
                Tables\Columns\TextColumn::make('created_at')
                    ->label('등록일')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('wip')
                    ->label('IP주소')
                    ->searchable(),
                Tables\Columns\TextColumn::make('device')   
                    ->label('기기종류')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true), 
                Tables\Columns\TextColumn::make('counts')
                    ->label('등록수')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('agree')
                ->label('동의')
                ->formatStateUsing(function ($state) {
                    if (is_null($state)) {
                        return '미동의';
                    }
                    return $state === '1' ? '없음' : '체크';
                })
                ->icon(function ($state) {
                    return $state === '1' ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle';
                })
                ->color(function ($state) {
                    return $state === '1' ? 'danger' : 'success';
                }),
            ])
            ->filters([
                Filter::make('스타벅스')
                    ->label('스타벅스')
                    ->query(fn ($query) => $query->where('award', 'like', '%스타벅스%')),
                Filter::make('꽝')
                    ->label('꽝')
                    ->query(fn ($query) => $query->where('award', 'like', '%꽝%')),
            ])
            ->actions([

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
        ];
    }
}
