<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowCreateManuallyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255|unique:shows',
            'name_fr' => 'max:255',
            'creators' => ['regex:/^[A-Za-z0-9-éèàùç%+ ]{1,255}?(,[A-Za-z0-9-éèàùç%+ ]{1,255})*$/'],
            'nationalities' => ['regex:/^[A-Za-z0-9-éèàùç%+ ]{1,255}?(,[A-Za-z0-9-éèàùç%+ ]{1,255})*$/'],
            'channels' => ['regex:/^[A-Za-z0-9-éèàùç%+ ]{1,255}?(,[A-Za-z0-9-éèàùç%+ ]{1,255})*$/'],
            'genres' => ['regex:/^[A-Za-z0-9-éèàùç%+ ]{1,255}?(,[A-Za-z0-9-éèàùç%+ ]{1,255})*$/'],
            'diffusion_us' => 'date',
            'diffusion_fr' => 'date',
            'taux_erectile' => 'numeric|between:1,100',

            'actors.*.name_actor' => 'required|max:255',
            'actors.*.role_actor' => 'required|max:255',

            'seasons.*.episodes.*.name' => 'max:255',
            'seasons.*.episodes.*.name_fr' => 'max:255',
            'seasons.*.episodes.*.diffusion_us' => 'date',
            'seasons.*.episodes.*.diffusion_fr' => 'date',
            'seasons.*.episodes.*.directors' => ['regex:/^[A-Za-z0-9-éèàùç%+ ]{1,255}?(,[A-Za-z0-9-éèàùç%+ ]{1,255})*$/'],
            'seasons.*.episodes.*.writers' => ['regex:/^[A-Za-z0-9-éèàùç%+ ]{1,255}?(,[A-Za-z0-9-éèàùç%+ ]{1,255})*$/'],
            'seasons.*.episodes.*.guests' => ['regex:/^[A-Za-z0-9-éèàùç%+ ]{1,255}?(,[A-Za-z0-9-éèàùç%+ ]{1,255})*$/'],
        ];
    }
}