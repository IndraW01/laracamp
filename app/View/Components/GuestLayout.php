<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GuestLayout extends Component
{
    public string $title; // Harus Public agar bisa di buatkan slotnya


    public function __construct(string $title)
    {
        $this->title = $title ?? config('app.name');
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.guest');
    }
}
