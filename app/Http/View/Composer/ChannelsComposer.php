<?php

namespace App\Http\View\Composer;

use App\Models\Channel;
use Illuminate\View\View;

class ChannelsComposer
{
    public function compose(View $view)
    {
        $view->with('channels',Channel::orderBy('name')->get());
    }
}
