<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use App\Models\Matter;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('matter.index', function (BreadcrumbTrail $trail) {
    $trail->push(__('app.matters'), route('home'));
});

// Home > Blog
Breadcrumbs::for('matter.show', function (BreadcrumbTrail $trail, Matter $matter) {
    $trail->parent('matter.index');
    $trail->push((__('app.show').$matter->no.'-'.$matter->year), route('matter.show',$matter));
});

// Home > Blog > [Category]
Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('blog');
    $trail->push($category->title, route('category', $category));
});
