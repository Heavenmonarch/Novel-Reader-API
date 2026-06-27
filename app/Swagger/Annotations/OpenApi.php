<?php

namespace App\Swagger\Annotations;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'BookNest API',
    description: 'Production API for BookNest — a novel reading platform. Built with Laravel 13.',
    contact: new OA\Contact(
        name: 'BookNest Support',
        email: 'support@booknest.com'
    )
)]
#[OA\Server(
    url: 'http://localhost:8000/api/v1',
    description: 'Local development server'
)]
#[OA\Server(
    url: 'https://api.booknest.com/v1',
    description: 'Production server'
)]
#[OA\SecurityScheme(
    securityScheme: 'bearerAuth',
    type: 'http',
    scheme: 'bearer',
    bearerFormat: 'JWT',
    description: 'Enter your JWT access token'
)]
#[OA\Tag(name: 'Auth',          description: 'Registration, login, token refresh')]
#[OA\Tag(name: 'Books',         description: 'Browse and manage books')]
#[OA\Tag(name: 'Chapters',      description: 'Chapter management')]
#[OA\Tag(name: 'Library',       description: 'Reader personal library and collections')]
#[OA\Tag(name: 'Explore',       description: 'Rankings and discovery')]
#[OA\Tag(name: 'Reviews',       description: 'Book reviews and ratings')]
#[OA\Tag(name: 'Dragons',       description: 'Dragon vote system')]
#[OA\Tag(name: 'Author',        description: 'Author dashboard, works, and analytics')]
#[OA\Tag(name: 'Settings',      description: 'User settings and preferences')]
#[OA\Tag(name: 'Notifications', description: 'User notifications')]
#[OA\Tag(name: 'Search',        description: 'Search books, authors, and genres')]
#[OA\Tag(name: 'Social',        description: 'Follow system and activity feed')]
class OpenApi {}
