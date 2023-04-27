{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('cours') }}"><i class="nav-icon la la-question"></i> Cours</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('theme') }}"><i class="nav-icon la la-question"></i> Themes</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('question') }}"><i class="nav-icon la la-question"></i> Questions</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('concept') }}"><i class="nav-icon la la-question"></i> Concepts</a></li>