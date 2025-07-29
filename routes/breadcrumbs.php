<?php

use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Spatie\Permission\Models\Role;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('dashboard'));
});

// Home > Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Dashboard', route('dashboard'));
});

Breadcrumbs::for('grades.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Grades', route('grades.index'));
});

Breadcrumbs::for('grades.create', function (BreadcrumbTrail $trail) {
    $trail->parent('grades.index');
    $trail->push('Add Grade', route('grades.create'));
});

Breadcrumbs::for('grades.show', function (BreadcrumbTrail $trail, $grade) {
    $trail->parent('grades.index');
    $trail->push($grade->name, route('grades.show', $grade));
});

Breadcrumbs::for('grades.edit', function (BreadcrumbTrail $trail, $grade) {
    $trail->parent('grades.show', $grade);
    $trail->push('Edit', route('grades.edit', $grade));
});

Breadcrumbs::for('subjects.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Subjects', route('subjects.index'));
});

Breadcrumbs::for('subjects.create', function (BreadcrumbTrail $trail) {
    $trail->parent('subjects.index');
    $trail->push('Add Subject', route('subjects.create'));
});

Breadcrumbs::for('subjects.show', function (BreadcrumbTrail $trail, $subject) {
    $trail->parent('subjects.index');
    $trail->push($subject->name, route('subjects.show', $subject));
});

Breadcrumbs::for('subjects.edit', function (BreadcrumbTrail $trail, $subject) {
    $trail->parent('subjects.show', $subject);
    $trail->push('Edit', route('subjects.edit', $subject));
});

// Home > Dashboard > User Management
Breadcrumbs::for('user-management.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('User Management', route('user-management.users.index'));
});

// Home > Dashboard > User Management > Users
Breadcrumbs::for('user-management.users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user-management.index');
    $trail->push('Users', route('user-management.users.index'));
});

// Home > Dashboard > User Management > Users > [User]
Breadcrumbs::for('user-management.users.show', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('user-management.users.index');
    $trail->push(ucwords($user->name), route('user-management.users.show', $user));
});

// Home > Dashboard > User Management > Roles
Breadcrumbs::for('user-management.roles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user-management.index');
    $trail->push('Roles', route('user-management.roles.index'));
});

// Home > Dashboard > User Management > Roles > [Role]
Breadcrumbs::for('user-management.roles.show', function (BreadcrumbTrail $trail, Role $role) {
    $trail->parent('user-management.roles.index');
    $trail->push(ucwords($role->name), route('user-management.roles.show', $role));
});

// Home > Dashboard > User Management > Permission
Breadcrumbs::for('user-management.permissions.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user-management.index');
    $trail->push('Permissions', route('user-management.permissions.index'));
});
